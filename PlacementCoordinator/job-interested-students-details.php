<?php
require "../conn.php";
require "../restrict.php";
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

    echo "<script>
        setTimeout(function() {
            window.location.href = window.location.href;
        }, 2000);
    </script>";
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
                </div>
                <!-- <div class="eligible-company">
                    <div class="company-container">
                        <p>Google</p>
                    </div>
                </div> -->
                <div class="sections">
                    <?php getInterestedStudentsDetails(); ?>

                    
                </div>

            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>