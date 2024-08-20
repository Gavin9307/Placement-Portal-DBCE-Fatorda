<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
// include "./report-utility.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}

if(isset($_POST["get-filter-report"])){
    $sql = "SELECT COUNT(DISTINCT ja.S_College_Email)
            FROM jobapplication as ja 
            INNER JOIN jobplacements as jp ON jp.J_id = ja.J_id
            INNER JOIN student as s ON s.S_College_Email = ja.S_College_Email
            INNER JOIN jobdepartments as jd ON jd.J_id = ja.J_id
            WHERE jp.J_Due_date < CURRENT_DATE";

    // Check if a batch year is selected
    if (!empty($_POST['d_batch_year'])) {
        $batch_year = (int)$_POST['d_batch_year'] - 4;
        $sql .= " AND s.S_Year_of_Admission = '$batch_year'";
    }

    // Check if any departments are selected
    if (!empty($_POST['departments'])) {
        $departments = $_POST['departments'];
        $departmentList = implode("','", array_map('htmlspecialchars', $departments));
        $sql .= " AND jd.Dept_name IN ('$departmentList')";
    }

    $interestedSql = $sql .= " AND ja.interest=1;";
    $rejectedSql = $sql .= " AND ja.interest=1 AND ja.placed = 0;";
    $passedSql = $sql .= " AND ja.interest=1 AND ja.placed = 1;";

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/analysis-and-report-yearly.css">
    <title>Analysis and Reports</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./analysis-and-report.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Analysis and Reports</h2>
                <h3>Yearly Placement Drive Reports</h3>
                <div class="sections">
                    <div class="form-adjust">
                        <form action="" method="post">
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
                            <button name="get-filter-report" class="add-button">Get Report</button>
                        </form>
                    </div>
                </div>
                <div class="sections section-container">

                    <div class="sections-1">
                        <p><strong>Total Number of students</strong>: 100</p>
                        <p><strong>Total Number of students Placed</strong>: 20</p>
                        <iframe class="responsive-iframe" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQwj2XQEskPgLtqr0YpmTsA4eb36sbaUt16rtthRpDURHxbVRPVZVkr-icApfmjR0Lv0WiMdjeGzFEV/pubchart?oid=1931950964&amp;format=interactive"></iframe>
                    </div>
                    <div class="sections-1">
                        <p><strong>Total Number of Companies</strong>: 20</p>
                        <p><strong>Companies That hired</strong>: 8</p>
                        <iframe class="responsive-iframe" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQwj2XQEskPgLtqr0YpmTsA4eb36sbaUt16rtthRpDURHxbVRPVZVkr-icApfmjR0Lv0WiMdjeGzFEV/pubchart?oid=1931950964&amp;format=interactive"></iframe>
                    </div>


                </div>

                <div class="sortby-container">
                    <h3><strong>Student Details</strong></h3>
                    <div>
                        <label for=""><strong>Sort-By</strong></label>
                        <select name="" id="">
                            <option value="">Date: Latest to Oldest</option>
                            <option value="">Date: Oldest to Latest</option>
                            <option value="">Department</option>
                            <option value="">Offered Salary: High to Low</option>
                            <option value="">Offered Salary: Low to High</option>
                        </select>
                    </div>
                </div>
                <div class="sections">

                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Company</th>
                            <th>Offered Salary</th>
                            <th>Joining Date</th>
                            <th>Details</th>
                        </tr>
                        <tr>
                            <td>Nimish</td>
                            <td>Comp</td>
                            <td>Google</td>
                            <td>30,000</td>
                            <td>2/3/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                        
                    </table>
                    <div class="button-container-1">
                        <div class="dropdown">
                            <button class="download-button">Download</button>
                            <div class="dropdown-content">
                                <a href="https://docs.google.com/spreadsheets/d/1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0/export?format=csv&id=1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0">Download as CSV</a>
                                <a href="https://docs.google.com/spreadsheets/d/1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0/export?format=pdf&id=1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0">Download as PDF</a>
                                <a href="https://docs.google.com/spreadsheets/d/1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0/export?format=xlsx&id=1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0">Download as Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
                <h3>Other Reports:</h3>
                <div class="button-container-2">
                    <a href="./analysis-and-report-company-report.php"><button class="add-button">Company Report</button></a>
                    <a href="./notification-post.php"><button class="add-button">Student Report</button></a>
                    <a href="./notification-post.php"><button class="add-button">Alumini Report</button></a>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>