<?php
    require "../conn.php";
    // require "../restrict.php";
    include "./tpo-utitlity-functions.php";
    global $conn;
    if (!isset($_SESSION)) {
        session_start();
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/notifications.css">
    <title>Notifications</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Notifications</h2>
                    <a href="./notification-post.php"><button class="add-button">Post Notifications</button></a>    
                </div>
                <div class="sections">
                    <div class="company-container">
                        <p><strong>Date:</strong> 12/12/2003</p>
                        <p><strong>Time:</strong> 6:24pm</p>
                    </div>
                    <p class="subject"><strong>Subject:</strong> Round 1 for Google Location updated</p>
                    <p class= "subject"><strong>Message:</strong> Lorem ipsum dolor sit amet consectetur. Tellus mauris blandit sagittis ligula sollicitudin elit. Quam integer ac scelerisque amet fermentum fringilla lacus urna. Iaculis sit quam</p>
                    <p class= ""><strong>Attachment :</strong> </p>
                    <p class= "message"><strong>Attachment :</strong> </p>
                    <a href=""><button class="edit-button">Edit</button></a>
                    <a href=""><button class="delete-button">Delete</button></a>
                </div>

            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>