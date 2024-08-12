<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST["delete-listing"])) {

    $deleteJobQuery = "DELETE FROM jobdepartments WHERE J_id = ?";
    $deleteJob = $conn->prepare($deleteJobQuery);
    $deleteJob->bind_param("i", $_POST["jid"]);
    if ($deleteJob->execute()) {
        $deleteJobQuery = "DELETE FROM jobplacements WHERE J_id = ?";
        $deleteJob = $conn->prepare($deleteJobQuery);
        $deleteJob->bind_param("i", $_POST["jid"]);
        if ($deleteJob->execute()) {
            // echo "success";
        } else {
            // echo "failed";
        }
    } else {
        // echo "failed";
    }
}
if (isset($_GET['responsestatus']) && isset($_GET['jid'])) {
    $responsestatus = (int)$_GET['responsestatus'];
    $jid = (int)$_GET['jid'];

    // Update the Accept_Responses status in the database
    $updateQuery = "UPDATE jobplacements SET Accept_Responses = ? WHERE J_id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ii", $responsestatus, $jid);

    if ($updateStmt->execute()) {
        echo "Accept Responses status updated successfully.";
    } else {
        echo "Failed to update status: " . $updateStmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/job-management.css">
    <title>Job Management</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="./dashboard.html"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a></a>
                        Job Management</h2>
                    <a href="./job-post.php"><button class="add-button">Post a Job</button></a>
                </div>
                <h3>Live Listings</h3>


                <?php
                    getLiveJobListings();
                ?>


                <h3>Completed Listings</h3>
                <div class="sections">
                    <table>
                        <tr>
                            <th>Date</th>
                            <th>Company</th>
                            <th>Students Placed</th>
                            <th>Details</th>
                        </tr>
                        <?php getCompletedJobListings(); ?>

                    </table>
                    <div class="button-container">
                        <a href="./job-completed-listings.php"><button class="viewmore-button">View More</button></a>
                    </div>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

<script>
function confirmAddRounds(jid) {
    if (confirm("Warning: Once rounds are added, Addiotional rounds cant be created?")) {
        window.location.href = './job-add-rounds.php?jid=' + jid;
        return true;
    } else {
        return false;
    }
}
</script>

</html>