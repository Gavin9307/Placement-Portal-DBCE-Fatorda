<header>
    <div class="header-container">
        <div class="left-part">
            <img src="../Assets/dbce-logo.jpeg" alt="" class="logo">
            <h2>Placement Portal - Don Bosco College of Engineering</h2>
        </div>
        <ul class="right-part">
            <?php
            if (!isset($_SESSION['user_type'])) {
                echo '<a href="../sign-in.php"><li>Sign in</li></a>
                            <a href="../sign-up.php"><li>Sign up</li></a>
                            <a href="../student-support.php"><li>Contact Us</li></a>';
            } else {
                if ($_SESSION['user_type'] == "stu") {
                    echo '<a href="../Students/dashboard.php"><li>Dashboard</li></a>
                                <a href="../student-support.php"><li>Contact Us</li></a>';
                } else if ($_SESSION['user_type'] == "pc") {
                    echo '<a href="../PlacementCoordinator/dashboard.php"><li>Dashboard</li></a>';
                } else if ($_SESSION['user_type'] == "tpo") {
                    echo '<a href="../PlacementCoordinator/dashboard.php"><li>Dashboard</li></a>';
                }
            }
            ?>

        </ul>
    </div>
</header>