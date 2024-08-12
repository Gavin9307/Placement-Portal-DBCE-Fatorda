<?php
require "../restrict.php";
require "../utility_functions.php";
require "../conn.php";

if (!isset($_GET["jid"])){
    header("Location: ./job-opportunities.php");
    exit();
}
global $conn;

$modalTrigger = 'none';
function applyStudentForJobRounds()
{
    global $conn;
    $jid = (int) $_GET['jid'];
    $semail = (string) $_SESSION['user_email'];

    // Fetch all rid values for the given jid
    $fetchRoundsQuery = 'SELECT R_id FROM rounds WHERE J_id = ?';
    $fetchRounds = $conn->prepare($fetchRoundsQuery);
    $fetchRounds->bind_param("i", $jid);
    $fetchRounds->execute();
    $result = $fetchRounds->get_result();

    if ($result->num_rows > 0) {
        $conn->begin_transaction();

        try {
            // Prepare the insert statement
            $insertStudentRoundsQuery = 'INSERT INTO studentrounds (RoundStatus,S_College_email, R_id) VALUES (?, ?, ?)';
            $rstatus = "pending";
            $insertStudentRounds = $conn->prepare($insertStudentRoundsQuery);

            // Loop through each rid and insert into studentrounds
            while ($row = $result->fetch_assoc()) {
                $rid = $row['R_id'];
                $insertStudentRounds->bind_param("ssi",$rstatus, $semail, $rid);
                $insertStudentRounds->execute();
            }

            $conn->commit();
            echo "Student rounds inserted successfully.";
        } catch (Exception $e) {
            // $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "No rounds found for the given job ID.";
    }

}

function deleteStudentFromJobRounds() {
    global $conn;
    $jid = (int) $_GET['jid'];
    $semail = (string) $_SESSION['user_email'];

    // Begin a transaction
    $conn->begin_transaction();

    try {
        // Fetch all rid values for the given jid
        $fetchRoundsQuery = 'SELECT R_id FROM rounds WHERE J_id = ?';
        $fetchRounds = $conn->prepare($fetchRoundsQuery);
        $fetchRounds->bind_param("i", $jid);
        $fetchRounds->execute();
        $result = $fetchRounds->get_result();

        if ($result->num_rows > 0) {
            // Prepare the delete statement
            $deleteStudentRoundsQuery = 'DELETE FROM studentrounds WHERE S_College_email = ? AND R_id = ?';
            $deleteStudentRounds = $conn->prepare($deleteStudentRoundsQuery);

            // Loop through each rid and delete from studentrounds
            while ($row = $result->fetch_assoc()) {
                $rid = $row['R_id'];
                $deleteStudentRounds->bind_param("si", $semail, $rid);
                $deleteStudentRounds->execute();
            }

            $conn->commit();
            echo "Student rounds deleted successfully.";
        } else {
            echo "No rounds found for the given job ID.";
        }
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        // $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_GET["interest"])) {
    $interest = (int)$_GET["interest"];
    $jid = (int)$_GET["jid"];
    $email = $_SESSION['user_email'];

    // Update the Interest first
    $UpdateQuery = "UPDATE jobapplication J
                    SET J.Interest = ?
                    WHERE J.J_id = ? AND J.S_College_Email = ?;";

    $Update = $conn->prepare($UpdateQuery);
    if (!$Update) {
        die("Prepare failed: " . $conn->error);
    }

    $Update->bind_param("iis", $interest, $jid, $email);

    if (!$Update->execute()) {
        die("Execute failed: " . $Update->error);
    } else {
        // Set modal trigger to show the success modal
        echo $interest;
        $modalTrigger = $interest == 1 ? 'interested' : 'notInterested';
    }

    // Now, apply or delete student rounds based on interest
    if ($interest == 1) {
        applyStudentForJobRounds();
    } else {
        deleteStudentFromJobRounds();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/job-opportunities-detail.css">
    <title>Job Opportunities</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>
            <div class="main-container">
                <h2 class="main-container-heading"><a href="./job-opportunities.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Job Opportunities</h2>

                <div class="sections">
                    <?php
                        getJobDetail($_GET['jid']);
                    ?>
                </div>
            </div>
        </div>

        <!-- Modals -->
        <div id="interestedModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Your application has been successfully sent</p>
            </div>
        </div>

        <div id="notInterestedModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Marked as not interested</p>
            </div>
        </div>

        <script>
            // Get the modals
            var interestedModal = document.getElementById("interestedModal");
            var notInterestedModal = document.getElementById("notInterestedModal");

            // Get the <span> elements that close the modals
            var closeButtons = document.getElementsByClassName("close");

            // Close the modal when the user clicks on <span> (x)
            for (var i = 0; i < closeButtons.length; i++) {
                closeButtons[i].onclick = function() {
                    interestedModal.style.display = "none";
                    notInterestedModal.style.display = "none";
                }
            }

            // Close the modal when the user clicks anywhere outside of the modal
            window.onclick = function(event) {
                if (event.target == interestedModal) {
                    interestedModal.style.display = "none";
                }
                if (event.target == notInterestedModal) {
                    notInterestedModal.style.display = "none";
                }
            }

            // Show modal based on PHP set variable
            var modalTrigger = "<?php echo $modalTrigger; ?>";
            if (modalTrigger === 'interested') {
                interestedModal.style.display = "block";
            } else if (modalTrigger === 'notInterested') {
                notInterestedModal.style.display = "block";
            }
        </script>

        <?php include './footer.php' ?>
    </div>
</body>
</html>
