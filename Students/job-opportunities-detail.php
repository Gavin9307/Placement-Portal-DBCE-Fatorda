<?php
require "../restrict.php";
require "../utility_functions.php";
require "../conn.php";

if (!isset($_GET["jid"])) {
    header("Location: ./job-opportunities.php");
    exit();
}

global $conn;
$modalTrigger = 'none';

// Handle GET request for "Not Interested"
if (isset($_GET['interest']) && $_GET['interest'] == 0) {
    $interest = (int)$_GET['interest'];
    $jid = (int)$_GET['jid'];
    $email = $_SESSION['user_email'];

    // Update the Interest to "Not Interested"
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
        // Remove all answers for the student for the specified job
        $deleteAnswersQuery = "DELETE FROM studentresponses 
                               WHERE Student_Email = ? AND Job_ID = ?";
        $deleteAnswersStmt = $conn->prepare($deleteAnswersQuery);
        if (!$deleteAnswersStmt) {
            die("Prepare failed: " . $conn->error);
        }
        $deleteAnswersStmt->bind_param("si", $email, $jid);

        if (!$deleteAnswersStmt->execute()) {
            die("Execute failed: " . $deleteAnswersStmt->error);
        }

        // Set modal trigger to show the "Not Interested" success modal
        $modalTrigger = 'notInterested';
    }
}

// Handle POST request for saving answers and marking interest
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jid = (int)$_POST['jid'];
    $interest = (int)$_POST['interest'];
    $email = $_SESSION['user_email'];

    // Update the Interest
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
        // Save student answers
        if (isset($_POST['answers'])) {
            $answers = $_POST['answers'];
            $question_ids = $_POST['question_ids'];

            foreach ($answers as $index => $answer) {
                $question_id = $question_ids[$index];

                $saveAnswerQuery = "INSERT INTO studentresponses (Job_ID, Student_Email, Question_ID, Response_Text)
                                    VALUES (?, ?, ?, ?)
                                    ON DUPLICATE KEY UPDATE Response_Text = VALUES(Response_Text);";

                $saveAnswerStmt = $conn->prepare($saveAnswerQuery);
                if (!$saveAnswerStmt) {
                    die("Prepare failed: " . $conn->error);
                }
                $saveAnswerStmt->bind_param("isis", $jid, $email, $question_id, $answer);

                if (!$saveAnswerStmt->execute()) {
                    die("Execute failed: " . $saveAnswerStmt->error);
                }
            }
        }

        // Set modal trigger to show the "Interested" success modal
        $modalTrigger = $interest == 1 ? 'interested' : 'notInterested';
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
                    $job_id = $_GET['jid'];
                    global $conn;
                    $fetchJobDetailQuery = "SELECT C.C_Name as cname, C.C_Logo clogo, P.J_Due_date duedate, P.J_Position position, P.J_Description description, A.Interest interest
                                            FROM company as C
                                            INNER JOIN jobposting as J ON J.C_id = C.C_id
                                            INNER JOIN jobplacements as P ON P.J_id = J.J_id
                                            INNER JOIN jobapplication as A ON A.J_id = P.J_id
                                            WHERE P.J_Due_date >= CURRENT_DATE AND J.J_id = ? AND A.S_College_Email = ?";
                    $fetchJobDetail = $conn->prepare($fetchJobDetailQuery);
                    $fetchJobDetail->bind_param("is", $job_id, $_SESSION["user_email"]);
                    $fetchJobDetail->execute();
                    $result = $fetchJobDetail->get_result();

                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="company-container">
                                <div class="company-logo-container">
                                    <img src="../Data/Companies/Company_Logo/' . $row['clogo'] . '" alt="">
                                    <p>' . $row['cname'] . '</p>
                                </div>
                                <p><strong>Due Date:</strong> ' . $row['duedate'] . '</p>
                            </div>
                            <p class="position"><strong>Position:</strong> ' . $row['position'] . '</p>
                            <p class=""><strong>Details:</strong></p>
                            <p>Job Description: ' . $row['description'] . '</p>
                            <p class="" style="margin-top:20px;"><strong>Additional Questions:</strong></p>
                            <form method="POST" action="">
                                <input type="hidden" name="jid" value="' . $job_id . '">
                                <input type="hidden" name="interest" value="1">
                                <div class="add-questions">';

                                $fetchQuestionsQuery = "SELECT Q.Question_ID as question_id, Q.Question_Text as question_text 
                                                        FROM jobquestions as JQ
                                                        INNER JOIN Questions as Q ON JQ.Question_ID = Q.Question_ID
                                                        WHERE JQ.Job_ID = ?";
                                $fetchQuestions = $conn->prepare($fetchQuestionsQuery);
                                $fetchQuestions->bind_param("i", $job_id);
                                $fetchQuestions->execute();
                                $questionsResult = $fetchQuestions->get_result();
                                while ($questionRow = $questionsResult->fetch_assoc()) {
                                    echo '<div class="inputbox">
                                            <label for="">' . htmlspecialchars($questionRow['question_text']) . '</label>
                                            <input type="text" name="answers[]" value="">
                                            <input type="hidden" name="question_ids[]" value="' . $questionRow['question_id'] . '">
                                          </div>';
                                }
                                echo '</div>';

                        if ($row['interest'] == 0) {
                            echo '<div class="interest-button-container">
                                    <button type="submit" id="myBtn" class="interested">Mark as Interested</button>
                                    <a href="./job-opportunities-detail.php?jid=' . $job_id . '&interest=0">Not Interested</a>
                                  </div>';
                        } else {
                            echo '<div class="interest-button-container">
                                    <a href="./job-opportunities-detail.php?jid=' . $job_id . '&interest=0">Not Interested</a>
                                  </div>';
                        }
                    }
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
                } else if (event.target == notInterestedModal) {
                    notInterestedModal.style.display = "none";
                }
            }

            // Trigger the appropriate modal based on PHP variable
            <?php if ($modalTrigger == 'interested') : ?>
                interestedModal.style.display = "block";
            <?php elseif ($modalTrigger == 'notInterested') : ?>
                notInterestedModal.style.display = "block";
            <?php endif; ?>
        </script>
    </div>
</body>

</html>
