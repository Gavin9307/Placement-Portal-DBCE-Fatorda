<?php
require "../conn.php";
require "../restrict.php";
require "../restrict_student.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST["delete-listing"])) {

    $deleteJobQuery = "DELETE FROM jobdepartments WHERE J_id = ?";
    $deleteJob = $conn->prepare($deleteJobQuery);
    $deleteJob->bind_param("i", $_POST["jid"]);
    if ($deleteJob->execute()) {
        $deleteJobQuery = "DELETE FROM jobplacements WHERE J_id = ?";
        $deleteJob = $conn->prepare($deleteJobQuery);
        $deleteJob->bind_param("i", $_POST["jid"]);
        if ($deleteJob->execute()) {
            echo "success";
        } else {
            echo "failed";
        }
    } else {
        echo "failed";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/job-management.css">
    <title>Job Management</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="./job-management.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                        Job Management</h2>
                </div>
                <h3>Completed Listings</h3>
                <div class="sections">
                    <table>
                        <tr>
                            <th>Date</th>
                            <th>Company</th>
                            <th>Students Placed</th>
                            <th>Details</th>
                        </tr>
                        <?php getCompletedJobListingsAll(); ?>

                    </table>
                    <!-- <div class="button-container">
                        <a href="./notification-post.php"><button class="viewmore-button">View More</button></a>
                    </div> -->
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>