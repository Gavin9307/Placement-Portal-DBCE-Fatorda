<?php
require "../conn.php";
require "../restrict_incomplete_profile.php";
require "../restrict.php";
require "../restrict_placement_coordinator.php";
include "../utility_functions.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}

$student_email = $_SESSION['user_email'];

$query_eligible = "SELECT COUNT(jp.J_id) as eligible_count 
                   FROM jobplacements as jp
                   INNER JOIN jobapplication as ja ON ja.J_id = jp.J_id WHERE ja.S_College_Email = ?";
$stmt_eligible = $conn->prepare($query_eligible);
$stmt_eligible->bind_param("s", $student_email);
$stmt_eligible->execute();
$result_eligible = $stmt_eligible->get_result();
$row_eligible = $result_eligible->fetch_assoc();
$was_eligible_count = $row_eligible['eligible_count'];

// Fetch the total number of jobs available in the department
$query_total = "SELECT COUNT(jp.J_id) as total_jobs 
                FROM jobplacements as jp";
$result_total = mysqli_query($conn, $query_total);
$row_total = mysqli_fetch_assoc($result_total);
$total_jobs = $row_total['total_jobs'];

// Calculate the number of jobs the student was not eligible for
$was_not_eligible_count = $total_jobs - $was_eligible_count;

// Convert PHP variables to JSON
$was_eligible_json = json_encode($was_eligible_count);
$was_not_eligible_json = json_encode($was_not_eligible_count);


// Prepare the SQL queries for pending, accepted, and rejected applications
$sql_pending = "SELECT COUNT(*) AS pending_applications
                FROM jobapplication AS ja
                INNER JOIN student AS s ON ja.S_College_Email = s.S_College_Email
                INNER JOIN jobplacements as jp ON jp.J_id = ja.J_id
                WHERE s.S_College_Email = ? 
                  AND ja.placed = 0 
                  AND jp.J_Due_date >= CURRENT_DATE";

$sql_accepted = "SELECT COUNT(*) AS accepted_applications
                 FROM jobapplication AS ja
                 INNER JOIN student AS s ON ja.S_College_Email = s.S_College_Email
                 WHERE s.S_College_Email = ? 
                   AND ja.placed = 1";

$sql_rejected = "SELECT COUNT(*) AS rejected_applications
                 FROM jobapplication AS ja
                 INNER JOIN student AS s ON ja.S_College_Email = s.S_College_Email
                 INNER JOIN jobplacements as jp ON jp.J_id = ja.J_id
                 WHERE s.S_College_Email = ? 
                   AND ja.placed = 0 
                   AND jp.J_Due_date < CURRENT_DATE";

// Prepare and execute the pending applications query
$stmt_pending = $conn->prepare($sql_pending);
$stmt_pending->bind_param("s", $student_email);
$stmt_pending->execute();
$result_pending = $stmt_pending->get_result();
$row_pending = $result_pending->fetch_assoc();
$pendingCount = $row_pending['pending_applications'];

// Prepare and execute the accepted applications query
$stmt_accepted = $conn->prepare($sql_accepted);
$stmt_accepted->bind_param("s", $student_email);
$stmt_accepted->execute();
$result_accepted = $stmt_accepted->get_result();
$row_accepted = $result_accepted->fetch_assoc();
$acceptedCount = $row_accepted['accepted_applications'];

// Prepare and execute the rejected applications query
$stmt_rejected = $conn->prepare($sql_rejected);
$stmt_rejected->bind_param("s", $student_email);
$stmt_rejected->execute();
$result_rejected = $stmt_rejected->get_result();
$row_rejected = $result_rejected->fetch_assoc();
$rejectedCount = $row_rejected['rejected_applications'];

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
                        <h3> Application Stats:</h3>
                        <canvas id="newPieChartId" width="250" height="150"></canvas>
                        <script>
                            const pendingCount = <?php echo $pendingCount; ?>;
                            const acceptedCount = <?php echo $acceptedCount; ?>;
                            const rejectedCount = <?php echo $rejectedCount; ?>;

                            const cty = document.getElementById('newPieChartId').getContext('2d');
                            const newPieChart = new Chart(cty, {
                                type: 'pie',
                                data: {
                                    labels: ['Pending', 'Cleared', 'Rejected'],
                                    datasets: [{
                                        data: [pendingCount, acceptedCount, rejectedCount],
                                        backgroundColor: ['#f5f520', '#1ded36', '#f90808'],
                                        hoverBackgroundColor: ['#f5f520', '#1ded36', '#f90808']
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
                <!-- <div class="sections">
                    <canvas id="myLineChart" style="width: 100%;height:300px;"></canvas>
                    <script>
                        const ctz = document.getElementById('myLineChart').getContext('2d');
                        const myLineChart = new Chart(ctz, {
                            type: 'line',
                            data: {
                                labels: ['Company A', 'Company B', 'Company C', 'Company D', 'Company E', 'Company F', 'Company G'], // Company names on x-axis
                                datasets: [{
                                    label: 'Number of Rounds',
                                    data: [2, 3, 1, 4, 2, 3, 1], // Number of rounds for each company
                                    fill: false, // Set to true if you want the area under the line to be filled
                                    borderColor: 'rgb(75, 192, 192)',
                                    tension: 0.1 // Adjust the curve of the line
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
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Companies Applied' // X-axis title
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Number of Rounds' // Y-axis title
                                        },
                                        ticks: {
                                            stepSize: 1, // Ensure y-axis only shows whole numbers
                                            callback: function(value) {
                                                return 'Round ' + value; // Label the y-axis as Round 1, Round 2, etc.
                                            }
                                        }
                                    }
                                },
                                animation: {
                                    duration: 1000
                                }
                            }
                        });
                    </script>

                </div> -->
            </div>
        </div>
    </div>
    <?php include './footer.php'; ?>
</body>

</html>