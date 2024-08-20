<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
// include "./report-utility.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}
// Assuming the email is stored in the session
$student_email = $_SESSION['user_email'];

// Fetch the number of jobs the student was eligible for
$query_eligible = "SELECT COUNT(jp.J_id) as eligible_count 
                   FROM jobplacements as jp
                   INNER JOIN jobdepartments as jd ON jd.J_id = jp.J_id
                   INNER JOIN jobapplication as ja ON ja.J_id = jp.J_id
                   WHERE jd.Dept_id = 1 
                   AND ja.S_College_Email = ?";
$stmt_eligible = $conn->prepare($query_eligible);
$stmt_eligible->bind_param("s", $student_email);
$stmt_eligible->execute();
$result_eligible = $stmt_eligible->get_result();
$row_eligible = $result_eligible->fetch_assoc();
$was_eligible_count = $row_eligible['eligible_count'];

// Fetch the total number of jobs available in the department
$query_total = "SELECT COUNT(jp.J_id) as total_jobs 
                FROM jobplacements as jp
                INNER JOIN jobdepartments as jd ON jd.J_id = jp.J_id
                WHERE jd.Dept_id = 1";
$result_total = mysqli_query($conn, $query_total);
$row_total = mysqli_fetch_assoc($result_total);
$total_jobs = $row_total['total_jobs'];

// Calculate the number of jobs the student was not eligible for
$was_not_eligible_count = $total_jobs - $was_eligible_count;

// Convert PHP variables to JSON
$was_eligible_json = json_encode($was_eligible_count);
$was_not_eligible_json = json_encode($was_not_eligible_count);

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
                            <!-- <div class="datebox">
                                <div>
                                    <label for="from_date"><strong>From:</strong></label>
                                    <input type="date" name="from_date" id="from_date">
                                </div>
                                <div>
                                    <label for="to_date"><strong>To:</strong></label>
                                    <input type="date" name="to_date" id="to_date">
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

                        </form>
                    </div>
                </div>
                <div class="sections section-container">

                    <div class="sections-1">
                        <p><strong>Total Number of students</strong>: 100</p>
                        <p><strong>Total Number of students Placed</strong>: 20</p>
                        <canvas id="myPieChart" ></canvas>
                        <script>
                            const ctx = document.getElementById('myPieChart').getContext('2d');
                            const myPieChart = new Chart(ctx, {
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
                        <tr>
                            <td>Patric</td>
                            <td>Comp</td>
                            <td>Facebook</td>
                            <td>20,000</td>
                            <td>30/3/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                        <tr>
                            <td>Gavin</td>
                            <td>Comp</td>
                            <td>Google</td>
                            <td>50,000</td>
                            <td>12/11/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                        <tr>
                            <td>Stephen</td>
                            <td>Civil</td>
                            <td>Reliance</td>
                            <td>40,000</td>
                            <td>24/5/2024</td>
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