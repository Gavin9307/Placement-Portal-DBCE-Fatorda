<?php
    require "../conn.php";
    require "../restrict.php";
    include "../utility_functions.php";
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
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Notifications</h2>

                <?php getNotifications(); ?>

            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>