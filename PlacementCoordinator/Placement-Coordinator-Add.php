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
    <link rel="stylesheet" href="./css/placement-coordinator-details.css">
    <title>Placement Coordinator details</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>
        <div class="container">
            <?php include './sidebar.php' ?>
            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Add Placement Coordinator :</h2>
                <div class="sections">
                    <form action="./my-profile.php" method="post">
                        <h3>Personal Information:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="fname">First Name</label><br>
                                <input type="text" name="fname" value="' . $StudentFName . '">
                            </div>
                            <div>
                                <label for="mname">Middle Name</label><br>
                                <input type="text" name="mname" value="' . $StudentMName . '">
                            </div>
                            <div>
                                <label for="lname">Last Name</label><br>
                                <input type="text" name="lname" value="' . $StudentLName . '">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="phno">Contact No</label><br>
                                <input type="text" name="phno" value="' . $StudentPhoneNo . '">
                            </div>

                            <div>
                                <label for="pemail">Personal Email</label><br>
                                <input type="text" name="pemail" value="' . $StudentPEmail . '">
                            </div>
                        </div>

                        <h3>Change Password:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="newpass">New Password</label><br>
                                <input type="password" name="newpass">
                            </div>

                            <div>
                                <label for="newpassconfirm">Confirm Password</label><br>
                                <input type="password" name="newpassconfirm">
                            </div>
                        </div>

                        <button id="myBtn" name="update_profile">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>