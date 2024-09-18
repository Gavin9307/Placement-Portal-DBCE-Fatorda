<?php
    require "../restrict.php";
    require "../restrict_placement_coordinator.php";
    require "../utility_functions.php";
    require "../conn.php";
    if (!isset($_GET["jid"])){
        header("Location: ./my-applications.php");
        exit();
    }
    global $conn;

    if (isset($_POST["update-offer"])){
        $jid = $_GET["jid"];
        $offer = empty($_POST["offer"]) ? "":$_POST["offer"];
        $updateQuery = "UPDATE jobapplication SET Offer_Letter = ? WHERE J_id = ? AND S_College_Email = ?";
        $Update = $conn->prepare($updateQuery);
        $Update->bind_param("sis",$offer,$jid,$_SESSION["user_email"]);
        $Update->execute();
        header("Location: ./my-applications-details.php?jid=".$_GET['jid']."");
        exit();
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/my-applications-details.css">
    <title>My Application Details</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./my-applications.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    My Applications</h2>

                <div class="sections">
                    <?php
                        getApplicationDetails();
                    ?>
            
                    <?php
                        getApplicationRoundDetails()
                    ?>

                
            </div>
        </div>

        

        <?php include './footer.php' ?>
    </div>

</body>

</html>