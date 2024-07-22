<?php


function getFeedbacks() {
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
            $FStudentName = $row["fname"]." ".$row["lname"];
            $FStudentrating = $row["rating"];
        }
        echo '<div class="students-review">
                    <div class="students-container">
                        <div class="students-logo-container">
                            <img src="../Data/Students/Profile_Images/'.$FStudentLogo.'" alt="">
                            <p>'.$FStudentName.'</p>
                        </div>
                        <div class="rating-container">';
        $i = 0;
        while ($i<$FStudentrating && $i < 5){
            echo '<span class="fa fa-star checked fa-xl"></span>';
            $i++;
        }
        while ($i < 5) {
            echo '<span class="fa fa-star fa-xl"></span>';
            $i++;
        }
        echo '</div>
                    </div>
                    <p class="students-message">'.$FStudentMessage.'</p>
                </div>';
    }
    else {
        // No feedbacks
    }
}

function getJobOffers($email) {
    global $conn;
    $fetchJobQuery = "SELECT C.C_Name as cname, C.C_Logo clogo, P.J_Due_date duedate, P.J_Position position, J.J_id jid 
FROM company as C
INNER JOIN jobposting as J ON J.C_id = C.C_id
INNER JOIN jobplacements as P ON P.J_id = J.J_id
WHERE
P.J_Due_date >= CURRENT_DATE;";

    $fetchJob = $conn->prepare($fetchJobQuery);
    $fetchJob->execute();
    $result = $fetchJob->get_result();

    while( $row = $result->fetch_assoc() ) {
        echo '<div class="sections">
                    <div class="company-container">
                        <div class="company-logo-container">
                            <img src="../Data/Companies/Company_Logo/'.$row['clogo'].'" alt="">
                            <p>'.$row['cname'].'</p>
                        </div>
                        <p><strong>Due Date:</strong> '.$row['duedate'].'</p>
                    </div>
                    <p class="position"><strong>Position:</strong> '.$row['position'].'</p>
                    <a href="./job-opportunities-detail.php?jid='.$row['jid'].'" ?><button>View More</button></a>
                </div>';
    }
}

function getJobDetail($job_id) {
    global $conn;
    $fetchJobDetailQuery = "SELECT C.C_Name as cname, C.C_Logo clogo, P.J_Due_date duedate, P.J_Position position, P.J_Description description, A.Interest interest
FROM company as C
INNER JOIN jobposting as J ON J.C_id = C.C_id
INNER JOIN jobplacements as P ON P.J_id = J.J_id
INNER JOIN jobapplication as A ON A.J_id = P.J_id
WHERE
P.J_Due_date >= CURRENT_DATE AND J.J_id = ?";

    $fetchJobDetail = $conn->prepare($fetchJobDetailQuery);
    $fetchJobDetail->bind_param("i", $job_id);
    $fetchJobDetail->execute();
    $result = $fetchJobDetail->get_result();

    while( $row = $result->fetch_assoc() ) {
        echo '<div class="company-container">
                        <div class="company-logo-container">
                            <img src="../Data/Companies/Company_Logo/'.$row['clogo'].'" alt="">
                            <p>'.$row['cname'].'</p>
                        </div>
                        <p><strong>Due Date:</strong> '.$row['duedate'].'</p>
                    </div>
                   <p class="position"><strong>Position:</strong> '.$row['position'].'</p>
                    <p class=""><strong>Details:</strong>
                    <p style="white-space: pre;">Job Description:
                        '.$row['description'].'
                    </p>
                    </p>';

                    if ($row['interest'] == 0) {
                        echo '<div class="interest-button-container">
                                <a href="./job-opportunities-detail.php?jid='.$job_id.'&interest=1"><button class="interested">Mark as Interested</button></a>
                                <a href="./job-opportunities-detail.php?jid='.$job_id.'&interest=0"><button class="not-interested">Not Interested</button></a>
                              </div>';
                    } else {
                        echo '<div class="interest-button-container">
                                <a href="./job-opportunities-detail.php?jid='.$job_id.'&interest=0"><button class="interested">Mark as Not Interested</button></a>
                              </div>';
                    }
    }
}

function getApplications(){
    global $conn;
    $fetchApplicationsQuery = "SELECT C.C_Name as cname, C.C_Logo clogo, A.J_apply_date applydate, P.J_Position position, A.J_id as jid 
FROM company as C
INNER JOIN jobposting as J ON J.C_id = C.C_id
INNER JOIN jobplacements as P ON P.J_id = J.J_id
INNER JOIN jobapplication as A ON A.J_id = J.J_id
WHERE A.Interest = ? AND A.S_College_Email = ?;";

    $fetchApplications = $conn->prepare($fetchApplicationsQuery);
    $z = 1;
    $fetchApplications->bind_param("is",$z,$_SESSION["user_email"]);
    $fetchApplications->execute();
    $result = $fetchApplications->get_result();

    while( $row = $result->fetch_assoc() ) {
        echo '<div class="sections">
                    <div class="company-container">
                        <div class="company-logo-container">
                            <img src="../Data/Companies/Company_Logo/'.$row['clogo'].'" alt="">
                            <p>'.$row['cname'].'</p>
                        </div>
                        <p><strong>Apply Date:</strong> '.$row['applydate'].'</p>
                    </div>
                    <p class="position"><strong>Position:</strong> '.$row['position'].'</p>
                    <a href="./my-applications-details.php?jid='.$row['jid'].'"><button>View More</button></a>
                </div>';
    }
}

function getApplicationDetails(){
    global $conn;
    $fetchApplicationDetailsQuery = "SELECT C.C_Name as cname, C.C_Logo clogo, A.J_apply_date applydate, P.J_Position position, A.J_id as jid 
FROM company as C
INNER JOIN jobposting as J ON J.C_id = C.C_id
INNER JOIN jobplacements as P ON P.J_id = J.J_id
INNER JOIN jobapplication as A ON A.J_id = J.J_id
WHERE A.Interest = ? AND A.S_College_Email = ?;";

    $fetchApplicationDetails = $conn->prepare($fetchApplicationDetailsQuery);
    $z = 1;
    $fetchApplicationDetails->bind_param("is",$z,$_SESSION["user_email"]);
    $fetchApplicationDetails->execute();
    $result = $fetchApplicationDetails->get_result();

    while( $row = $result->fetch_assoc() ) {
        echo '<div class="company-container">
                        <div class="company-logo-container">
                            <img src="../Data/Companies/Company_Logo/'.$row['clogo'].'" alt="">
                             <p>'.$row['cname'].'</p>
                        </div>
                        <p><strong>Apply Date:</strong> '.$row['applydate'].'</p>
                    </div>
                    <div class="position-application-container">
                        <p class="position"><strong>Position:</strong> '.$row['position'].'</p>';

        // Calculate rounds passed
        $jid = (int)$_GET['jid'];
        $totalRoundsQuery = "SELECT R.Round_no round, R.Location location, R.Link link, R.Time time1, R.Date date1, S.RoundStatus status1, R.Description description  
FROM rounds as R
INNER JOIN studentrounds as S ON S.R_id = R.R_id
WHERE
S.S_College_Email = ? AND R.J_id = ?";
    $totalRounds = $conn->prepare($totalRoundsQuery);
    $totalRounds->bind_param("si",$_SESSION["user_email"],$jid);
    $totalRounds->execute();
    $totalRounds->get_result();
    
    $jid = (int)$_GET['jid'];
        $totalRoundsPassedQuery = "SELECT R.Round_no round, R.Location location, R.Link link, R.Time time1, R.Date date1, S.RoundStatus status1, R.Description description  
FROM rounds as R
INNER JOIN studentrounds as S ON S.R_id = R.R_id
WHERE
S.S_College_Email = ? AND R.J_id = ? AND S.RoundStatus = ?";
    $totalRoundsPassed = $conn->prepare($totalRoundsPassedQuery);
    $stat = 'passed';
    $totalRoundsPassed->bind_param("sis",$_SESSION["user_email"],$jid,$stat);
    $totalRoundsPassed->execute();
    $totalRoundsPassed->get_result();

        if ($totalRounds->num_rows == $totalRoundsPassed->num_rows){
            echo '<p><strong>Status:</strong> Passed</p>
                        </div>';
        }
        else {
            echo '<p><strong>Status:</strong> Pending</p>
                        </div>';
        }
                        
    }
}

?>