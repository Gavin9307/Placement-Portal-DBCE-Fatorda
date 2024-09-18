<?php
require "../conn.php";
require "../restrict.php";
require "../restrict_student.php";
include "./tpo-utility-functions.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}
// 0-pending  1-error  2-success
$addError = 0 ;
if (!isset($_GET["nid"])) {
    header("Location: ./notifications.php");
    exit();
}

$nid = (int)$_GET["nid"];

if (isset($_POST["update-button"])) {
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $due_date = $_POST["due_date"];

    // Directory to store attachments
    $uploadDir = "../Data/Notifications/";

    // Fetch current attachments to possibly delete later
    $fetchNotiQuery = "SELECT Attachment1, Attachment2 FROM notificationdetails WHERE Notification_ID = ?";
    $fetchNoti = $conn->prepare($fetchNotiQuery);
    $fetchNoti->bind_param("i", $nid);
    $fetchNoti->execute();
    $result = $fetchNoti->get_result();
    $row = $result->fetch_assoc();

    $attachment1 = $row['Attachment1'];
    $attachment2 = $row['Attachment2'];

    // Handle Attachment1 deletion
    if (isset($_POST['delete_attachment1']) && $_POST['delete_attachment1'] == 'yes') {
        if ($attachment1 && file_exists($uploadDir . $attachment1)) {
            unlink($uploadDir . $attachment1);
        }
        $attachment1 = null;
    }

    // Handle Attachment2 deletion
    if (isset($_POST['delete_attachment2']) && $_POST['delete_attachment2'] == 'yes') {
        if ($attachment2 && file_exists($uploadDir . $attachment2)) {
            unlink($uploadDir . $attachment2);
        }
        $attachment2 = null;
    }

    // Handle Attachment1 upload
    if (isset($_FILES["attachment1"]) && $_FILES["attachment1"]["error"] == 0) {
        if ($attachment1 && file_exists($uploadDir . $attachment1)) {
            unlink($uploadDir . $attachment1);
        }
        $attachment1 = "notification_" . $nid . "_attachment_1." . pathinfo($_FILES["attachment1"]["name"], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["attachment1"]["tmp_name"], $uploadDir . $attachment1);
    }

    // Handle Attachment2 upload
    if (isset($_FILES["attachment2"]) && $_FILES["attachment2"]["error"] == 0) {
        if ($attachment2 && file_exists($uploadDir . $attachment2)) {
            unlink($uploadDir . $attachment2);
        }
        $attachment2 = "notification_" . $nid . "_attachment_2." . pathinfo($_FILES["attachment2"]["name"], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["attachment2"]["tmp_name"], $uploadDir . $attachment2);
    }

    $updateNotiQuery = "UPDATE notificationdetails 
                        SET Subject = ?, Message = ?, Attachment1 = ?, Attachment2 = ?, Notification_Due_Date = ?
                        WHERE Notification_ID = ?";
    $result = $conn->prepare($updateNotiQuery);
    $result->bind_param("sssssi", $subject, $message, $attachment1, $attachment2, $due_date, $nid);
    $result->execute();
    header("Location: ./notifications-edit.php?nid=".$nid);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php'; ?>
    <link rel="stylesheet" href="./css/notifications-edit.css">
    <title>Edit Notifications</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php'; ?>

        <div class="container">
            <?php include './sidebar.php'; ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading">
                        <a href="./notifications.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                        Edit Notifications
                    </h2>
                </div>

                <div class="sections">
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php
                        $fetchNotiQuery = "SELECT Subject, Message, Attachment1, Attachment2, Notification_Due_Date 
                                           FROM notificationdetails
                                           WHERE Notification_ID = ?";
                        $fetchNoti = $conn->prepare($fetchNotiQuery);
                        $fetchNoti->bind_param("i", $nid);
                        $fetchNoti->execute();
                        $result = $fetchNoti->get_result();
                        $row = $result->fetch_assoc();
                        ?>

                        <div class="inputbox">
                            <h3>Due Date:</h3>
                            <input type="date" name="due_date" value="<?php echo $row['Notification_Due_Date']; ?>">
                        </div><br>
                        <div class="inputbox">
                            <h3>Attachment 1:</h3>
                            <input type="file" name="attachment1">
                            <?php if ($row['Attachment1']): ?>
                                <p>Current file: <a style="color:blue;" href="<?php echo $uploadDir . basename($row['Attachment1']); ?>" target="_blank"><?php echo basename($row['Attachment1']); ?></a></p>
                                <p style="color:red;">Delete Attachment: <input style="width: 20px;" type="checkbox" name="delete_attachment1" value="yes"></p>
                            <?php endif; ?>
                        </div><br>
                        <div class="inputbox">
                            <h3>Attachment 2:</h3>
                            <input type="file" name="attachment2">
                            <?php if ($row['Attachment2']): ?>
                                <p>Current file: <a style="color:blue;" href="<?php echo $uploadDir . basename($row['Attachment2']); ?>" target="_blank"><?php echo basename($row['Attachment2']); ?></a></p>
                                <p style="color:red;">Delete Attachment: <input style="width: 20px;" type="checkbox" name="delete_attachment2" value="yes"></p>
                            <?php endif; ?>
                        </div><br>
                        <h3>Subject:</h3>
                        <textarea name="subject" class="textarea-position"><?php echo $row['Subject']; ?></textarea><br>
                        <h3>Message:</h3>
                        <textarea name="message" class="textarea-message"><?php echo $row['Message']; ?></textarea><br>
                        <button type="submit" name="update-button" class="update-button">Update</button>
                    </form>
                </div>
            </div>
        </div>

        <?php include './footer.php'; ?>
    </div>
    <!-- Modals -->
    <div id="error" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>There was an Error while updating the Notification</p>
        </div>
    </div>

    <div id="successful" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>The notification has been updated  successfully</p>
        </div>
    </div>
    <script>
        // Get the modals
        var errorModal = document.getElementById("error");
        var successfulModal = document.getElementById("successful");

        // Get the <span> elements that close the modals
        var closeButtons = document.getElementsByClassName("close");

        // Close the modal when the user clicks on <span> (x)
        for (var i = 0; i < closeButtons.length; i++) {
            closeButtons[i].onclick = function() {
                errorModal.style.display = "none";
                successfulModal.style.display = "none";
            }
        }

        // Close the modal when the user clicks anywhere outside of the modal
        window.onclick = function(event) {
            if (event.target == errorModal) {
                errorModal.style.display = "none";
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
        <?php endif; ?>
    </script>
</body>

</html>
