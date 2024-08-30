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

$report_Query = "SELECT  CONCAT_WS(' ', s.S_Fname, s.S_Mname, s.S_Lname) AS `Name`,d.Dept_name AS `Department`,  com.C_Name AS `Company`,  IFNULL(j.J_Offered_salary, 0) AS `Offered Salary`, j.J_Due_date AS `Joining Date`, com.C_Location AS `Location`, s.S_Year_of_Admission + 4 AS `Batch` FROM student AS s INNER JOIN class AS c ON c.Class_id = s.S_Class_id INNER JOIN  department AS d ON d.Dept_id = c.Dept_id INNER JOIN jobapplication AS ja ON ja.S_College_Email = s.S_College_Email INNER JOIN jobplacements AS j ON j.J_id = ja.J_id INNER JOIN jobposting AS jp ON jp.J_id = j.J_id INNER JOIN company AS com ON com.C_id = jp.C_id WHERE ja.placed = 1 AND j.J_Due_date < CURRENT_DATE";


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
    $spreadsheetId = '1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0';
    $range = 'students_details!B7:Z'; // Adjust range as needed to cover all possible cells

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

    header("Location: https://docs.google.com/spreadsheets/d/1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0");
    exit();
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
                        
                    </div>

                    <div class="sections-1">
                        
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