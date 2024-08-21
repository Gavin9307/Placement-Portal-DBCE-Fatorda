<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
include "./report-utility.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}



// Assuming the email is stored in the session
$student_email = $_SESSION['user_email'];
// Initialize counts with default values
$Eligible = ['count' => 0];
$Interested = ['count' => 0];
$Rejected = ['count' => 0];
$Placed = ['count' => 0];

// Base query for all students eligible
$base_sql = "SELECT COUNT(DISTINCT ja.S_College_Email) as count
             FROM jobapplication as ja 
             INNER JOIN jobplacements as jp ON jp.J_id = ja.J_id
             INNER JOIN student as s ON s.S_College_Email = ja.S_College_Email
             INNER JOIN jobdepartments as jd ON jd.J_id = ja.J_id
             INNER JOIN department as d ON jd.Dept_id = d.Dept_id
             WHERE jp.J_Due_date < CURRENT_DATE";

$base_company_sql = "SELECT COUNT(DISTINCT ja.S_College_Email) as count
             FROM jobapplication as ja 
             INNER JOIN jobplacements as jp ON jp.J_id = ja.J_id
             INNER JOIN student as s ON s.S_College_Email = ja.S_College_Email
             INNER JOIN jobdepartments as jd ON jd.J_id = ja.J_id
             INNER JOIN department as d ON jd.Dept_id = d.Dept_id
             WHERE jp.J_Due_date < CURRENT_DATE";

$report_Query = "SELECT  CONCAT_WS(' ', s.S_Fname, s.S_Mname, s.S_Lname) AS `Name`,d.Dept_name AS `Department`,  com.C_Name AS `Company`,  IFNULL(j.J_Offered_salary, 0) AS `Offered Salary`, j.J_Due_date AS `Joining Date`, com.C_Location AS `Location`, s.S_Year_of_Admission + 4 AS `Batch` FROM student AS s INNER JOIN class AS c ON c.Class_id = s.S_Class_id INNER JOIN  department AS d ON d.Dept_id = c.Dept_id INNER JOIN jobapplication AS ja ON ja.S_College_Email = s.S_College_Email INNER JOIN jobplacements AS j ON j.J_id = ja.J_id INNER JOIN jobposting AS jp ON jp.J_id = j.J_id INNER JOIN company AS com ON com.C_id = jp.C_id WHERE ja.placed = 1 AND j.J_Due_date < CURRENT_DATE";


if (isset($_POST["get-filter-report"])) {
    // Apply filters if set
    if (!empty($_POST['d_batch_year'])) {
        $batch_year = (int)$_POST['d_batch_year'] - 4;
        $base_sql .= " AND s.S_Year_of_Admission = '$batch_year'";
        $report_Query .= " AND s.S_Year_of_Admission = '$batch_year'";
    }

    if (!empty($_POST['departments'])) {
        $departments = $_POST['departments'];
        $departmentList = implode("','", array_map('htmlspecialchars', $departments));
        $base_sql .= " AND d.Dept_name IN ('$departmentList')";
        $report_Query .= " AND d.Dept_name IN ('$departmentList')";
    }

    // Queries for different categories
    $sqlEligible = $base_sql;  // Default query for eligible students
    $sqlInterested = $base_sql . " AND ja.interest = 1";
    $sqlRejected = $base_sql . " AND ja.placed = 0 AND ja.interest = 1";
    $sqlPlaced = $base_sql . " AND ja.placed = 1 AND ja.interest = 1";

    // Execute queries and fetch results
    $resultEligible = mysqli_query($conn, $sqlEligible);
    $resultInterested = mysqli_query($conn, $sqlInterested);
    $resultRejected = mysqli_query($conn, $sqlRejected);
    $resultPlaced = mysqli_query($conn, $sqlPlaced);



    if ($resultEligible && mysqli_num_rows($resultEligible) > 0) {
        $Eligible = mysqli_fetch_assoc($resultEligible);
    }

    if ($resultInterested && mysqli_num_rows($resultInterested) > 0) {
        $Interested = mysqli_fetch_assoc($resultInterested);
    }

    if ($resultRejected && mysqli_num_rows($resultRejected) > 0) {
        $Rejected = mysqli_fetch_assoc($resultRejected);
        $was_not_passed_json = $Rejected['count'];
    } else {
        $was_not_passed_json = 0;
    }

    if ($resultPlaced && mysqli_num_rows($resultPlaced) > 0) {
        $Placed = mysqli_fetch_assoc($resultPlaced);
        $was_passed_json = $Placed['count'];
    } else {
        $was_passed_json = 0;
    }
} else {
    $sqlEligible = $base_sql;
    $sqlInterested = $base_sql . " AND ja.interest = 1";
    $sqlRejected = $base_sql . " AND ja.placed = 0 AND ja.interest = 1";
    $sqlPlaced = $base_sql . " AND ja.placed = 1 AND ja.interest = 1";


    $resultEligible = mysqli_query($conn, $sqlEligible);
    $resultInterested = mysqli_query($conn, $sqlInterested);
    $resultRejected = mysqli_query($conn, $sqlRejected);
    $resultPlaced = mysqli_query($conn, $sqlPlaced);



    if ($resultEligible && mysqli_num_rows($resultEligible) > 0) {
        $Eligible = mysqli_fetch_assoc($resultEligible);
    }

    if ($resultInterested && mysqli_num_rows($resultInterested) > 0) {
        $Interested = mysqli_fetch_assoc($resultInterested);
    }

    if ($resultRejected && mysqli_num_rows($resultRejected) > 0) {
        $Rejected = mysqli_fetch_assoc($resultRejected);
        $was_not_passed_json = $Rejected['count'];
    } else {
        $was_not_passed_json = 0;
    }

    if ($resultPlaced && mysqli_num_rows($resultPlaced) > 0) {
        $Placed = mysqli_fetch_assoc($resultPlaced);
        $was_passed_json = $Placed['count'];
    } else {
        $was_passed_json = 0;
    }
}

if (isset($_POST["get-report-students"])) {
    $sql = urldecode($_POST['query']);
    echo "<pre>" . htmlspecialchars($sql) . "</pre>";
    $result = $conn->query($sql);

    // Prepare data for Google Sheets as an array
    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = array_values($row); // Convert row associative array to a simple array
        }
    }

    // Specify the spreadsheet ID and range
    $spreadsheetId = '1tV0U_6Lxomb-tT6ruU9eX2veKjht5-0W84xSh9AvZvU';
    $range = 'Sheet1!A5:Z'; // Adjust range as needed to cover all possible cells

    // Clear the existing content in the range
    try {
        $clearResponse = $service->spreadsheets_values->clear($spreadsheetId, $range, new \Google_Service_Sheets_ClearValuesRequest());
    } catch (Exception $e) {
        echo 'Error clearing sheet: ' . $e->getMessage();
        exit();
    }

    // Prepare the request body to update the sheet
    $body = new \Google_Service_Sheets_ValueRange([
        'values' => $data
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED' // or 'RAW' depending on your need
    ];

    // Update the sheet with new data
    try {
        $response = $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
        printf("%d cells updated.", $response->getUpdatedCells());
    } catch (Exception $e) {
        echo 'Error updating sheet: ' . $e->getMessage();
        exit();
    }

    // Download the updated sheet as a PDF or Excel file
    try {
        $exportMimeType = 'application/pdf'; // or use 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' for Excel

        $exportedFile = $driveService->files->export($spreadsheetId, $exportMimeType, ['alt' => 'media']);

        // Set the appropriate headers for file download
        header('Content-Type: ' . $exportMimeType);
        header('Content-Disposition: attachment; filename="report.pdf"'); // or 'report.xlsx' for Excel

        // Output the file to the browser
        echo $exportedFile->getBody();
        exit();
    } catch (Exception $e) {
        echo 'Error downloading sheet: ' . $e->getMessage();
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/analysis-and-report-yearly.css">
    <title>Analysis and Reports</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <p><strong>Total Number of students who were Eligible</strong>: <?php echo $Eligible['count']; ?></p>
                        <p><strong>Total Number of students who Applied</strong>: <?php echo $Interested['count']; ?></p>
                        <p><strong>Total Number of students Placed</strong>: <?php echo $Placed['count']; ?></p>
                        <p><strong>Total Number of students Rejected</strong>: <?php echo $Rejected['count']; ?></p>
                        <canvas id="myPieChart"></canvas>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            const ctx = document.getElementById('myPieChart').getContext('2d');
                            const myPieChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: ['Placed', 'Rejected'],
                                    datasets: [{
                                        data: [<?php echo $was_passed_json; ?>, <?php echo $was_not_passed_json; ?>],
                                        backgroundColor: ['#FF6384', '#36A2EB'],
                                        hoverBackgroundColor: ['#FF6384', '#36A2EB']
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                        tooltip: {
                                            enabled: true,
                                        }
                                    },
                                    animation: {
                                        animateScale: true,
                                        animateRotate: true
                                    }
                                }
                            });
                        </script>
                    </div>

                    <div class="sections-1">
                        <p><strong>Total Number of Companies</strong>: 20</p>
                        <p><strong>Companies That hired</strong>: 8</p>
                        <canvas id="myPieChart1" style="width: 50%; height: 150px;"></canvas>
                        <script>
                            const cty = document.getElementById('myPieChart1').getContext('2d');
                            const myPieChart1 = new Chart(cty, {
                                type: 'pie',
                                data: {
                                    labels: ['Was Eligible', 'Was Not Eligible'],
                                    datasets: [{
                                        data: [<?php echo $was_eligible_json; ?>, <?php echo $was_not_eligible_json; ?>],
                                        backgroundColor: ['#FF6384', '#36A2EB'],
                                        hoverBackgroundColor: ['#FF6384', '#36A2EB']
                                    }]
                                },
                                options: {
                                    responsive: true,

                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                        tooltip: {
                                            enabled: true,
                                        }
                                    },
                                    animation: {
                                        animateScale: true,
                                        animateRotate: true
                                    }
                                }
                            });
                        </script>
                    </div>


                </div>

                <div class="sortby-container">
                    <h3><strong>Student Details</strong></h3>
                    <!-- <div>
                        <label for=""><strong>Sort-By</strong></label>
                        <select name="" id="">
                            <option value="">Date: Latest to Oldest</option>
                            <option value="">Date: Oldest to Latest</option>
                            <option value="">Department</option>
                            <option value="">Offered Salary: High to Low</option>
                            <option value="">Offered Salary: Low to High</option>
                        </select>
                    </div> -->
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
                        <?php

                        $reportExcel = mysqli_query($conn, $report_Query);
                        if (mysqli_num_rows($reportExcel) > 0) {
                            while ($reportExcelRow = mysqli_fetch_assoc($reportExcel)) {
                                echo '<tr>
                                                    <td>' . $reportExcelRow["Name"] . '</td>
                                                    <td>' . $reportExcelRow["Department"] . '</td>
                                                    <td>' . $reportExcelRow["Company"] . '</td>
                                                    <td>' . $reportExcelRow["Offered Salary"] . '</td>
                                                    <td>' . $reportExcelRow["Joining Date"] . '</td>
                                                    <td><a href="">View more</a></td>
                                                </tr>';
                            }
                        } else {
                            echo "No results Found";
                        }
                        ?>


                    </table>
                    <div class="button-container-1">
                        <div class="dropdown">
                        <form action="" method="post">
                            <input type="text" value="<?php echo urlencode($report_Query); ?>" name="query" hidden>
                            <button name="get-report-students" class="download-button">Get report</button>
                        </form>


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