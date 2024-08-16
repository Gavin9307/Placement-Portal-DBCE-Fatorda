<?php
require "../conn.php";
require "../restrict.php";
include "../utility_functions.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}

// Fetch the number of jobs the student was eligible for
$query_eligible = "SELECT COUNT(jp.J_id) as eligible_count 
                   FROM jobplacements as jp
                   INNER JOIN jobdepartments as jd ON jd.J_id = jp.J_id
                   INNER JOIN jobapplication as ja ON ja.J_id = jp.J_id
                   WHERE jd.Dept_id = 1 
                   AND ja.S_College_Email = '2114066@dbcegoa.ac.in'";
$result_eligible = mysqli_query($conn, $query_eligible);
$row_eligible = mysqli_fetch_assoc($result_eligible);
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
    <?php include './head.php'; ?>
    <link rel="stylesheet" href="./css/performance-and-metrics.css">
    <title>Performance and Metrics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php'; ?>

        <div class="container">
            <?php include './sidebar.php'; ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Performance and Metrics</h2>
                <div class="section-1">
                    <div class="section">
                        <h3>Stats:</h3><br>
                        <p>Total Applications:</p><br>
                        <p>Interviews Attended:</p><br>
                        <P>Rejections:</P><br>
                    </div>
                    <div class="section">
                        <h3>Jobs Posted:</h3>
                        <canvas id="myPieChart" style="width: 100%;height:300px;"></canvas>
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
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
                <div class="sections">
                    <p>ueryhuwh</p>
                </div>
            </div>
        </div>
    </div>
    <?php include './footer.php'; ?>
</body>

</html>
