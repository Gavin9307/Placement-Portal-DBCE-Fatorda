<?php
require "../conn.php";
require "../restrict.php";
require "../restrict_student.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}


if (isset($_POST["delete-listing"])) {
    $jobId = $_POST["jid"];

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Step 1: Delete from jobquestions
        $deleteJobQuestionsQuery = "DELETE FROM jobquestions WHERE Job_ID = ?";
        $deleteJobQuestions = $conn->prepare($deleteJobQuestionsQuery);
        $deleteJobQuestions->bind_param("i", $jobId);
        if (!$deleteJobQuestions->execute()) {
            throw new Exception("Failed to delete from jobquestions.");
        }

        // Step 2: Delete from jobdepartments
        $deleteJobDepartmentsQuery = "DELETE FROM jobdepartments WHERE J_id = ?";
        $deleteJobDepartments = $conn->prepare($deleteJobDepartmentsQuery);
        $deleteJobDepartments->bind_param("i", $jobId);
        if (!$deleteJobDepartments->execute()) {
            throw new Exception("Failed to delete from jobdepartments.");
        }


        // Step 3: Delete from student responses
        $deletestudentresponsesQuery = "DELETE FROM studentresponses WHERE Job_ID = ?";
        $deletestudentresponses = $conn->prepare($deletestudentresponsesQuery);
        $deletestudentresponses->bind_param("i", $jobId);
        if (!$deletestudentresponses->execute()) {
            throw new Exception("Failed to delete from studentresponses.");
        }

        // Step 4: Delete from jobplacements
        $deleteJobPlacementsQuery = "DELETE FROM jobplacements WHERE J_id = ?";
        $deleteJobPlacements = $conn->prepare($deleteJobPlacementsQuery);
        $deleteJobPlacements->bind_param("i", $jobId);
        if (!$deleteJobPlacements->execute()) {
            throw new Exception("Failed to delete from jobplacements.");
        }

        // Commit transaction
        $conn->commit();
        echo "Job listing successfully deleted.";
    } catch (Exception $e) {
        // Rollback transaction
        $conn->rollback();
        echo "Failed to delete job listing: " . $e->getMessage();
    }
    // header("Location: ./job-management.php");
    // exit();
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
                    <a href="https://web.whatsapp.com/" target="_blank"><button style="background-color: green;" class="whatsapp">Whatsapp</button></a>
                    <a href="./job-post-questions.php"><button class="add-questions">Add Questions</button></a>
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
    <div id="error" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>There was an Error while posting the job</p>
        </div>
    </div>

    <div id="no-match" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>No students matched the criteria</p>
        </div>
    </div>

    <div id="successful" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>The Job has been posted successfully</p>
        </div>
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
    // Get the modals
    var errorModal = document.getElementById("error");
    var nomatchModal = document.getElementById("no-match");
    var successfulModal = document.getElementById("successful");

    // Get the <span> elements that close the modals
    var closeButtons = document.getElementsByClassName("close");

    // Close the modal when the user clicks on <span> (x)
    for (var i = 0; i < closeButtons.length; i++) {
        closeButtons[i].onclick = function() {
            errorModal.style.display = "none";
            nomatchModal.style.display = "none";
            successfulModal.style.display = "none";
        }
    }

    // Close the modal when the user clicks anywhere outside of the modal
    window.onclick = function(event) {
        if (event.target == errorModal) {
            errorModal.style.display = "none";
        } else if (event.target == notmatchModal) {
            nomatchModal.style.display = "none";
        } else if (event.target == successfulModal) {
            successfulModal.style.display = "none";
        }
    }
</script>

<?php if (isset($_GET['job-post'])): ?>
    <script>
        <?php if ($_GET['job-post'] == 3): ?>
            errorModal.style.display = "block";
        <?php elseif ($_GET['job-post'] == 1): ?>
            successfulModal.style.display = "block";
        <?php elseif ($_GET['job-post'] == 2): ?>
            nomatchModal.style.display = "block";
        <?php endif; ?>
    </script>
<?php endif; ?>

</html>