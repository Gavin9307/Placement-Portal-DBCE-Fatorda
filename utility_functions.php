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

?>