<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>

    <link rel="stylesheet" href="./style-restricted.css">
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
                    <a href="./sign-in.php">
                        <li>Sign in</li>
                    </a>
                    <a href="./sign-up.php">
                        <li>Sign up</li>
                    </a>
                    <a href="./student-support.php">
                        <li>Contact Us</li>
                    </a>
                </ul>
            </div>
        </header>

        <main>
            <div class="main-container">
                <h3>OOPS!</h3>
                <p>You dont have access to view this page</p>
                <img src="./Assets/restricted.jpg" alt="">
                <p>Please login to get access</p>
            </div>
        </main>

        <?php include 'footer.php' ?>
    </div>
</body>

</html>