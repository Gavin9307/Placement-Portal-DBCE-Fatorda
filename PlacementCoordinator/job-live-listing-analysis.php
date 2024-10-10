<?php
require "../conn.php";
require "../restrict.php";
require "../restrict_student.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_GET["jid"])) {
    header("Location: ./job-management.php");
    exit();
}

if (isset($_GET['remove']) && isset($_GET['semail']) && isset($_GET['jid'])) {
    $semail = $_GET['semail']; // Ensure you capture the email
    $jjid = (int) $_GET['jid']; // Safely cast the job ID to an integer

    // Prepare the DELETE query
    $studentJobDeleteQuery = "DELETE FROM jobapplication WHERE S_College_Email = ? AND J_id = ?";
    $studentJobDelete = $conn->prepare($studentJobDeleteQuery);

    if ($studentJobDelete) {
        // Bind parameters and execute the query
        $studentJobDelete->bind_param("si", $semail, $jjid);

        if ($studentJobDelete->execute()) {
            echo 'Student deleted successfully';
        } else {
            echo 'Student deletion unsuccessful: ' . $conn->error; 
        }
    } else {
        echo 'Query preparation failed: ' . $conn->error; 
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/live-listing-analysis.css">
    <title>Live Listing Analysis</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="<?php echo './job-management.php?jid='.$_GET["jid"]; ?>"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                        Details</h2>
                    <!-- <div class="company-container">
                        <p>Google</p>
                    </div> -->

                </div>

                <h3>Eligible Students : </h3>

                <div class="sections">
                    <table>
                        <tr>
                        <th>Name</th>
                            <th>Department</th>
                            <th>Batch</th>
                            <th>Status</th>
                            <th>Details</th>
                            <th>Remove</th>
                        </tr>

                        <?php getEligibleStudents(); ?>

                    </table>
                    <div class="button-container">
                        <a href="<?php echo './job-eligible-students.php?jid='.$_GET["jid"]; ?>"><button class="viewmore-button">View More</button></a>
                    </div>
                </div>


                <h3>Interested Students</h3>
                <div class="sections">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Batch</th>
                            <th>Status</th>
                            <th>Details</th>
                            <th>Remove</th>
                        </tr>

                        <?php getInterestedStudents(); ?>
                        
                       
                    </table>
                    <div class="button-container">
                        <a href="<?php echo './job-interested-students.php?jid='.$_GET["jid"]; ?>"><button class="viewmore-button">View More</button></a>
                    </div>
                </div>
                <!-- <button class="getreport-button">Get Report</button> -->
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>