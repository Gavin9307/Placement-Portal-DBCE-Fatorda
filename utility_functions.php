<?php
function getFeedbacks()
{
    global $conn;
    $fetchFeedbackQuery = "SELECT feedback.Message as message,feedback.Rating as rating,feedback.S_College_Email as S_email,feedback.C_id,student.S_Fname as fname,student.S_Lname as lname,student.S_Profile_pic as image FROM feedback INNER JOIN student ON student.S_College_Email = feedback.S_College_Email INNER JOIN company ON company.C_id = feedback.C_id WHERE feedback.C_id = ? ORDER BY feedback.Message_Date DESC;";
    $fetchFeedback = $conn->prepare($fetchFeedbackQuery);
    $fetchFeedback->bind_param("s", $_GET["id"]);
    $fetchFeedback->execute();
    $resultFeedback = $fetchFeedback->get_result();

    if ($resultFeedback->num_rows > 0) {
        while ($row = $resultFeedback->fetch_assoc()) {
            $FStudentLogo = $row["image"];
            $FStudentMessage = $row["message"];
            $FStudentName = $row["fname"] . " " . $row["lname"];
            $FStudentrating = $row["rating"];
        }
        echo '<div class="students-review">
                    <div class="students-container">
                        <div class="students-logo-container">
                            <img src="../Data/Students/Profile_Images/' . $FStudentLogo . '" alt="">
                            <p>' . $FStudentName . '</p>
                        </div>
                        <div class="rating-container">';
        $i = 0;
        while ($i < $FStudentrating && $i < 5) {
            echo '<span class="fa fa-star checked fa-xl"></span>';
            $i++;
        }
        while ($i < 5) {
            echo '<span class="fa fa-star fa-xl"></span>';
            $i++;
        }
        echo '</div>
                    </div>
                    <p class="students-message">' . $FStudentMessage . '</p>
                </div>';
    } else {
        // No feedbacks
    }
}

function getJobOffers($email)
{
    global $conn;
    $fetchJobQuery = "SELECT C.C_Name as cname, C.C_Logo clogo, P.J_Due_date duedate, P.J_Position position, J.J_id jid 
FROM company as C
INNER JOIN jobposting as J ON J.C_id = C.C_id
INNER JOIN jobplacements as P ON P.J_id = J.J_id
INNER JOIN jobapplication as JA ON JA.J_id = P.J_id
WHERE
P.J_Due_date >= CURRENT_DATE AND P.Accept_Responses=1 AND JA.S_College_Email = ?;";

    $fetchJob = $conn->prepare($fetchJobQuery);
    $fetchJob->bind_param("s", $email);
    $fetchJob->execute();
    $result = $fetchJob->get_result();

    while ($row = $result->fetch_assoc()) {
        echo '<div class="sections">
                    <div class="company-container">
                        <div class="company-logo-container">
                            <img src="../Data/Companies/Company_Logo/' . $row['clogo'] . '" alt="">
                            <p>' . $row['cname'] . '</p>
                        </div>
                        <p><strong>Due Date:</strong> ' . $row['duedate'] . '</p>
                    </div>
                    <p class="position"><strong>Position:</strong> ' . $row['position'] . '</p>
                    <a href="./job-opportunities-detail.php?jid=' . $row['jid'] . '" ?><button>View More</button></a>
                </div>';
    }
}

// function getJobDetail($job_id)
// {
//     global $conn;
//     $fetchJobDetailQuery = "SELECT C.C_Name as cname, C.C_Logo clogo, P.J_Due_date duedate, P.J_Position position, P.J_Description description, A.Interest interest
// FROM company as C
// INNER JOIN jobposting as J ON J.C_id = C.C_id
// INNER JOIN jobplacements as P ON P.J_id = J.J_id
// INNER JOIN jobapplication as A ON A.J_id = P.J_id
// WHERE
// P.J_Due_date >= CURRENT_DATE AND J.J_id = ? AND A.S_College_Email = ?";

//     $fetchJobDetail = $conn->prepare($fetchJobDetailQuery);
//     $fetchJobDetail->bind_param("is", $job_id, $_SESSION["user_email"]);
//     $fetchJobDetail->execute();
//     $result = $fetchJobDetail->get_result();

//     while ($row = $result->fetch_assoc()) {
//         echo '<div class="company-container">
//                         <div class="company-logo-container">
//                             <img src="../Data/Companies/Company_Logo/' . $row['clogo'] . '" alt="">
//                             <p>' . $row['cname'] . '</p>
//                         </div>
//                         <p><strong>Due Date:</strong> ' . $row['duedate'] . '</p>
//                     </div>
//                    <p class="position"><strong>Position:</strong> ' . $row['position'] . '</p>
//                     <p class=""><strong>Details:</strong>
//                     <p>Job Description:
//                         ' . $row['description'] . '
//                     </p>
//                     </p>
//                     <p class="" style= " margin-top:20px;"><strong>Additional Questions:</strong></p>
//                     <form action="">
//                         <div class="add-questions">';
//                         $fetchQuestionsQuery = "SELECT Q.Question_Text as question_text 
//                         FROM jobquestions as JQ
//                         INNER JOIN Questions as Q ON JQ.Question_ID = Q.Question_ID
//                         WHERE JQ.Job_ID = ?";
//                         $fetchQuestions = $conn->prepare($fetchQuestionsQuery);
//                         $fetchQuestions->bind_param("i", $job_id);
//                         $fetchQuestions->execute();
//                         $questionsResult = $fetchQuestions->get_result();
//                         while ($questionRow = $questionsResult->fetch_assoc()) {
//                           echo  '<div class="inputbox">
//                                 <label for="">' . htmlspecialchars($questionRow['question_text']) . '</label>
//                                 <input type="text" name="answers[]">
//                             </div>';
//                         }
                    
//                       echo  '</div>
//                     ';

//         if ($row['interest'] == 0) {
//             echo '<div class="interest-button-container">
//                                 <a href="./job-opportunities-detail.php?jid=' . $job_id . '&interest=1"><button id="myBtn" class="interested">Mark as Interested</button></a>
//                                 <a href="./job-opportunities-detail.php?jid=' . $job_id . '&interest=0"><button class="not-interested">Not Interested</button></a>
//                               </div>';
//         } else {
//             echo '<div class="interest-button-container">
//                                 <a href="./job-opportunities-detail.php?jid=' . $job_id . '&interest=0"><button class="interested">Mark as Not Interested</button></a>
//                               </div>';
//         }
//     }
// }



function getApplications()
{
    global $conn;
    $fetchApplicationsQuery = "SELECT C.C_Name as cname, C.C_Logo clogo, A.J_apply_date applydate, P.J_Position position, A.J_id as jid 
FROM company as C
INNER JOIN jobposting as J ON J.C_id = C.C_id
INNER JOIN jobplacements as P ON P.J_id = J.J_id
INNER JOIN jobapplication as A ON A.J_id = J.J_id
WHERE A.Interest = ? AND A.S_College_Email = ?;";

    $fetchApplications = $conn->prepare($fetchApplicationsQuery);
    $z = 1;
    $fetchApplications->bind_param("is", $z, $_SESSION["user_email"]);
    $fetchApplications->execute();
    $result = $fetchApplications->get_result();

    while ($row = $result->fetch_assoc()) {
        echo '<div class="sections">
                    <div class="company-container">
                        <div class="company-logo-container">
                            <img src="../Data/Companies/Company_Logo/' . $row['clogo'] . '" alt="">
                            <p>' . $row['cname'] . '</p>
                        </div>
                        <p><strong>Apply Date:</strong> ' . $row['applydate'] . '</p>
                    </div>
                    <p class="position"><strong>Position:</strong> ' . $row['position'] . '</p>
                    <a href="./my-applications-details.php?jid=' . $row['jid'] . '"><button>View More</button></a>
                </div>';
    }
}

function getApplicationDetails()
{
    global $conn;

    // Fetch application details
    $fetchApplicationDetailsQuery = "SELECT C.C_Name as cname, C.C_Logo clogo, A.J_apply_date applydate, P.J_Position position, A.J_id as jid 
    FROM company as C
    INNER JOIN jobposting as J ON J.C_id = C.C_id
    INNER JOIN jobplacements as P ON P.J_id = J.J_id
    INNER JOIN jobapplication as A ON A.J_id = J.J_id
    WHERE A.Interest = ? AND A.S_College_Email = ? AND J.J_id = ?";

    $fetchApplicationDetails = $conn->prepare($fetchApplicationDetailsQuery);
    $interest = 1;
    $fetchApplicationDetails->bind_param("iss", $interest, $_SESSION["user_email"], $_GET["jid"]);
    $fetchApplicationDetails->execute();
    $result = $fetchApplicationDetails->get_result();

    while ($row = $result->fetch_assoc()) {
        echo '<div class="company-container">
            <div class="company-logo-container">
                <img src="../Data/Companies/Company_Logo/' . $row['clogo'] . '" alt="">
                <p>' . $row['cname'] . '</p>
            </div>
            <p><strong>Apply Date:</strong> ' . $row['applydate'] . '</p>
        </div>
        <div class="position-application-container">
            <p class="position"><strong>Position:</strong> ' . $row['position'] . '</p>';

        $jid = (int)$_GET['jid'];

        // Add placed condition
        $totalRoundsFailQuery = "SELECT COUNT(*) as total_rounds 
        FROM rounds as R
        INNER JOIN studentrounds as S ON S.R_id = R.R_id
        WHERE S.S_College_Email = ? AND R.J_id = ? AND S.RoundStatus = ?";

        $totalRoundsFail = $conn->prepare($totalRoundsFailQuery);
        $status = 'rejected';
        $totalRoundsFail->bind_param("sis", $_SESSION["user_email"], $jid, $status);
        $totalRoundsFail->execute();
        $totalRoundsFailResult = $totalRoundsFail->get_result();
        $totalRoundsFailCount = $totalRoundsFailResult->fetch_assoc()['total_rounds'];

        if ($totalRoundsFailCount > 0) {
            echo '<p><strong>Status:</strong> Rejected</p>';
            echo '</div>';
            echo '<a href="./my-applications-feedback.php"><button>Give Feedback</button></a>';
            return false;
        }


        $totalRoundsQuery = "SELECT COUNT(*) as total_rounds 
        FROM rounds as R
        INNER JOIN studentrounds as S ON S.R_id = R.R_id
        WHERE S.S_College_Email = ? AND R.J_id = ?";

        $totalRounds = $conn->prepare($totalRoundsQuery);
        $totalRounds->bind_param("si", $_SESSION["user_email"], $jid);
        $totalRounds->execute();
        $totalRoundsResult = $totalRounds->get_result();
        $totalRoundsCount = $totalRoundsResult->fetch_assoc()['total_rounds'];

        $totalRoundsPassedQuery = "SELECT COUNT(*) as passed_rounds 
        FROM rounds as R
        INNER JOIN studentrounds as S ON S.R_id = R.R_id
        WHERE S.S_College_Email = ? AND R.J_id = ? AND S.RoundStatus = ?";

        $totalRoundsPassed = $conn->prepare($totalRoundsPassedQuery);
        $status = 'passed';
        $totalRoundsPassed->bind_param("sis", $_SESSION["user_email"], $jid, $status);
        $totalRoundsPassed->execute();
        $totalRoundsPassedResult = $totalRoundsPassed->get_result();
        $totalRoundsPassedCount = $totalRoundsPassedResult->fetch_assoc()['passed_rounds'];

        if ($totalRoundsCount == $totalRoundsPassedCount) {
            echo '<p><strong>Status:</strong> Passed</p>';
            echo '</div>';
            echo '<a href="./my-applications-feedback.php"><button>Give Feedback</button></a>';
        } else {
            echo '<p><strong>Status:</strong> Pending</p>';
            echo '</div>';
        }
    }
}

function getApplicationRoundDetails()
{
    global $conn;

    // Fetch application details
    $fetchApplicationRoundDetailsQuery = "SELECT R.Round_no round, R.Location location, R.Link link, R.Time time1, R.Date date1, S.RoundStatus status1, R.Description description  
FROM rounds as R
INNER JOIN studentrounds as S ON S.R_id = R.R_id
WHERE
S.S_College_Email = ? AND R.J_id = ?;";

    $jid = (int)$_GET['jid'];
    $fetchApplicationRoundDetails = $conn->prepare($fetchApplicationRoundDetailsQuery);
    $interest = 1;
    $fetchApplicationRoundDetails->bind_param("si", $_SESSION["user_email"], $jid);
    $fetchApplicationRoundDetails->execute();
    $result = $fetchApplicationRoundDetails->get_result();

    while ($row = $result->fetch_assoc()) {
        echo '<br><hr><br>
                    <div class="round-heading">
                        <h3>Round ' . $row['round'] . ':</h3>
                        <p><strong>Round Status:</strong> ' . $row['status1'] . '</p>
                    </div>
                    <div class="round-details">
                        <p><strong>Date:</strong> ' . $row['date1'] . '</p>
                        <p><strong>Time:</strong> ' . $row['time1'] . '</p>
                        <p><strong>Link:</strong>  ' . $row['link'] . '</p>
                        <p><strong>Details:</strong> <p style="white-space: pre-wrap;">' . $row['description'] . '</p></p>
                        
                    </div>';
    }

    $jid = (int)$_GET['jid'];

    $totalRoundsQuery = "SELECT COUNT(*) as total_rounds 
        FROM rounds as R
        INNER JOIN studentrounds as S ON S.R_id = R.R_id
        WHERE S.S_College_Email = ? AND R.J_id = ?";

    $totalRounds = $conn->prepare($totalRoundsQuery);
    $totalRounds->bind_param("si", $_SESSION["user_email"], $jid);
    $totalRounds->execute();
    $totalRoundsResult = $totalRounds->get_result();
    $totalRoundsCount = $totalRoundsResult->fetch_assoc()['total_rounds'];

    $totalRoundsPassedQuery = "SELECT COUNT(*) as passed_rounds 
        FROM rounds as R
        INNER JOIN studentrounds as S ON S.R_id = R.R_id
        WHERE S.S_College_Email = ? AND R.J_id = ? AND S.RoundStatus = ?";

    $totalRoundsPassed = $conn->prepare($totalRoundsPassedQuery);
    $status = 'passed';
    $totalRoundsPassed->bind_param("sis", $_SESSION["user_email"], $jid, $status);
    $totalRoundsPassed->execute();
    $totalRoundsPassedResult = $totalRoundsPassed->get_result();
    $totalRoundsPassedCount = $totalRoundsPassedResult->fetch_assoc()['passed_rounds'];

    if ($totalRoundsCount == $totalRoundsPassedCount) {
        echo '</div>';
        echo '<div class="sections">
                    <div class="offer-letter-container">
                        <p style="white-space: pre;"><strong>Offer Letter:</strong> <span class="offer-letter">offerletter.pdf </span>  <i class="fa-solid fa-upload fa-sm" style="color: #0C07E4;"></i>  <i class="fa-solid fa-xmark fa-lg" style="color: #FB1616;"></i> </p>
                        <a href=""><button>Submit</button></a>
                    </div>
                </div>';
    } else {
        echo '</div>';
    }
}

function getNotifications()
{
    global $conn;
    $fetchNotificationsQuery = "SELECT ND.Message AS message,ND.Subject AS subject,ND.Attachment1 AS attach1,ND.Attachment2 AS attach2,ND.Notification_Date AS notidate
    FROM 
    notificationdetails AS ND
    INNER JOIN studentnotifications AS SN ON ND.Notification_ID = SN.Notification_ID
    WHERE 
    SN.S_College_Email = ? AND ND.Notification_Due_Date >= CURRENT_DATE;";

    $fetchNotifications = $conn->prepare($fetchNotificationsQuery);
    $fetchNotifications->bind_param("s", $_SESSION["user_email"]);
    $fetchNotifications->execute();
    $result = $fetchNotifications->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $timestamp = $row["notidate"];
            $istTimeZone = new DateTimeZone('Asia/Kolkata');
            $dateTime = new DateTime($timestamp);
            $dateTime->setTimezone($istTimeZone);
            $date = $dateTime->format('Y-m-d');
            $time = $dateTime->format('h:i:s A');
            echo '<div class="sections">
                        <div class="company-container">
                            <p><strong>Date:</strong> ' . $date . '</p>
                            <p><strong>Time:</strong> ' . $time . '</p>
                        </div>
                        <p class="subject"><strong>Subject:</strong> ' . $row["subject"] . '</p>
                        <p class= "message"><strong>Message:</strong> ' . $row["message"] . '</p>';

            if ($row['attach1'] != NULL) {
                echo '<a href="../Data/Notifications/' . $row['attach1'] . '"><button class="attachment1">Attachment 1</button></a>';
            }
            if ($row['attach2'] != NULL) {
                echo '<a href="../Data/Notifications/' . $row['attach2'] . '"><button class="attachment2">Attachment 2</button></a>';
            }
            echo  '</div>';
        }
    } else {
        echo '<div class="sections">No Notifications </div>';
    }
}
