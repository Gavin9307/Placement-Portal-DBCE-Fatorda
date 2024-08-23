<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>

    <link rel="stylesheet" href="./css/dashboard.css">
    <title>Dashboard</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading">Dashboard</h2>
                <br>
                <h3>Calendar</h3>
                <div class="dashboard-calendar">
                    <!-- <iframe src="<?php // echo 'https://calendar.google.com/calendar/embed?src='.$_SESSION["user_email"].'&ctz=Asia%2FKolkata'; 
                                        ?>" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe> -->
                    <iframe src="https://calendar.google.com/calendar/embed?src=fernandespierson03%40gmail.com&ctz=Asia%2FKolkata" style="border: 0;" width="1000" height="600" frameborder="0" scrolling="no"></iframe>
                </div>

                <div class="sections">
                    <h3>Company Management</h3>
                    <div class="sub-sections performance">
                        <div class="right1"><a href="./company.php"><i class=" fa-solid fa-chevron-right fa-2x" style="color: #000000;"></i></a>
                        </div>
                        <p>Total Companies : <?php echo getTotalCompanies(); ?></p>
                    </div>
                </div>

                <div class="sections">
                    <h3>Job Management</h3>
                    <div class="sub-sections performance">
                        <div class="right1"><a href="./job-management.php"><i class=" fa-solid fa-chevron-right fa-2x" style="color: #000000;"></i></a>
                        </div>
                        <p>Live Opportunities : <?php echo getTotalLiveJobs(); ?></p>
                        <p>Completed Opportunities : <?php echo getTotalCompletedJobs(); ?></p>
                    </div>
                </div>
                <div class="sections">
                    <h3>Placement Coordinators</h3>
                    <div class="sub-sections performance">
                        <div class="right1"><a href="./Placement-Coordinator.php"><i class=" fa-solid fa-chevron-right fa-2x" style="color: #000000;"></i></a>
                        </div>
                        <p>Total Coordinators : <?php echo getTotalPlacementCoordinators(); ?></p>
                    </div>
                </div>
            </div>


        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>