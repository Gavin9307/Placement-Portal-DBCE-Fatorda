<?php
    require "../restrict.php";
    require "../restrict_placement_coordinator.php";
    require "../utility_functions.php";
    require "../conn.php";
    global $conn;
    if (!isset($_SESSION)) {
        session_start();
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/my-applications.css">
    <title>My Applications</title>
</head>
<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    My Applications</h2>
                    <?php 
                    getApplications();
                ?>

                
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>