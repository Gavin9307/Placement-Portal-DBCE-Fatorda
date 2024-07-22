<?php
    require "../restrict.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/my-applications-feedback.css">
    <title>My Applications</title>
    
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    My Applications</h2>

                <div class="sections">
                        <div class="company-logo-container">
                            <h3>Company Feedback</h3>
                            <img src="../Assets/oneshield.png" alt="">
                        </div>
                        <form action="">
                            <label for="message"><strong>Message:</strong></label>
                            <textarea class="user-input-message" placeholder="Enter your message" required></textarea><br><br>
    
                            <button>Submit</button>
                            <strong>Ratings:</strong> 
                            <span class="rating-container">
                                <span class="fa fa-star checked fa-xl"></span>
                                <span class="fa fa-star checked fa-xl"></span>
                                <span class="fa fa-star checked fa-xl"></span>
                                <span class="fa fa-star checked fa-xl"></span>
                                <span class="fa fa-star fa-xl"></span>
                            </span>
                            <button>Submit</button>
                        </form>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>