<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

// Check if JID is provided
if (!isset($_GET['jid'])) {
    echo "Job ID not provided!";
    exit;
}

$jid = intval($_GET['jid']); // Sanitize the JID input

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post-job'])) {
    // Get the round details from the form
    $round_locations = $_POST['round_location'];
    $round_links = $_POST['round_link'];
    $round_times = $_POST['round_time'];
    $round_dates = $_POST['round_date'];
    $round_descriptions = $_POST['round_description'];
    $round_numbers = $_POST['round-no'];

    // Prepare the SQL statement for inserting rounds
    $insertRoundQuery = $conn->prepare("
        INSERT INTO rounds (J_id, Round_no, Location, Link, Time, Date, Description)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    // Bind parameters
    $insertRoundQuery->bind_param("iisssss", $jid, $r_no, $r_location, $r_link, $r_time, $r_date, $r_description);

    // Loop through each round and insert it into the database
    for ($i = 0; $i < count($round_numbers); $i++) {
        $r_no = intval($round_numbers[$i]);
        $r_location = $round_locations[$i];
        $r_link = $round_links[$i];
        $r_time = $round_times[$i];
        $r_date = $round_dates[$i];
        $r_description = $round_descriptions[$i];

        // Execute the query
        $insertRoundQuery->execute();
    }

    // Check if the insertion was successful
    if ($insertRoundQuery->affected_rows > 0) {
        echo "<script>alert('Rounds added successfully!');</script>";

        // Fetch interested students
        $fetchInterestedStudentsQuery = 'SELECT S_College_email FROM jobapplication WHERE J_id = ? AND interest = 1';
        $fetchInterestedStudents = $conn->prepare($fetchInterestedStudentsQuery);
        $fetchInterestedStudents->bind_param("i", $jid);
        $fetchInterestedStudents->execute();
        $resultStudents = $fetchInterestedStudents->get_result();

        if ($resultStudents->num_rows > 0) {
            $conn->begin_transaction();

            try {
                // Prepare the insert statement for student rounds
                $insertStudentRoundsQuery = 'INSERT INTO studentrounds (RoundStatus, S_College_email, R_id) VALUES (?, ?, ?)';
                $rstatus = "pending";
                $insertStudentRounds = $conn->prepare($insertStudentRoundsQuery);

                // Fetch all round IDs for the given job ID
                $fetchRoundsQuery = 'SELECT R_id FROM rounds WHERE J_id = ?';
                $fetchRounds = $conn->prepare($fetchRoundsQuery);
                $fetchRounds->bind_param("i", $jid);
                $fetchRounds->execute();
                $resultRounds = $fetchRounds->get_result();

                // Loop through each round ID and each interested student
                while ($rowRound = $resultRounds->fetch_assoc()) {
                    $rid = $rowRound['R_id'];

                    // Loop through each interested student and insert into studentrounds
                    while ($rowStudent = $resultStudents->fetch_assoc()) {
                        $semail = $rowStudent['S_College_email'];
                        $insertStudentRounds->bind_param("ssi", $rstatus, $semail, $rid);
                        $insertStudentRounds->execute();
                    }

                    // Reset result pointer for students
                    $resultStudents->data_seek(0);
                }

                $conn->commit();
                echo "Student rounds inserted successfully.";
            } catch (Exception $e) {
                $conn->rollback();
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "No interested students found for the given job ID.";
        }
    } else {
        echo "<script>alert('Failed to add rounds. Please try again.');</script>";
    }

    // Close the statements
    $insertRoundQuery->close();
    $fetchInterestedStudents->close();
    $fetchRounds->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/job-post.css">
    <title>Post a Job</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="./job-management.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                        Post a job</h2>
                </div>

                <div class="sections">
                    <form action="" method="post">
                        <div id="rounds-container">

                        </div>
                        <button type="button" id="add-round" class="add-round-button">Add Round</button>
                        <button type="submit" class="add-button" name="post-job">Post</button>
                    </form>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let roundCount = 0;

        function addRound() {
            roundCount++;

            const newRoundHTML = `
                <div class="round-section" id="round-${roundCount}">
                    <h3>Round ${roundCount}:</h3>
                    <div class="form-adjust">
                        <div class="inputbox">
                            <label for="location-${roundCount}">Location:</label>
                            <input required type="text" name="round_location[]" id="location-${roundCount}">
                        </div>
                        <div class="inputbox">
                            <label for="link-${roundCount}">Link:</label>
                            <input type="text" name="round_link[]" id="link-${roundCount}">
                        </div>
                        <div class="inputbox">
                            <label for="time-${roundCount}">Time:</label>
                            <input type="time" name="round_time[]" id="time-${roundCount}">
                        </div>
                        <div class="inputbox">
                            <label for="date-${roundCount}">Date:</label>
                            <input type="date" name="round_date[]" id="date-${roundCount}">
                        </div>
                        <input type="hidden" name="round-no[]" value="${roundCount}">
                    </div>
                    <h3>Details:</h3>
                    <textarea name="round_description[]" id="description-${roundCount}" class="textarea-message" placeholder="Enter round details"></textarea>
                    <button type="button" class="add-round-button delete-round-button" data-round-id="round-${roundCount}" style="background-color:red;color:white;margin-bottom:50px;margin-top:-60px">Delete Round</button>
                </div>
            `;

            document.getElementById('rounds-container').insertAdjacentHTML('beforeend', newRoundHTML);
        }

        document.getElementById('add-round').addEventListener('click', addRound);

        document.getElementById('rounds-container').addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-round-button')) {
                const roundId = event.target.getAttribute('data-round-id');
                const roundElement = document.getElementById(roundId);
                if (roundElement) {
                    roundElement.remove();
                    roundCount--;
                }
            }
        });
    });
    </script>
</body>

</html>
