<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>

    <link rel="stylesheet" href="style.css">
    <title>Placement Portal @ DBCE</title>
</head>
<body>
    <div id="wrapper">
        <header>
            <div class="header-container">
                <div class="left-part">
                    <img src="./Assets/dbce-logo.jpeg" alt="" class="logo">
                    <h2>Placement Portal - Don Bosco College of Engineering</h2>
                </div>
                <ul class="right-part">
                    <a href="./sign-in.php"><li>Sign in</li></a>
                    <a href="./sign-up.php"><li>Sign up</li></a>
                    <a href="./student-support.php"><li>Contact Us</li></a>
                </ul>
            </div>
        </header>

        <main>
            <div class="main-container">
                <div class="main-left-part">
                    <h3>Welcome to Don Bosco <br> College of Engineering <br> Placement <br> Portal</h3>
                    <div class="button-container">
                        <a href="./sign-up.php"><button class="sign-up">Sign up</button></a>
                        <a href="./sign-in.php"><button class="sign-in">Sign in</button></a>
                    </div>
                </div>
                <img src="./Assets/interview-image.jpg" alt="">
            </div>
        </main>
        
        <?php include 'footer.php' ?>
    </div>
</body>
</html>