<?php
    require "../restrict.php";
    require "../utility_functions.php";
    require "../conn.php";
    if (!isset($_GET["jid"])){
        header("Location: ./my-applications.php");
        exit();
    }
    global $conn;

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