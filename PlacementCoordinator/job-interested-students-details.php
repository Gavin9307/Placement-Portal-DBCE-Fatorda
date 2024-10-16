<?php
require "../conn.php";
require "../restrict.php";
require "../restrict_student.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_GET["jid"]) && !isset($_GET["semail"])) {
    header("Location: ./job-eligible-students.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-round-status'])) {
    $roundStatuses = $_POST['round_status'];
    $jid = (int) $_GET['jid'];
    $semail = (string) $_GET['semail'];

    foreach ($roundStatuses as $rid => $status) {
        $updateRoundStatusQuery = "UPDATE studentrounds SET RoundStatus = ? WHERE R_id = ? AND S_College_Email = ?";
        $updateRoundStatus = $conn->prepare($updateRoundStatusQuery);
        $updateRoundStatus->bind_param("sis", $status, $rid, $semail);
        $updateRoundStatus->execute();
    }

    $fetchTotalRoundQuery = "SELECT * FROM rounds WHERE J_id = ?";
    $fetchTotalRound = $conn->prepare($fetchTotalRoundQuery);
    $fetchTotalRound->bind_param("i", $jid);
    $fetchTotalRound->execute();
    $resultTotalRounds = $fetchTotalRound->get_result();
    $totalRounds = $resultTotalRounds->num_rows;

    $fetchPassedRoundQuery = "SELECT * FROM rounds AS r INNER JOIN studentrounds AS sr ON r.R_id = sr.R_id WHERE r.J_id = ? AND sr.S_College_Email = ? AND RoundStatus = 'passed';";
    $fetchPassedRound = $conn->prepare($fetchPassedRoundQuery);
    $fetchPassedRound->bind_param("is", $jid, $semail);
    $fetchPassedRound->execute();
    $resultPassedRounds = $fetchPassedRound->get_result();
    $PassedRounds = $resultPassedRounds->num_rows;

    if ($totalRounds != 0 && $totalRounds == $PassedRounds) {
        $updatePlacedStatusQuery = "UPDATE jobapplication SET placed = 1 WHERE J_id = ? AND S_College_Email = ?";
        $updatePlacedStatus = $conn->prepare($updatePlacedStatusQuery);
        $updatePlacedStatus->bind_param("is", $jid, $semail);
        $updatePlacedStatus->execute();

        $updatePlacedStudentStatusQuery = "UPDATE student SET PLACED = 1 WHERE S_College_Email = ?";
        $updatePlacedStudentStatus = $conn->prepare($updatePlacedStudentStatusQuery);
        $updatePlacedStudentStatus->bind_param("s", $semail);
        $updatePlacedStudentStatus->execute();
    } else {
        $updatePlacedStatusQuery = "UPDATE jobapplication SET placed = 0 WHERE J_id = ? AND S_College_Email = ?";
        $updatePlacedStatus = $conn->prepare($updatePlacedStatusQuery);
        $updatePlacedStatus->bind_param("is", $jid, $semail);
        $updatePlacedStatus->execute();

        $fetchQuery = "SELECT * FROM jobapplication WHERE S_College_Email = ? AND placed = 1";
        $fetch = $conn->prepare($fetchQuery);
        $fetch->bind_param("s", $semail);
        $fetch->execute();
        $res = $fetch->get_result();

        if ($res->num_rows == 0) {
            $updatePlacedStudentStatusQuery = "UPDATE student SET PLACED = 0 WHERE S_College_Email = ?";
            $updatePlacedStudentStatus = $conn->prepare($updatePlacedStudentStatusQuery);
            $updatePlacedStudentStatus->bind_param("s", $semail);
            $updatePlacedStudentStatus->execute();
        }
    }

    header("Location: ./job-interested-students-details.php?jid=$jid&semail=$semail");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/eligible-students-details.css">
    <title>Interested Student Details</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading">
                        <button style="all: unset;cursor:pointer;" onclick="history.back()">
                            <i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i>
                        </button>
                        Interested Students
                    </h2>
                    <?php
                    $jjid = (int) $_GET['jid'];
                    $companyQuery = "SELECT c.C_Name as company_name,c.C_Logo as company_logo FROM company as c INNER JOIN jobposting as jp on jp.C_id=c.C_id WHERE jp.J_id= ?";
                    $company = $conn->prepare($companyQuery);
                    $company->bind_param("i", $jjid);
                    $company->execute();
                    $result = $company->get_result();
                    $row = $result->fetch_assoc();
                    echo '<div class="company-container">
                        
                        <img width="100px" height="100px" src="../Data/Companies/Company_Logo/' . $row['company_logo'] . '" alt="' . $row['company_name'] . '">
                    </div>'
                    ?>
                </div>

                <div class="sections">
                    <?php getInterestedStudentsDetails(); ?>
                </div>
                <?php
                $jid = (int) $_GET['jid'];
                $semail = (string) $_GET['semail'];
                $fetchResultQuery = 'SELECT ja.Offer_Letter as offer_letter FROM `jobapplication` AS ja WHERE ja.J_id = ? AND ja.S_College_Email = ?';
                $fetchResult = $conn->prepare($fetchResultQuery);
                $fetchResult->bind_param("is", $jid, $semail);
                $fetchResult->execute();
                $result2 = $fetchResult->get_result();
                $row2 = $result2->fetch_assoc();
                if ($row2['offer_letter'] != '') {
                    echo ' <div class="sections">
                    <span><strong>Offer Letter : </strong></span>
                    <a style="margin-left:5px;" href="' . $row2['offer_letter'] . '">' . $row2['offer_letter'] . '</a>
                </div>';
                }

                ?>


            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>