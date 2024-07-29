<?php
    require "../conn.php";
    require "../restrict.php";
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
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Job Management</h2>
                    <a href="./job-post.php"><button class="add-button">Post a Job</button></a>    
                </div>
                <h3>Live Listings</h3>
                

                <?php 
                    getLiveJobListings();
                ?>
                

                <h3>Completed Listings</h3>
                <div class="sections">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Company</th>
                        <th>Students Placed</th>
                        <th>Details</th>
                    </tr>
                    <tr>
                        <td>12/12/23</td>
                        <td>Google</td>
                        <td>2</td>
                        <td><a href="">View more</a></td>
                    </tr>
                    <tr>
                        <td>24/12/23</td>
                        <td>IBM</td>
                        <td>9</td>
                        <td><a href="">View more</a></td>
                    </tr>
                    <tr>
                        <td>24/12/23</td>
                        <td>IBM</td>
                        <td>9</td>
                        <td><a href="">View more</a></td>
                    </tr>
                    <tr>
                        <td>24/12/23</td>
                        <td>IBM</td>
                        <td>9</td>
                        <td><a href="">View more</a></td>
                    </tr>
                </table>
                <div class="button-container">
                <a href="./notification-post.php"><button class="viewmore-button">View More</button></a>
                </div>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>