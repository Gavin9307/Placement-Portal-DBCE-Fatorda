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

    $studentsResult = fetchStudentsAll(false, $sname, $departments, $gender,$batch);
    $studentSearch = true;
} else {
    $studentsResult = fetchStudentsAll(false);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/student-management.css">
    <title>Student Management</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="./dashboard.html"><a href="./student-management.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a></a>
                        Student Management</h2>
                </div>


                <h3>Student Search</h3>
                <div class="form-adjust">

                    <form action="" method="post">
                        <div class="inputbox">
                            <label for="">Student Name:</label>
                            <input type="text" name="sname" placeholder="Enter Student Name">
                        </div>

                        <div class="departmentbox">
                            <label for="">Department:</label>
                            <div class="Checkbox">
                                <?php
                                $fetchDepartmentQuery = "SELECT Dept_name as dname FROM department;";
                                $fetchDepartment = $conn->prepare($fetchDepartmentQuery);
                                $fetchDepartment->execute();
                                $result = $fetchDepartment->get_result();

                                while ($row = $result->fetch_assoc()) {
                                    echo '<div>
                                            <input name="departments[]" value="' . htmlspecialchars($row["dname"]) . '" type="checkbox">
                                            <label for="">' . htmlspecialchars($row["dname"]) . '</label>
                                          </div>';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="inputbox">
                            <label for="batch_year">Batch Year:</label>
                            <select name="batch_year" id="batch_year">
                                <option value="" selected>Select Batch</option>
                                <?php
                                $currentYear = date('Y');
                                for ($year = $currentYear + 4; $year >= 2000 + 4; $year--) {
                                    echo '<option value="' . $year . '">' . $year . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="inputbox">
                            <label for="">Gender:</label>
                            <select name="gender" id="">
                                <option value="" selected>Select</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="search-button-container">
                            <button name="student-search-button" class="search-button">Search</button>
                        </div>
                    </form>

                </div>
                <div class="sections">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Batch</th>
                            <th>Department</th>
                            <th>Class</th>
                            <th>Details</th>
                        </tr>
                        <?php
                        while ($student = $studentsResult->fetch_assoc()) {
                            echo '<tr>
                                <td>' . htmlspecialchars($student["fname"]) . ' ' . htmlspecialchars($student["lname"]) . '</td>
                                <td>' . (int) htmlspecialchars($student["yoa"])+4 . '</td>
                                <td>' . htmlspecialchars($student["dname"]) . '</td>
                                <td>' . htmlspecialchars($student["cname"]) . '</td>
                                <td><a href="student-management-view-student.php?semail=' . $student["semail"] . '">View more</a></td>
                            </tr>';
                        }
                        ?>
                    </table>
                </div>

            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>