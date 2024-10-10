<?php
require "../conn.php";
require "../restrict.php";
require "../restrict_student.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}
// 0-pending 1-error 2-success 3-no match
$addError = 0;

if (isset($_POST["subject"])) {
    $pcEmail = $_SESSION['user_email'];
    $subject = !empty($_POST['subject']) ? $_POST['subject'] : NULL;
    $message = !empty($_POST['message']) ? $_POST['message'] : NULL;
    $dueDate = !empty($_POST['due_date']) ? $_POST['due_date'] : NULL;

    $notiInsertQuery = "INSERT INTO `notificationdetails` (`PC_Email`, `Subject`, `Message`, `Notification_Due_Date`, `Notification_Date`) VALUES (?, ?, ?, ?, current_timestamp());";
    $notiInsert = $conn->prepare($notiInsertQuery);
    $notiInsert->bind_param("ssss", $pcEmail, $subject, $message, $dueDate);
    if ($notiInsert->execute()) {
        $notificationId = $conn->insert_id;

        // Get the last inserted ID
        $notificationId = $conn->insert_id;

        // Handling file uploads
        $attachment1 = !empty($_FILES['attachment1']['name']) ? 'notification_' . $notificationId . '_attachment_1.' . pathinfo($_FILES['attachment1']['name'], PATHINFO_EXTENSION) : NULL;
        $attachment2 = !empty($_FILES['attachment2']['name']) ? 'notification_' . $notificationId . '_attachment_2.' . pathinfo($_FILES['attachment2']['name'], PATHINFO_EXTENSION) : NULL;

        // Move uploaded files to the desired directory if they exist
        if (!is_null($attachment1)) {
            if (!move_uploaded_file($_FILES['attachment1']['tmp_name'], '../Data/Notifications/' . $attachment1)) {
                die("Error uploading attachment 1.");
            }
        }
        if (!is_null($attachment2)) {
            if (!move_uploaded_file($_FILES['attachment2']['tmp_name'], '../Data/Notifications/' . $attachment2)) {
                die("Error uploading attachment 2.");
            }
        }

        $notiUpdateQuery = "UPDATE `notificationdetails` SET `Attachment1` = ?, `Attachment2` = ? WHERE `Notification_ID` = ?";
        $notiUpdate = $conn->prepare($notiUpdateQuery);
        $notiUpdate->bind_param("ssi", $attachment1, $attachment2, $notificationId);
        if ($notiUpdate->execute()) {
            // echo "Notification successfully inserted with attachments.";
             // Fetch students based on the criteria
             $departments = !empty($_POST['departments']) ? $_POST['departments'] : [];
             $minCgpa = !empty($_POST['min_cgpa']) ? $_POST['min_cgpa'] : NULL;
             $maxCgpa = !empty($_POST['max_cgpa']) ? $_POST['max_cgpa'] : NULL;
             $isPlaced = !empty($_POST['is_placed']) ? $_POST['is_placed'] : NULL;
             $percentage10 = !empty($_POST['percentage_10']) ? $_POST['percentage_10'] : NULL;
             $percentage12 = !empty($_POST['percentage_12']) ? $_POST['percentage_12'] : NULL;
             $gender = !empty($_POST['gender']) ? $_POST['gender'] : NULL;
 
             $studentQuery = "SELECT S.PLACED placed, R.CGPA cgpa, S.S_College_Email S_College_Email, S.S_10th_Perc per10, S.S_12th_Perc per12, S.Gender gender, D.Dept_name dname
                             FROM result R 
                             INNER JOIN student S ON S.S_College_Email = R.S_College_Email
                             INNER JOIN class C ON C.Class_id = S.S_Class_id
                             INNER JOIN department D ON D.Dept_id = C.Dept_id
                             WHERE 1=1";

             if (!empty($departments)) {
                $departmentConditions = array_map(function($dept) use ($conn) {
                    return "D.Dept_name = '" . $conn->real_escape_string($dept) . "'";
                }, $departments);
                $studentQuery .= " AND (" . implode(" OR ", $departmentConditions) . ")";
            }
             if (!is_null($minCgpa)) {
                 $studentQuery .= " AND cgpa >= $minCgpa";
             }
             if (!is_null($maxCgpa)) {
                 $studentQuery .= " AND cgpa <= $maxCgpa";
             }
             if (!is_null($isPlaced)) {
                 $studentQuery .= " AND placed = '$isPlaced'";
             }
             if (!is_null($percentage10)) {
                 $studentQuery .= " AND S.S_10th_Perc >= $percentage10";
             }
             if (!is_null($percentage12)) {
                 $studentQuery .= " AND S.S_12th_Perc >= $percentage12";
             }
             if (!is_null($gender)) {
                 $studentQuery .= " AND gender = '$gender'";
             }
             
             $studentsResult = $conn->query($studentQuery);
 
            if ($studentsResult->num_rows > 0) {
                 $studentNotiInsertQuery = "INSERT INTO studentnotifications (Notification_ID, S_College_Email) VALUES (?, ?)";
                 $studentNotiInsert = $conn->prepare($studentNotiInsertQuery);
 
                 while ($student = $studentsResult->fetch_assoc()) {
                     $studentEmail = $student['S_College_Email'];
                     $studentNotiInsert->bind_param("is", $notificationId, $studentEmail);
                     $studentNotiInsert->execute();
                 }
 
                //  echo "Student notifications successfully inserted.";
                $addError = 2;
             } else {
                //  echo "No students matched the criteria.";
                $addError = 3;
             }
        } else {
            // echo "Error updating notification with attachments: " . $notiUpdate->error;
            $addError = 1;
        }

        $notiUpdate->close();
    } else {
        // echo "Error inserting notification: " . $notiInsert->error;
        $addError = 1;
    }
    $notiInsert->close();



}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/notification-post.css">
    <title>Notifications</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="./notifications.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                        Notifications</h2>
                </div>

                <div class="sections">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h3>To :</h3>
                        <div class="form-adjust">
                            <div class="departmentbox">
                                <label for="">Department</label>
                                <div class="Checkbox">
                                    <?php
                                    global $conn;
                                    $fetchDepartmentQuery = "SELECT Dept_name as dname FROM department;";
                                    $fetchDepartment = $conn->prepare($fetchDepartmentQuery);
                                    $fetchDepartment->execute();
                                    $result = $fetchDepartment->get_result();
                                    
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div>
                                                <input id="' . htmlspecialchars($row["dname"]) . '"name="departments[]" value="' . htmlspecialchars($row["dname"]) . '" type="checkbox">
                                                <label for="' . htmlspecialchars($row["dname"]) . '">' . htmlspecialchars($row["dname"]) . '</label>
                                              </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="inputbox">
                                <label for="">Min CGPA</label>
                                <input name="min_cgpa" type="number" step="0.1" placeholder="0.0" min="0" max="10">
                            </div>
                            <div class="inputbox">
                                <label for="">Max CGPA</label>
                                <input name="max_cgpa" type="number" step="0.1" placeholder="10.0" min="0" max="10">
                            </div>
                            <div class="inputbox">
                                <label for="">Placed</label>
                                <select name="is_placed" id="">
                                    <option value="" selected>Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="inputbox">
                                <label for="">10th Percentage</label>
                                <input name="percentage_10" type="number">
                            </div>
                            <div class="inputbox">
                                <label for="">12th Percentage</label>
                                <input type="number" name="percentage_12">
                            </div>
                            <div class="inputbox">
                                <label for="">Gender</label>
                                <select name="gender" id="">
                                    <option value="" disabled selected>Select</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                            <div class="inputbox">
                                <label for="">Due Date</label>
                                <input type="date" name="due_date" required>
                            </div>
                            <div class="inputbox">
                                <label for="">Attachment 1</label>
                                <input type="file" name="attachment1">
                            </div>
                            <div class="inputbox">
                                <label for="">Attachment 2</label>
                                <input type="file" name="attachment2">
                            </div>
                        </div>

                        <h3>Subject:</h3>
                        <textarea name="subject" class="textarea-subject" placeholder="Subject" id=""></textarea>
                        <h3>Message:</h3>
                        <textarea name="message" class="textarea-message" placeholder="Message" id=""></textarea>
                        <a href="./notifications.php"><button class="add-button">Post Notifications</button></a>
                    </form>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>
    <!-- Modals -->
    <div id="error" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>There was an Error while posting the Notification</p>
        </div>
    </div>

    <div id="no-match" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>No students matched the criteria</p>
        </div>
    </div>

    <div id="successful" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>The notification has been sent successfully</p>
        </div>
    </div>
    <script>
        // Get the modals
        var errorModal = document.getElementById("error");
        var nomatchModal = document.getElementById("no-match");
        var successfulModal = document.getElementById("successful");

        // Get the <span> elements that close the modals
        var closeButtons = document.getElementsByClassName("close");

        // Close the modal when the user clicks on <span> (x)
        for (var i = 0; i < closeButtons.length; i++) {
            closeButtons[i].onclick = function() {
                errorModal.style.display = "none";
                nomatchModal.style.display = "none";
                successfulModal.style.display = "none";
            }
        }

        // Close the modal when the user clicks anywhere outside of the modal
        window.onclick = function(event) {
            if (event.target == errorModal) {
                errorModal.style.display = "none";
            } else if (event.target == notmatchModal) {
                nomatchModal.style.display = "none";
            }
            else if (event.target == successfulModal) {
                successfulModal.style.display = "none";
            }
        }

        // Trigger the appropriate modal based on PHP variable
        <?php if ($addError == 1) : ?>
            errorModal.style.display = "block";
        <?php elseif ($addError == 2) : ?>
            successfulModal.style.display = "block";
            <?php elseif ($addError == 3) : ?>
                nomatchModal.style.display = "block";
        <?php endif; ?>
    </script>

</body>

</html>