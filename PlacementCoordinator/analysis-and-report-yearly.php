<?php
require "../conn.php";
require "../restrict.php";
require "../restrict_student.php";
include "./tpo-utility-functions.php";
include "./report-utility.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}

// Query for "Placed" students
$sql_placed21 = "SELECT COUNT(*) as count
FROM student s 
INNER JOIN class c ON s.S_Class_id = c.Class_id  
INNER JOIN department d ON c.Dept_id = d.Dept_id
WHERE s.PLACED = 1 ";

$sql_not_placed = "SELECT COUNT(*) as count
FROM student s 
INNER JOIN class c ON s.S_Class_id = c.Class_id  
INNER JOIN department d ON c.Dept_id = d.Dept_id
WHERE s.PLACED = 0 ";

$sqlFemale = "SELECT COUNT(*) as count
FROM student s 
INNER JOIN class c ON s.S_Class_id = c.Class_id  
INNER JOIN department d ON c.Dept_id = d.Dept_id
WHERE s.PLACED = 1 AND s.Gender = 'F'";

$sqlMale = "SELECT COUNT(*) as count
FROM student s 
INNER JOIN class c ON s.S_Class_id = c.Class_id  
INNER JOIN department d ON c.Dept_id = d.Dept_id
WHERE s.PLACED = 1 AND s.Gender = 'M'";

$sqlSalaries = "SELECT 
AVG(jp.J_Offered_salary) AS Average_Salary,
    MAX(jp.J_Offered_salary) AS Highest_Salary,
    MIN(jp.J_Offered_salary) AS Minimum_Salary
FROM jobplacements as jp 
INNER JOIN jobapplication as ja ON jp.J_id = ja.J_id
INNER JOIN student as s on s.S_College_Email = ja.S_College_Email
INNER JOIN class as c on c.Class_id=s.S_Class_id
INNER JOIN department d ON d.Dept_id=c.Dept_id
WHERE ja.placed = 1 ";

$sqlDepartments = "SELECT 
    d.Dept_name AS Department, 
    AVG(jp.J_Offered_salary) AS Average_Salary, 
    MAX(jp.J_Offered_salary) AS Highest_Salary, 
    MIN(jp.J_Offered_salary) AS Minimum_Salary 
FROM 
    jobplacements AS jp 
INNER JOIN 
    jobapplication AS ja ON jp.J_id = ja.J_id 
INNER JOIN 
    student AS s ON s.S_College_Email = ja.S_College_Email 
INNER JOIN 
    class AS c ON c.Class_id = s.S_Class_id 
INNER JOIN 
    department AS d ON d.Dept_id = c.Dept_id 
WHERE 
    ja.placed = 1 ";

$sql_placed = "
SELECT 
    d.Dept_name AS Department,
    COUNT(*) as Total_Placed_Students
FROM 
    student s
INNER JOIN class c ON s.S_Class_id = c.Class_id  
INNER JOIN department d ON c.Dept_id = d.Dept_id
WHERE s.PLACED = 1";


$sql_registered = "
SELECT 
    d.Dept_name AS Department,
    COUNT(s.S_College_Email) AS Total_Registered_Students
FROM 
    student s
JOIN 
    class c ON s.S_Class_id = c.Class_id
JOIN 
    department d ON c.Dept_id = d.Dept_id
WHERE 
    s.registration_complete = 1";





// Assuming the email is stored in the session
$student_email = $_SESSION['user_email'];

$report_Query = "SELECT  CONCAT_WS(' ', s.S_Fname, s.S_Mname, s.S_Lname) AS `Name`,d.Dept_name AS `Department`,  com.C_Name AS `Company`,  IFNULL(j.J_Offered_salary, 0) AS `Offered Salary`, j.J_Due_date AS `Joining Date`, com.C_Location AS `Location`, s.S_Year_of_Admission + 4 AS `Batch` FROM student AS s INNER JOIN class AS c ON c.Class_id = s.S_Class_id INNER JOIN  department AS d ON d.Dept_id = c.Dept_id INNER JOIN jobapplication AS ja ON ja.S_College_Email = s.S_College_Email INNER JOIN jobplacements AS j ON j.J_id = ja.J_id INNER JOIN jobposting AS jp ON jp.J_id = j.J_id INNER JOIN company AS com ON com.C_id = jp.C_id WHERE ja.placed = 1 AND j.J_Due_date > CURRENT_DATE";

if (isset($_POST["get-filter-report"])) {
    // Apply filters if set
    if (!empty($_POST['d_batch_year'])) {
        $batch_year = (int)$_POST['d_batch_year'] - 4;
        $report_Query .= " AND s.S_Year_of_Admission = '$batch_year'";
        $sql_placed21 .= " AND s.S_Year_of_Admission = '$batch_year'";
        $sql_not_placed .= " AND s.S_Year_of_Admission = '$batch_year'";
        $sqlFemale .= " AND s.S_Year_of_Admission = '$batch_year'";
        $sqlMale .= " AND s.S_Year_of_Admission = '$batch_year'";
        $sql_placed .= " AND s.S_Year_of_Admission = '$batch_year' ";
        $sql_registered .= " AND s.S_Year_of_Admission = '$batch_year' ";
    }

    if (!empty($_POST['departments'])) {
        $departments = $_POST['departments'];
        $departmentList = implode("','", array_map('htmlspecialchars', $departments));
        $report_Query .= " AND d.Dept_name IN ('$departmentList')";
        $sql_placed21 .= " AND d.Dept_name IN ('$departmentList')";
        $sql_not_placed .= " AND d.Dept_name IN ('$departmentList')";
        $sqlFemale .= " AND d.Dept_name IN ('$departmentList')";
        $sqlMale .= " AND d.Dept_name IN ('$departmentList')";
        $sqlSalaries .= " AND d.Dept_name IN ('$departmentList')";
        $sqlDepartments .= " AND d.Dept_name IN ('$departmentList')";
        $sql_placed .= " AND d.Dept_name IN ('$departmentList')";
        $sql_registered .= " AND d.Dept_name IN ('$departmentList')";
    }
    $sqlDepartments .= " GROUP BY d.Dept_name";
    $sql_placed .= " GROUP BY d.Dept_id";
    $sql_registered .= " GROUP BY d.Dept_id";
} else {
    $sqlDepartments .= " GROUP BY d.Dept_name";
    $sql_placed .= " GROUP BY d.Dept_id";
    $sql_registered .= " GROUP BY d.Dept_id";
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


$result_placed = $conn->query($sql_placed21);
$placed_count = ($result_placed->num_rows > 0) ? $result_placed->fetch_assoc()['count'] : 0;

// Query for "Not Placed" students


$result_not_placed = $conn->query($sql_not_placed);
$not_placed_count = ($result_not_placed->num_rows > 0) ? $result_not_placed->fetch_assoc()['count'] : 0;

// SQL query to get the count of placed female students


$resultFemale = $conn->query($sqlFemale);
$femaleCount = 0; // Default value
if ($resultFemale->num_rows > 0) {
    $rowFemale = $resultFemale->fetch_assoc();
    $femaleCount = $rowFemale['count'];
}

// SQL query to get the count of placed male students


$resultMale = $conn->query($sqlMale);
$maleCount = 0; // Default value
if ($resultMale->num_rows > 0) {
    $rowMale = $resultMale->fetch_assoc();
    $maleCount = $rowMale['count'];
}
// SQL query to get the average, highest, and minimum salary

$resultSalaries = $conn->query($sqlSalaries);

$averageSalary = $highestSalary = $minimumSalary = 0; // Default values

if ($resultSalaries->num_rows > 0) {
    $rowSalaries = $resultSalaries->fetch_assoc();
    $averageSalary = $rowSalaries['Average_Salary'];
    $highestSalary = $rowSalaries['Highest_Salary'];
    $minimumSalary = $rowSalaries['Minimum_Salary'];
}
// SQL query to fetch salary data by department

$resultDepartments = $conn->query($sqlDepartments);

// Initialize arrays to store department names and salary data
$departments = [];
$highestSalaries = [];
$lowestSalaries = [];
$averageSalaries = [];

// Fetch data and populate the arrays
if ($resultDepartments->num_rows > 0) {
    while ($row = $resultDepartments->fetch_assoc()) {
        $departments[] = $row['Department']; // Store department name
        $highestSalaries[] = $row['Highest_Salary']; // Store highest salary
        $lowestSalaries[] = $row['Minimum_Salary']; // Store lowest salary
        $averageSalaries[] = $row['Average_Salary']; // Store average salary
    }
}

// Query to get total placed students


$result_placed = $conn->query($sql_placed);
$placed_students = [];
$departments = [];

while ($row = $result_placed->fetch_assoc()) {
    $departments[] = $row['Department'];
    $placed_students[] = $row['Total_Placed_Students'];
}

// Query to get total registered students


$result_registered = $conn->query($sql_registered);
$registered_students = [];

while ($row = $result_registered->fetch_assoc()) {
    $registered_students[] = $row['Total_Registered_Students'];
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/analysis-and-report-yearly.css">
    <title>Analysis and Reports</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
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
                    <div>
                        <p><strong>Total Number of students Placed</strong>: <?php echo $placed_count; ?></p>
                        <p><strong>Total Number of students Not Placed</strong>: <?php echo $not_placed_count; ?></p>
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div>
                        <p><strong>Highest Salary: </strong><?php echo $highestSalary; ?></p>
                        <p><strong>Average Salary: </strong><?php echo $averageSalary; ?></p>
                        <p><strong>Lowest Salary: </strong><?php echo $minimumSalary; ?></p><br><br>
                        <canvas id="myBarChart"></canvas>
                    </div>
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
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    tooltip: {
                                        enabled: true,
                                    },
                                    // Enable DataLabels plugin to display values
                                    datalabels: {
                                        color: '#000', // Set label color
                                        font: {
                                            weight: 'bold',
                                            size: 14 // You can adjust the size
                                        },
                                        formatter: (value, context) => {
                                            return value; // Display the value directly
                                        }
                                    }
                                },
                                animation: {
                                    animateScale: true,
                                    animateRotate: true
                                }
                            },
                            plugins: [ChartDataLabels] // Register the DataLabels plugin
                        });
                    </script>
                    <script>
                        // Get the PHP arrays into JavaScript
                        var departments = <?php echo json_encode($departments); ?>;
                        var highestSalaries = <?php echo json_encode($highestSalaries); ?>;
                        var lowestSalaries = <?php echo json_encode($lowestSalaries); ?>;
                        var averageSalaries = <?php echo json_encode($averageSalaries); ?>;


                        // Get the canvas element by its ID
                        var cta = document.getElementById('myBarChart').getContext('2d');

                        // Create a new Chart instance
                        var salaryBarChart = new Chart(cta, {
                            type: 'bar', // Specify the chart type as bar
                            data: {
                                labels: departments, // X-axis labels from PHP
                                datasets: [{
                                        label: 'Highest Salary',
                                        data: highestSalaries, // Data for the highest salaries from PHP
                                        backgroundColor: 'rgba(54, 162, 235, 0.7)', // Color for the highest salary bars
                                        borderColor: 'rgba(54, 162, 235, 1)', // Border color for the highest salary bars
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Lowest Salary',
                                        data: lowestSalaries, // Data for the lowest salaries from PHP
                                        backgroundColor: 'rgba(255, 99, 132, 0.7)', // Color for the lowest salary bars
                                        borderColor: 'rgba(255, 99, 132, 1)', // Border color for the lowest salary bars
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Average Salary',
                                        data: averageSalaries, // Data for the average salaries from PHP
                                        backgroundColor: 'rgba(255, 206, 86, 0.7)', // Color for the average salary bars
                                        borderColor: 'rgba(255, 206, 86, 1)', // Border color for the average salary bars
                                        borderWidth: 1
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    datalabels: {
                                        color: '#000', // Set label color to white
                                        font: {
                                            weight: 'bold',
                                            size: 12 // Adjust font size
                                        },
                                        anchor: 'end', // Position the labels at the end of each bar
                                        align: 'center', // Align labels to the top of the bars
                                        rotation: 0, // Rotate the labels by 90 degrees for vertical display
                                        formatter: (value, context) => {
                                            return value; // Display the value directly on the bars
                                        }
                                    },
                                    tooltip: {
                                        enabled: true // Ensure tooltips are enabled
                                    },
                                    legend: {
                                        position: 'top' // Position the legend at the top
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true // Start the y-axis at zero
                                    }
                                }
                            },
                            plugins: [ChartDataLabels] // Register the DataLabels plugin
                        });
                    </script>
                </div>


                <div class="sections section-container">
                    <div>
                        <canvas id="myDoubleBarChart"></canvas>
                    </div>
                    <div>
                        <canvas id="mySidebarChart"></canvas>
                    </div>
                    <script>
                        // Convert PHP arrays to JavaScript arrays
                        var departments = <?php echo json_encode($departments); ?>;
                        var totalPlacedStudents = <?php echo json_encode($placed_students); ?>;
                        var totalRegisteredStudents = <?php echo json_encode($registered_students); ?>;

                        // Declare the chart variable globally
                        var myDoubleBarChart;

                        // Function to render the chart
                        function renderChart() {
                            // Get the canvas element by its ID
                            var cty = document.getElementById('myDoubleBarChart').getContext('2d');

                            // If chart exists, destroy it first to prevent flickering
                            if (myDoubleBarChart) {
                                myDoubleBarChart.destroy();
                            }

                            // Create the chart
                            myDoubleBarChart = new Chart(cty, {
                                type: 'bar',
                                data: {
                                    labels: departments, // X-axis labels
                                    datasets: [{
                                            label: 'Total Students Registered',
                                            data: totalRegisteredStudents,
                                            backgroundColor: 'rgba(75, 192, 192, 0.7)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1
                                        },
                                        {
                                            label: 'Total Students Placed',
                                            data: totalPlacedStudents,
                                            backgroundColor: 'rgba(153, 102, 255, 0.7)',
                                            borderColor: 'rgba(153, 102, 255, 1)',
                                            borderWidth: 1
                                        }
                                    ]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        datalabels: {
                                            color: '#000',
                                            font: {
                                                weight: 'bold',
                                                size: 12
                                            },
                                            anchor: 'end',
                                            align: 'center',
                                            formatter: (value) => {
                                                return value;
                                            }
                                        },
                                        tooltip: {
                                            enabled: true
                                        },
                                        legend: {
                                            position: 'top'
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        },
                                        x: {
                                            stacked: false
                                        }
                                    }
                                },
                                plugins: [ChartDataLabels] // Register the DataLabels plugin
                            });
                        }

                        // Call the function to render the chart
                        renderChart();
                    </script>
                    <script>
                        // PHP variable integration
                        var femaleCount = <?php echo $femaleCount; ?>; // Count for Girls
                        var maleCount = <?php echo $maleCount; ?>; // Count for Boys

                        // Get the canvas element by its ID
                        var ctz = document.getElementById('mySidebarChart').getContext('2d');

                        // Create a new Chart instance
                        var mySidebarChart = new Chart(ctz, {
                            type: 'bar', // Specify the chart type as bar
                            data: {
                                labels: ['Girls', 'Boys'], // Y-axis labels
                                datasets: [{
                                    label: 'Total Students Placed',
                                    data: [femaleCount, maleCount], // Use the fetched counts for Girls and Boys
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
                                maintainAspectRatio: false, // Prevents aspect ratio from shrinking the chart
                                responsive: true,
                                indexAxis: 'y', // Set the index axis to 'y' for a horizontal bar chart
                                plugins: {
                                    datalabels: {
                                        color: '#000', // Set the label color to white
                                        font: {
                                            weight: 'bold',
                                            size: 12 // Adjust font size
                                        },
                                        anchor: 'center', // Position the labels at the end of each bar
                                        align: 'center', // Align the labels to the right of the bars
                                        formatter: (value) => {
                                            return value; // Display the value on the bar
                                        }
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                                            }
                                        }
                                    },
                                    legend: {
                                        position: 'top' // Position the legend at the top
                                    }
                                },
                                scales: {
                                    x: {
                                        beginAtZero: true // Start the x-axis at zero
                                    }
                                }
                            },
                            plugins: [ChartDataLabels] // Register the DataLabels plugin
                        });
                    </script>
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
                            echo '<tr >
                                                    <td colspan=6>No Student Data Found</td>
                                                </tr>';
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
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>