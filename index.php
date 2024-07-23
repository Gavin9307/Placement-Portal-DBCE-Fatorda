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
                    } else {
                        if ($_SESSION['user_type'] == "stu") {
                            echo '<a href="./Students/dashboard.php"><li>Dashboard</li></a>
                                <a href="./student-support.php"><li>Contact Us</li></a>';
                        } else if ($_SESSION['user_type'] == "pc") {
                            echo '<a href="./PlacementCoordinator/dashboard.php"><li>Dashboard</li></a>';
                        } else if ($_SESSION['user_type'] == "tpo") {
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
                        } else {
                            if ($_SESSION['user_type'] == "stu") {
                                echo '<a href="./Students/dashboard.php"><button class="sign-up">Dashboard</button></a>';
                            } else if ($_SESSION['user_type'] == "pc") {
                                echo '<a href="./PlacementCoordinator/dashboard.php"><button class="sign-up">Dashboard</button></a>';
                            } else if ($_SESSION['user_type'] == "tpo") {
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
            <div class="section-container">
            <h3>Companies at DBCE</h3>
                <div class="scroll-container">
                    <div>
                    <div class="language-loop">
                        <div class="language-list">
                            <div class="language">OneShield</div>
                            <div class="language">Capgemini</div>
                            <div class="language">Advenz</div>
                            <div class="language">Appstrail</div>
                            <div class="language">Borkars</div>
                            <div class="language">Canon</div>
                            <div class="language">CEAT</div>
                            <div class="language">Nestle</div>
                            <div class="language">Godrej</div>
                            <div class="language">Sankalp</div>
                            <div class="language">Siemens</div>
                            <div class="language">Stalwart</div>
                            <div class="language">CocaCola</div>
                            <div class="language">Accenture</div>
                            <div class="language">Citrix</div>
                            <!-- Repeat -->
                            <div class="language">OneShield</div>
                            <div class="language">Capgemini</div>
                            <div class="language">Advenz</div>
                            <div class="language">Appstrail</div>
                            <div class="language">Borkars</div>
                            <div class="language">Canon</div>
                            <div class="language">CEAT</div>
                            <div class="language">Nestle</div>
                            <div class="language">Godrej</div>
                            <div class="language">Sankalp</div>
                            <div class="language">Siemens</div>
                            <div class="language">Stalwart</div>
                            <div class="language">CocaCola</div>
                            <div class="language">Accenture</div>
                            <div class="language">Citrix</div>
                        </div>
                    </div>
                    <div class="language-loop">
                        <div class="logos-list">
                            <div class=""><img src="./Assets/Logos/oneshield.png" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/capegemini.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/adventz.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/Apstral.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/Borkar.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/canon.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/Ceat.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/Nestle.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/godrej.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/sankalp.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/siemens.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/stalwart.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/cocacola.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/accenture.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/citrix.jpg" class="logos" alt=""></div>
                             <!-- Repeat -->
                            <div class=""><img src="./Assets/Logos/oneshield.png" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/capegemini.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/adventz.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/Apstral.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/Borkar.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/canon.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/Ceat.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/Nestle.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/godrej.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/sankalp.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/siemens.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/stalwart.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/cocacola.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/accenture.jpg" class="logos" alt=""></div>
                            <div class=""><img src="./Assets/Logos/citrix.jpg" class="logos" alt=""></div>
                        </div>
                    </div>
                    </div>
                </div>
                <a href="./Companies/companies.php"><button class="sign-up adjust">View Companies</button></a>
            </div>
        </section>

        <?php include 'footer.php' ?>
    </div>
</body>

</html>