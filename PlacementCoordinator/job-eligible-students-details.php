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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/eligible-students-details.css">
    <title>Eligible Student Details</title>
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
                        Eligible Students</h2>
                        <?php
                                $jjid = (int) $_GET['jid'];
                                $companyQuery = "SELECT c.C_Name as company_name,c.C_Logo as company_logo FROM company as c INNER JOIN jobposting as jp on jp.C_id=c.C_id WHERE jp.J_id= ?";
                                $company = $conn->prepare($companyQuery);
                                $company->bind_param("i",$jjid);
                                $company->execute();
                                $result = $company->get_result();
                                $row=$result->fetch_assoc();
                                echo '<div class="company-container">
                        
                        <img width="100px" height="100px" src="../Data/Companies/Company_Logo/' . $row['company_logo'] . '" alt="' . $row['company_name'] . '">
                    </div>'
                        ?>
                    
                </div>
                <div class="sections">
                   <?php getEligibleStudentsDetails(); ?>
                </div>

            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>