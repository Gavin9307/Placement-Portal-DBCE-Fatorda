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
    <link rel="stylesheet" href="./css/eligible-students-details.css">
    <title>Eligible Student Details</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                        Eligible Students</h2>
                </div>
                <div class="eligible-company">
                    <!-- <h3>Nimish Noronha</h3> -->
                    <div class="company-container">
                        <p>Google</p>
                    </div>
                </div>
                <div class="sections">
                    <div class="section-details">
                    <p><strong>Name:  </strong>Nimish Noronha</p>
                    <p><strong>Department:  </strong>MECH</p>
                    <p><strong>Class:  </strong>TE MECH</p>
                    <p><strong>Contact Number:  </strong>9876541230</p>
                    <p><strong>Email Id:  </strong>2114056@dbcegoa.ac.in</p>
                    </div>
                    <div class="section-img">
                    <img src="../Assets/profile.jpg" alt="">
                    <div class="button-container">
                    <a href="#"><button class="send-message-button">Send Message</button></a>
                    </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>