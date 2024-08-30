<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
include "./report-utility.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}

// Query for "Placed" students
$sql_placed = "SELECT COUNT(DISTINCT s.S_College_Email) as count
               FROM student as s
               INNER JOIN jobapplication as ja ON ja.S_College_Email = s.S_College_Email
               INNER JOIN jobplacements as jp ON jp.J_id = ja.J_id
               INNER JOIN jobdepartments as jd ON jd.J_id = ja.J_id
               INNER JOIN department as d ON jd.Dept_id = d.Dept_id
               WHERE ja.placed = 1 AND jp.J_Due_date < CURRENT_DATE";

$result_placed = $conn->query($sql_placed);
$placed_count = ($result_placed->num_rows > 0) ? $result_placed->fetch_assoc()['count'] : 0;

// Query for "Not Placed" students
$sql_not_placed = "SELECT COUNT(DISTINCT s.S_College_Email) as count
                   FROM student as s
                   INNER JOIN jobapplication as ja ON ja.S_College_Email = s.S_College_Email
                   INNER JOIN jobplacements as jp ON jp.J_id = ja.J_id
                   INNER JOIN jobdepartments as jd ON jd.J_id = ja.J_id
                   INNER JOIN department as d ON jd.Dept_id = d.Dept_id
                   WHERE ja.placed = 0 AND jp.J_Due_date < CURRENT_DATE";

$result_not_placed = $conn->query($sql_not_placed);
$not_placed_count = ($result_not_placed->num_rows > 0) ? $result_not_placed->fetch_assoc()['count'] : 0;


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
                        <!-- <p><strong>Total Number of students who were Eligible</strong>: <?php echo $Eligible['count']; ?></p>
                        <p><strong>Total Number of students who Applied</strong>: <?php echo $Interested['count']; ?></p>
                        <p><strong>Total Number of students Placed</strong>: <?php echo $Placed['count']; ?></p>
                        <p><strong>Total Number of students Not Placed</strong>: <?php echo $Rejected['count']; ?></p> -->
                        <canvas id="myPieChart"></canvas>
                        <script>
                            const placedCount = <?php echo json_encode($placed_count); ?>;
                            const notPlacedCount = <?php echo json_encode($not_placed_count); ?>;

                            const ctx = document.getElementById('myPieChart').getContext('2d');
                            const myPieChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: ['Placed', 'Not Placed'],
                                    datasets: [{
                                        data: [placedCount, notPlacedCount],
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
                        <p><strong>Total Offers </strong> 20</p>
                        <p><strong>Highest Salary </strong> 2000000</p>
                        <p><strong>Average Salary </strong> 150000</p>
                        <p><strong>Lowest Salary </strong> 150000</p>

                        <canvas id="myBarChart"></canvas>
                        <script>
                            // Get the canvas element by its ID
                            var cta = document.getElementById('myBarChart').getContext('2d');

                            // Create a new Chart instance
                            var salaryBarChart = new Chart(cta, {
                                type: 'bar', // Specify the chart type as bar
                                data: {
                                    labels: ['COMP', 'MECH', 'ECS', 'CIVIL'], // X-axis labels (e.g., company names)
                                    datasets: [{
                                            label: 'Highest Salary', // Label for the highest salary dataset
                                            data: [90000, 75000, 82000, 60000], // Data for the highest salaries
                                            backgroundColor: 'rgba(54, 162, 235, 0.7)', // Color for the highest salary bars
                                            borderColor: 'rgba(54, 162, 235, 1)', // Border color for the highest salary bars
                                            borderWidth: 1
                                        },
                                        {
                                            label: 'Lowest Salary', // Label for the lowest salary dataset
                                            data: [50000, 42000, 45000, 20000], // Data for the lowest salaries
                                            backgroundColor: 'rgba(255, 99, 132, 0.7)', // Color for the lowest salary bars
                                            borderColor: 'rgba(255, 99, 132, 1)', // Border color for the lowest salary bars
                                            borderWidth: 1
                                        },
                                        {
                                            label: 'Average Salary', // Label for the average salary dataset
                                            data: [70000, 60000, 65000, 40000], // Data for the average salaries
                                            backgroundColor: 'rgba(255, 206, 86, 0.7)', // Color for the average salary bars
                                            borderColor: 'rgba(255, 206, 86, 1)', // Border color for the average salary bars
                                            borderWidth: 1
                                        }
                                    ]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true // Start the y-axis at zero
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                    <div class="sections-1">
                        <canvas id="myDoubleBarChart"></canvas>
                        <script>
                            // Get the canvas element by its ID
                            var cty = document.getElementById('myDoubleBarChart').getContext('2d');

                            // Create a new Chart instance
                            var myDoubleBarChart = new Chart(cty, {
                                type: 'bar', // Specify the chart type
                                data: {
                                    labels: ['COMP', 'MECH', 'ECS', 'CIVIL'], // X-axis labels
                                    datasets: [{
                                            label: 'Total Students Registered', // Label for the first dataset
                                            data: [12, 19, 3, 5, 2, 3], // Data for the first dataset
                                            backgroundColor: 'rgba(75, 192, 192, 0.7)', // Bar color for the first dataset
                                            borderColor: 'rgba(75, 192, 192, 1)', // Border color for the first dataset
                                            borderWidth: 1
                                        },
                                        {
                                            label: 'Total Students PLaced', // Label for the second dataset
                                            data: [8, 15, 6, 10, 5, 7], // Data for the second dataset
                                            backgroundColor: 'rgba(153, 102, 255, 0.7)', // Bar color for the second dataset
                                            borderColor: 'rgba(153, 102, 255, 1)', // Border color for the second dataset
                                            borderWidth: 1
                                        }
                                    ]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true // Start the y-axis at zero
                                        },
                                        x: {
                                            stacked: false, // Prevent stacking; each group will appear side-by-side

                                        }
                                    }
                                }
                            });
                        </script>


                    </div>
                    <div class="sections-1">
                        <canvas id="mySidebarChart" width="400" height="200"></canvas>
                        <script>
                            // Get the canvas element by its ID
                            var ctz = document.getElementById('mySidebarChart').getContext('2d');

                            // Create a new Chart instance
                            var mySidebarChart = new Chart(ctz, {
                                type: 'bar', // Specify the chart type as bar
                                data: {
                                    labels: ['Girls', 'Boys'], // Y-axis labels
                                    datasets: [{
                                        label: 'Total Students Placed', // Label for the dataset
                                        data: [12, 19], // Data for the dataset
                                        backgroundColor: [
                                            'rgba(255, 87, 51, 0.7)', // Color for Girls
                                            'rgba(51, 196, 255, 0.7)' // Color for Boys
                                        ],
                                        borderColor: [
                                            'rgba(255, 87, 51, 1)', // Border color for Girls
                                            'rgba(51, 196, 255, 1)' // Border color for Boys
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    indexAxis: 'y', // Set the index axis to 'y' for a horizontal bar chart
                                    scales: {
                                        x: {
                                            beginAtZero: true // Start the x-axis at zero
                                        },
                                        y: {
                                            stacked: false // Keep bars side-by-side rather than stacked
                                        }
                                    }
                                }
                            });
                        </script>


                    </div>

                </div>
                <h3>Company Reports:</h3>
                <div class="sections section-container">
                    <div class="form-adjust">
                        <form action="" method="post">
                            <div class="batch-container">
                                <label for=""><strong>Company: </strong></label>
                                <select name=" " id=" ">
                                    <option value="" selected>Select Company</option>
                                    <option value="">Bliss Company</option>
                                    <option value="">IVP</option>
                                    <option value="">One Shield</option>
                                </select>
                            </div>
                            <button name="get-filter-report" class="add-button">Get Report</button>
                        </form>
                    </div>
                    <div class="section-1">

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