<?php
require "../restrict.php";
require "../utility_functions.php";
require "../conn.php";

if (!isset($_GET["jid"])){
    header("Location: ./job-opportunities.php");
    exit();
}
global $conn;

if (isset($_GET["interest"])) {
    $interest = (int)$_GET["interest"];
    $jid = (int)$_GET["jid"];
    $email = $_SESSION['user_email'];

    $UpdateQuery = "UPDATE jobapplication J
                    SET J.Interest = ?
                    WHERE J.J_id = ? AND J.S_College_Email = ?;";

    $Update = $conn->prepare($UpdateQuery);
    if (!$Update) {
        die("Prepare failed: " . $conn->error);
    }

    $Update->bind_param("iis", $interest, $jid, $email);
    if (!$Update->execute()) {
        die ("Execute failed: " . $Update->error);
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
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Job Opportunities</h2>

                <div class="sections">
                    <?php
                        getJobDetail($_GET['jid']);
                    ?>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>