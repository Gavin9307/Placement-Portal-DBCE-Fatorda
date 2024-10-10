<?php
require "../conn.php";
require "../restrict.php";
require "../restrict_student.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}
// 0-pending 1-success 2-error
$student = 0;

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
            $student=1 ;
        } else {
            $student=2 ; 
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
                    <h2 class="main-container-heading"><a href="<?php echo './job-live-listing-analysis.php?jid='.$_GET["jid"]; ?>"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
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

                        <?php getEligibleStudentsAll(); ?>

                    </table>
                </div>
                <button class="getreport-button">Get Report</button>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>
    <div id="successful" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>The Student has been removed successfully</p>
        </div>
    </div>
    <div id="unsuccessful" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>There was an error while removing the Student</p>
        </div>
    </div>
    <script>
        // Get the modals
        var errorModal = document.getElementById("unsuccessful");
        var successfulModal = document.getElementById("successful");

        // Get the <span> elements that close the modals
        var closeButtons = document.getElementsByClassName("close");

        // Close the modal when the user clicks on <span> (x)
        for (var i = 0; i < closeButtons.length; i++) {
            closeButtons[i].onclick = function() {
                errorModal.style.display = "none";
                successfulModal.style.display = "none";
            }
        }

        // Close the modal when the user clicks anywhere outside of the modal
        window.onclick = function(event) {
            if (event.target == errorModal) {
                errorModal.style.display = "none";
            } 
            else if (event.target == successfulModal) {
                successfulModal.style.display = "none";
            }
        }

        // Trigger the appropriate modal based on PHP variable
        <?php if ($student == 2) : ?>
            errorModal.style.display = "block";
        <?php elseif ($student == 1) : ?>
            successfulModal.style.display = "block";
            <?php endif; ?>
    </script>
</body>

</html>