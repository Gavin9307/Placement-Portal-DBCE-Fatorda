<?php
require "../conn.php";
require "../restrict.php";
include "../utility_functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST["update_profile"])) {
    $updateQuery = "UPDATE student as s SET s.S_Fname = ?,s.S_Mname = ?,s.S_Lname = ?,s.S_Personal_Email = ?,s.S_Address = ?,s.S_Phone_no = ?,s.S_10th_Perc = ?,s.S_12th_Perc = ?
    WHERE s.S_College_Email = ?";
    $result = $conn->prepare($updateQuery);
    $result->bind_param("ssssssdds", $_POST["fname"], $_POST["mname"], $_POST["lname"], $_POST["pemail"], $_POST["addr"], $_POST["phno"], $_POST["per10"], $_POST["per12"], $_SESSION["user_email"]);
    $result->execute();

    $_SESSION['profile_updated'] = true;
    echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>

    <link rel="stylesheet" href="update-profile.css">
    <title>Enter Details</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <div class="header-container">
                <div class="left-part">
                    <img src="./Assets/dbce-logo.jpeg" alt="" class="logo">
                    <h2>Placement Portal - Don Bosco College of Engineering</h2>
                </div>
                <ul class="right-part">
                    <a href="./index.php">
                        <li>Home</li>
                    </a>
                </ul>
            </div>
        </header>
        <main>
            <div class="main-container">
            <h3>Edit Profile :</h3>
                <?php
                echo '<form action="" method="post" enctype="multipart/form-data" class="profile-image">
                   <img src="../Data/Students/Profile_Images/" alt="Profile Picture" id="profile-image">
                    <input type="file" name="profile-picture" id="profile-picture-input" style="display:none;">
                    <div class="upload-button-container">
                        <button type="button" onclick="document.getElementById(\'profile-picture-input\').click();" class="change-picture">Select Picture</button>
                        <button type="submit" name="upload" class="change-picture">Upload Picture</button>
                    </div>
                </form>';
                ?>
                <div class="sections">
                    <form action="" method="post">
                        <h3>Personal Information:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="fname">First Name</label><br>
                                <input type="text" name="fname">
                            </div>
                            <div>
                                <label for="mname">Middle Name</label><br>
                                <input type="text" name="mname">
                            </div>
                            <div>
                                <label for="lname">Last Name</label><br>
                                <input type="text" name="lname">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="phno">Contact No</label><br>
                                <input type="text" name="phno">
                            </div>
                            <div>
                                <label for="addr">Address</label><br>
                                <input type="text" name="addr">
                            </div>
                            <div>
                                <label for="pemail">Personal Email</label><br>
                                <input type="text" name="pemail">
                            </div>
                        </div>

                        <h3>College Information:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="cemail">College Email</label><br>
                                <input type="text" name="cemail">
                            </div>
                            <div>
                                <label for="prn">PR No.</label><br>
                                <input type="text" name="prn">
                            </div>

                            <div>
                                <label for="rollno">Roll No.</label><br>
                                <input type="text" name="rollno">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="class">Class</label><br>
                                <input type="text" name="class">
                            </div>

                            <div>
                                <label for="department">Department</label><br>
                                <input type="text" name="department">
                            </div>
                        </div>
                        <h3>Other Information:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="per10">10th Percentage</label><br>
                                <input type="number" name="per10" step="0.01" min="0" max="100">
                            </div>

                            <div>
                                <label for="per12">12th Percentage</label><br>
                                <input type="number" name="per12" step="0.01" min="0" max="100">
                            </div>
                        </div>

                        <h3>Results:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="sem1">Sem 1</label><br>
                                <input type="number" name="sem1" step="0.01" min="0" max="10" >
                            </div>

                            <div>
                                <label for="sem2">Sem 2</label><br>
                                <input type="number" name="sem2" step="0.01" min="0" max="10">
                            </div>
                            <div>
                                <label for="sem3">Sem 3</label><br>
                                <input type="number" name="sem3" step="0.01" min="0" max="10">
                            </div>

                            <div>
                                <label for="sem4">Sem 4</label><br>
                                <input type="number" name="sem4" step="0.01" min="0" max="10">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="sem5">Sem 5</label><br>
                                <input type="number" name="sem5" step="0.01" min="0" max="10">
                            </div>

                            <div>
                                <label for="sem6">Sem 6</label><br>
                                <input type="number" name="sem6" step="0.01" min="0" max="10">
                            </div>
                            <div>
                                <label for="sem7">Sem 7</label><br>
                                <input type="number" name="sem7" step="0.01" min="0" max="10">
                            </div>

                            <div>
                                <label for="sem8">Sem 8</label><br>
                                <input type="number" name="sem8" step="0.01" min="0" max="10">
                            </div>
                        </div>
                        <div class="form-adjust cgpa">
                            <div>
                                <label for="cgpa">CGPA</label><br>
                                <input type="number" name="cgpa" step="0.01" min="0" max="10" step="0.01" min="0" max="10">
                            </div>
                            <div>
                                <label for="backs">Do you have any backlogs?</label><br>
                                <select name="backs" id="">
                                    <option value="0" selected>No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>

                        <button id="myBtn" name="update_profile">Update</button>

                        <div id="myModal" class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <p>Your Profile has been updated successfully</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </main>
        <?php include 'footer.php' ?>
    </div>
</body>
<script defer src="./FontAwesome/JS/all.js"></script>

</html>