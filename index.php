<?php 
    if (!isset($_SESSION)) {
        session_start();
    }
?>

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
                    <?php 
                        if (!isset($_SESSION['user_type'])) {
                            echo '<a href="./sign-in.php"><li>Sign in</li></a>
                            <a href="./sign-up.php"><li>Sign up</li></a>
                            <a href="./student-support.php"><li>Contact Us</li></a>';
                        }
                        else {
                            if ($_SESSION['user_type'] == "stu"){
                                echo '<a href="./Students/dashboard.php"><li>Dashboard</li></a>
                                <a href="./student-support.php"><li>Contact Us</li></a>';
                            }
                            else if ($_SESSION['user_type'] == "pc"){
                                echo '<a href="./PlacementCoordinator/dashboard.php"><li>Dashboard</li></a>';
                            }
                            else if ($_SESSION['user_type'] == "tpo"){
                                echo '<a href="./PlacementCoordinator/dashboard.php"><li>Dashboard</li></a>';
                            }
                        }
                    ?>
                    
                </ul>
            </div>
        </header>

        <main>
            <div class="main-container">
                <div class="main-left-part">
                    <h3>Welcome to Don Bosco <br> College of Engineering <br> Placement <br> Portal</h3>
                    <div class="button-container">
                        <?php 
                            if (!isset($_SESSION['user_type'])) {
                                echo '<a href="./sign-up.php"><button class="sign-up">Sign up</button></a>
                                <a href="./sign-in.php"><button class="sign-in">Sign in</button></a>';
                            }
                            else {
                                if ($_SESSION['user_type'] == "stu"){
                                    echo '<a href="./Students/dashboard.php"><button class="sign-up">Dashboard</button></a>';
                                }
                                else if ($_SESSION['user_type'] == "pc"){
                                    echo '<a href="./PlacementCoordinator/dashboard.php"><button class="sign-up">Dashboard</button></a>';
                                }
                                else if ($_SESSION['user_type'] == "tpo"){
                                    echo '<a href="./PlacementCoordinator/dashboard.php"><button class="sign-up">Dashboard</button></a>';
                                }
                            }
                        
                        ?>

                        
                    </div>
                </div>
                <img src="./Assets/interview-image.jpg" alt="">
            </div>
        </main>

        <section>
            <div class="main-container">
                <div class="scroll-container">
                        
                </div>
                <div>
                </div>
            </div>
        </section>
        
        <?php include 'footer.php' ?>
    </div>
</body>
</html>