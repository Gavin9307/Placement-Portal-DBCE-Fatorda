<?php
require "../conn.php";
require "../restrict.php";
require "../restrict_student.php";
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
    <link rel="stylesheet" href="./css/analysis-and-report.css">
    <title>Analysis and Reports</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Analysis and Reports</h2>

                <h3>Yearly Placement Drive Reports</h3>
                <div class="sections">
                    <form action="">
                        <div class="form-adjust">
                            <!-- <div class="datebox">
                                <div>
                                    <label for=""><strong>From:</strong> </label>
                                    <input name="dateStart" type="date">
                                </div>
                                <div>
                                    <label for=""><strong>To:</strong> </label>
                                    <input name="dateEnd" type="date">
                                </div>
                            </div> -->
                            <div class="batch-container">

                                <label for=""><strong>Batch: </strong></label>
                                <select name="d_batch_year" id="d_batch_year">
                                <option value="" selected>Select Batch</option>
                                <?php
                                $currentYear = date('Y');
                                for ($year = $currentYear + 4; $year >= 2016 + 4; $year--) {
                                    echo '<option value="' . $year . '">' . $year . '</option>';
                                }
                                ?>
                            </select>

                            </div>
                            <div class="departmentbox">
                                <label for=""><strong>Department: </strong></label>
                                <div class="Checkbox">
                                <?php
                                    global $conn;
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
                            <a href="./analysis-and-report-yearly.php"><button class="add-button">Get Report</button></a>
                        </div>
                    </form>

                </div>
                <h3>Other Reports:</h3>
                <div class="button-container-2">
                    <a href="./analysis-and-report-company-report.php"><button class="add-button">Company Report</button></a>
                    <a href="./analysis-and-report-student-report.php"><button class="add-button">Student Report</button></a>
                    <a href="./alumni-report.php"><button class="add-button">Alumini Report</button></a>
                </div>
            </div>
        </div>
    </div>

    <?php include './footer.php' ?>
    </div>

</body>

</html>