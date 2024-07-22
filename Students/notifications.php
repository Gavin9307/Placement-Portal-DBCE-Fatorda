<?php
    require "../restrict.php";
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/notifications.css">
    <title>Notifications</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Notifications</h2>

                <div class="sections">
                    <div class="company-container">
                        <p><strong>Date:</strong> 12/12/2003</p>
                        <p><strong>Time:</strong> 6:24pm</p>
                    </div>
                    <p class="subject"><strong>Subject:</strong> Round 1 for Google Location updated</p>
                    <p class= "message"><strong>Message:</strong> Lorem ipsum dolor sit amet consectetur. Tellus mauris blandit sagittis ligula sollicitudin elit. Quam integer ac scelerisque amet fermentum fringilla lacus urna. Iaculis sit quam</p>
                    <a href=""><button>Dismiss</button></a>
                </div>

                <div class="sections">
                    <div class="company-container">
                        <p><strong>Date:</strong> 12/12/2003</p>
                        <p><strong>Time:</strong> 6:24pm</p>
                    </div>
                    <p class="subject"><strong>Subject:</strong> Round 1 for Google Location updated</p>
                    <p class= "message"><strong>Message:</strong> Lorem ipsum dolor sit amet consectetur. Tellus mauris blandit sagittis ligula sollicitudin elit. Quam integer ac scelerisque amet fermentum fringilla lacus urna. Iaculis sit quam</p>
                    <a href=""><button>Dismiss</button></a>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>