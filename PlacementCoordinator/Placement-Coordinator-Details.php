<?php
require "../conn.php";
require "../restrict.php";
include "../utility_functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_GET["pcemail"])) {
    header("Location: ./Placement-Coordinator.php");
    exit();
}


$fetchStudentQuery = "";
$fetchStudent = $conn->prepare($fetchStudentQuery);
$fetchStudent->bind_param("s", $_SESSION["user_email"]);
$fetchStudent->execute();
$result = $fetchStudent->get_result();

if ($result->num_rows > 0) {
    $StudentInfo = $result->fetch_assoc();
    $StudentFName = htmlspecialchars($StudentInfo['fname']);
    $StudentMName = htmlspecialchars($StudentInfo['mname']);
    $StudentLName = htmlspecialchars($StudentInfo['lname']);
    $StudentAddress = htmlspecialchars($StudentInfo['address']);
    $StudentMarksheet_12 = htmlspecialchars($StudentInfo['marksheet_12']);
    $StudentMarksheet_10 = htmlspecialchars($StudentInfo['marksheet_10']);
    $StudentPercentage_10 = htmlspecialchars($StudentInfo['percentage_10']);
    $StudentPercentage_12 = htmlspecialchars($StudentInfo['percentage_12']);
    $StudentPEmail = htmlspecialchars($StudentInfo['pemail']);
    $StudentCEmail = htmlspecialchars($StudentInfo['cemail']);
    $StudentClass = htmlspecialchars($StudentInfo['class']);
    $StudentDepartment = htmlspecialchars($StudentInfo['department']);
    $StudentYOA = htmlspecialchars($StudentInfo['yoa']);
    $StudentImage = htmlspecialchars($StudentInfo['image']);
    $StudentRollNo = htmlspecialchars($StudentInfo['rollno']);
    $StudentPhoneNo = htmlspecialchars($StudentInfo['phoneno']);
    $StudentPRN = htmlspecialchars($StudentInfo['prno']);
    $StudentResume = htmlspecialchars($StudentInfo['resume']);
    $StudentSem1 = htmlspecialchars($StudentInfo['sem1']);
    $StudentSem2 = htmlspecialchars($StudentInfo['sem2']);
    $StudentSem3 = htmlspecialchars($StudentInfo['sem3']);
    $StudentSem4 = htmlspecialchars($StudentInfo['sem4']);
    $StudentSem5 = htmlspecialchars($StudentInfo['sem5']);
    $StudentSem6 = htmlspecialchars($StudentInfo['sem6']);
    $StudentSem7 = htmlspecialchars($StudentInfo['sem7']);
    $StudentSem8 = htmlspecialchars($StudentInfo['sem8']);
    $StudentCGPA = htmlspecialchars($StudentInfo['cgpa']);
    $StudentBacks = htmlspecialchars($StudentInfo['backs']);
} else {
    // Handle case where results are not obtained
}


if (isset($_POST["update_profile"])) {
    $updateQuery = "UPDATE student as s SET s.S_Fname = ?,s.S_Mname = ?,s.S_Lname = ?,s.S_Personal_Email = ?,s.S_Address = ?,s.S_Phone_no = ?,s.S_10th_Perc = ?,s.S_12th_Perc = ?
    WHERE s.S_College_Email = ?";
    $result = $conn->prepare($updateQuery);
    $result->bind_param("ssssssdds", $_POST["fname"], $_POST["mname"], $_POST["lname"], $_POST["pemail"], $_POST["addr"], $_POST["phno"], $_POST["per10"], $_POST["per12"], $_SESSION["user_email"]);
    $result->execute();

    $_SESSION['profile_updated'] = true;
    echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
    exit();
}

if (isset($_POST["upload_pic"])) {
    $uploadDirectory = '../Data/Students/Profile_Images/';

    $fetchStudentQuery = "SELECT S_Roll_no as rollno, S_Profile_pic as profile_pic FROM student WHERE S_College_Email = ?;";
    $fetchStudent = $conn->prepare($fetchStudentQuery);
    $fetchStudent->bind_param("s", $_SESSION["user_email"]);
    $fetchStudent->execute();
    $result = $fetchStudent->get_result();
    $row = $result->fetch_assoc();
    $rollno = $row["rollno"];
    $currentProfilePic = $row["profile_pic"];

    if ($_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
        $tmpName = $_FILES['profile_pic']['tmp_name'];
        $fileName = basename($_FILES['profile_pic']['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpeg', 'jpg', 'png'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = $rollno . '.' . $fileExtension;
            $destination = $uploadDirectory . $newFileName;

            if ($currentProfilePic && $currentProfilePic != 'Default_Profile_Pic.jpg' && file_exists($uploadDirectory . $currentProfilePic)) {
                unlink($uploadDirectory . $currentProfilePic);
            }

            if (move_uploaded_file($tmpName, $destination)) {
                $UploadPicQuery = "UPDATE student SET S_Profile_pic = ? WHERE S_College_Email = ?";
                $UploadPic = $conn->prepare($UploadPicQuery);
                $UploadPic->bind_param("ss", $newFileName, $_SESSION["user_email"]);
                $UploadPic->execute();

                if ($UploadPic->affected_rows > 0) {
                    // echo "Profile picture updated successfully.";
                } else {
                    // echo "Failed to update profile picture in the database.";
                }
            } else {
                // echo "Failed to move the uploaded file.";
            }
        } else {
            // echo "Invalid file type. Only jpeg, jpg, and png are allowed.";
        }
    } else {
        // echo "File upload error: " . $_FILES['profile_pic']['error'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/placement-coordinator-details.css">
    <title>Placement Coordinator details</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>
        <div class="container">
            <?php include './sidebar.php' ?>
            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Profile : </h2>
                <?php
                echo '
                <form action="./my-profile.php" method="post" enctype="multipart/form-data" class="profile-image">
                    <img src="../Data/Students/Profile_Images/' . $StudentImage . '" alt="Profile Picture" id="profile-image">
                    <div class="upload-button-container">
                        <input type="file" name="profile_pic">
                        <button type="submit" name="upload_pic" class="change-picture">Upload Picture</button>
                    </div>
                </form>';
                ?>
                <div class="sections">
                    <form action="./my-profile.php" method="post">
                        <h3>Personal Information:</h3>
                        <?php
                        echo '<div class="form-adjust">
                            <div>
                                <label for="fname">First Name</label><br>
                                <input type="text" name="fname" value="' . $StudentFName . '">
                            </div>
                            <div>
                                <label for="mname">Middle Name</label><br>
                                <input type="text" name="mname" value="' . $StudentMName . '">
                            </div>
                            <div>
                                <label for="lname">Last Name</label><br>
                                <input type="text" name="lname" value="' . $StudentLName . '">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="phno">Contact No</label><br>
                                <input type="text" name="phno" value="' . $StudentPhoneNo . '">
                            </div>
                           
                            <div>
                                <label for="pemail">Personal Email</label><br>
                                <input type="text" name="pemail" value="' . $StudentPEmail . '">
                            </div>
                        </div>';
                        ?>

                        <h3>Change Password:</h3>

                        <?php
                        echo '<div class="form-adjust">
                            <div>
                                <label for="newpass">New Password</label><br>
                                <input type="password" name="newpass">
                            </div>

                            <div>
                                <label for="newpassconfirm">Confirm Password</label><br>
                                <input type="password" name="newpassconfirm">
                            </div>
                        </div>

                        <div class="form-adjust cgpa">
    
                            <div>
                                <label for="backs">Status</label><br>
                                <select name="backs" id="">';
                        if ($StudentBacks == "0") {
                            echo '<option value="0" selected>No</option>
                         <option value="1">Yes</option>
                                </select>
                        </div> 
                        </div>';
                        } else {
                            echo '<option value="0">No</option>
                         <option value="1" selected>Yes</option>
                                </select>
                        </div> 
                        </div>';
                        }

                        ?>
                        <button id="myBtn" name="update_profile">Update</button>

                        <div id="myModal" class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <p>Your Profile has been updated successfully</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        <?php
        // If the profile was updated, show the modal
        if (isset($_SESSION['profile_updated']) && $_SESSION['profile_updated']) {
            echo 'modal.style.display = "block";';
            // Unset the session variable so the modal doesn't show again on refresh
            unset($_SESSION['profile_updated']);
        }
        ?>
    </script>
</body>

</html>