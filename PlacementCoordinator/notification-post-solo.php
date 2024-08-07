<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_GET["sname"]) || !isset($_GET["semail"])) {
    echo "<script>
        window.location.href = document.referrer;
    </script>";
    exit();
}

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
        $notiUpdate->execute();
        $notiUpdate->close();

        $studentEmail = $_GET['semail'];
        $studentNotiInsertQuery = "INSERT INTO studentnotifications (Notification_ID, S_College_Email) VALUES (?, ?)";
        $studentNotiInsert = $conn->prepare($studentNotiInsertQuery);
        $studentNotiInsert->bind_param("is", $notificationId, $studentEmail);
        $studentNotiInsert->execute();
        $studentNotiInsert->close();
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
                    <h2 class="main-container-heading"><button style="all: unset;cursor:pointer;" onclick="history.back()">
                            <i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i>
                        </button>
                        Notifications</h2>
                </div>

                <div class="sections">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h3>To <?php echo $_GET["sname"] ?>:</h3>
                        <div class="form-adjust">
                            <div class="inputbox">
                                <label for="">Due Date</label>
                                <input type="date" name="due_date">
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

</body>

</html>