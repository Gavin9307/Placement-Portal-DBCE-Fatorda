<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}


$studentSearch = false;
$d_studentSearch = false;

if (isset($_POST["student-search-button"])) {
    $sname = !empty($_POST['sname']) ? $_POST['sname'] : null;
    $departments = !empty($_POST['departments']) ? $_POST['departments'] : [];
    $gender = !empty($_POST['gender']) ? $_POST['gender'] : null;
    $batch = !empty($_POST['batch_year']) ? $_POST['batch_year'] : null;

    $studentsResult = fetchStudents(false, $sname, $departments, $gender,$batch);
    $studentSearch = true;
} else {
    $studentsResult = fetchStudents(false);
}

if (isset($_POST["d_student-search-button"])) {
    $d_sname = !empty($_POST['d_sname']) ? $_POST['d_sname'] : null;
    $d_departments = !empty($_POST['d_departments']) ? $_POST['d_departments'] : [];
    $d_gender = !empty($_POST['d_gender']) ? $_POST['d_gender'] : null;
    $d_batch = !empty($_POST['d_batch_year']) ? $_POST['d_batch_year'] : null;
    $d_studentsResult = fetchStudents(true, $d_sname, $d_departments, $d_gender,$d_batch);
    $d_studentSearch = true;
} else {
    $d_studentsResult = fetchStudents(true);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/job-post-questions.css">
    <title>Add Departments </title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading">
                        <a href="./dashboard.php">
                            <i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i>
                        </a>
                        Departments
                    </h2>
                </div>

                <h3>Add Department</h3>
                <div class="form-adjust">
                    <form action="" method="post">
                        <div class="inputbox">
                            <label for=""><b>Department Name:</b></label>
                            <input type="text" name="sname" placeholder="Department">
                        </div>



                        <div class="button-container">
                            <button name="student-search-button" class="add-button">Add</button>
                        </div>
                    </form>
                </div>
                <div class="sections">
                    <table>
                        <tr>
                            <th>Department Name</th>
                            <th>Edit Department Name</th>
                            <th>Remove</th>
                        </tr>
                        <tr>
                            <td>COMP</td>
                            <td><button class="edit-button">Edit</button></td>
                            <td><button class="remove-button">Remove</button></td>
                        </tr>
                        <tr>
                            <td>MECH</td>
                            <td><button class="edit-button">Edit</button></td>
                            <td><button class="remove-button">Remove</button></td>
                        </tr>
                        <tr>
                            <td>ECS</td>
                            <td><button class="edit-button">Edit</button></td>
                            <td><button class="remove-button">Remove</button></td>
                        </tr>
                        <tr>
                            <td>CIVIL</td>
                            <td><button class="edit-button">Edit</button></td>
                            <td><button class="remove-button">Remove</button></td>
                        </tr>
                    </table>
                </div>
               <!--<div class="button-container">
                    <a href="./student-management-search-students.php"><button class="viewmore-button">View More</button></a>
                </div> -->                         
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>
</body>
</html>