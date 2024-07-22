<?php
require "../conn.php";
require "../restrict.php";
include "../utility_functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["user_type"]) && isset($_SESSION["user_email"])) {
    $average_rating = 0;
    $usertype = $_SESSION["user_type"]; // For Restriction
    $useremail = $_SESSION["user_email"];

    $fetchStudentQuery = "SELECT S.S_10th_marksheet as marksheet_10, S.S_12th_marksheet as marksheet_12, S.S_10th_Perc as percentage_10, S.S_12th_Perc as percentage_12, S.S_Address as address, S.S_College_Email as cemail, S.S_Fname as fname, S.S_Lname as lname, S.S_Mname as mname, S.S_Personal_Email as pemail, S.S_Phone_no as phoneno, S.S_PR_No as prno, S.S_Resume as resume, S.S_Roll_no as rollno, S.S_Year_of_Admission as yoa, C.Class_name as class, D.Dept_name as department, S.S_Profile_pic as image, R.Sem1_SGPA as sem1, R.Sem2_SGPA as sem2, R.Sem3_SGPA as sem3,R.Sem4_SGPA as sem4,R.Sem5_SGPA as sem5,R.Sem6_SGPA as sem6,R.Sem7_SGPA as sem7,R.Sem8_SGPA as sem8,R.CGPA as cgpa,R.has_backlogs as backs FROM student S INNER JOIN class as C ON C.Class_id = S.S_Class_id INNER JOIN department as D ON D.Dept_id = C.Dept_id INNER JOIN result as R ON R.S_College_Email = S.S_College_Email WHERE S.S_College_Email = ?;";
    $fetchStudent = $conn->prepare($fetchStudentQuery);
    $fetchStudent->bind_param("s", $_SESSION["user_email"]);
    $fetchStudent->execute();
    $result = $fetchStudent->get_result();
    
} else {
    echo "Session variables not set.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/job-opportunities.css">
    <title>Job Opportunities</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Job Opportunities</h2>

                <div class="sections">
                    <div class="company-container">
                        <div class="company-logo-container">
                            <img src="../Assets/profile.jpg" alt="">
                            <p>Google</p>
                        </div>
                        <p><strong>Due Date:</strong> 12/12/2003</p>
                    </div>
                    <p class="position"><strong>Position:</strong> Associate Developer</p>
                    <a href="./my-applications-details.html"><button>View More</button></a>
                </div>

            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>