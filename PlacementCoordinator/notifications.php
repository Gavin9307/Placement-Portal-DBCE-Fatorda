<?php
    require "../conn.php";
    require "../restrict.php";
    include "./tpo-utility-functions.php";
    global $conn;
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_POST['delete_noti'])){
        $nid = (int)$_POST['nid'];
        $deleteNotificationQuery = "DELETE N FROM notificationdetails N 
WHERE N.Notification_ID = ?;";
        $deleteNotification = $conn->prepare($deleteNotificationQuery);
        $deleteNotification->bind_param("i", $nid);
        $deleteNotification->execute();
        unset($_POST['delete_noti']);
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
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Notifications</h2>
                    <a href="./notification-post.php"><button class="add-button">Post Notifications</button></a>    
                </div>
                <?php getTpoNotifications(); ?>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>