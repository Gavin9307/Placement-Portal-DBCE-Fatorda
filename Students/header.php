<header>
    <div class="header-container">
        <div class="left-part">
            <img src="../Assets/dbce-logo.jpeg" alt="" class="logo">
            <h2>Placement Portal - Don Bosco College of Engineering</h2>
        </div>
        <ul class="right-part">
            <a href="./dashboard.php">
                <li>Dashboard</li>
            </a>
            <a href="../student-support.php">
                <li>Contact Us</li>
            </a>
            <div class="notifications">
                <a href="./notifications.php">
                    <?php
                    global $conn;
                    $fetchNotificationsQuery = "SELECT ND.Message AS message
                    FROM 
                    notificationdetails AS ND
                    INNER JOIN studentnotifications AS SN ON ND.Notification_ID = SN.Notification_ID
                    WHERE 
                    SN.S_College_Email = ? AND ND.Notification_Due_Date >= CURRENT_DATE;";

                    $fetchNotifications = $conn->prepare($fetchNotificationsQuery);
                    $fetchNotifications->bind_param("s", $_SESSION["user_email"]);
                    $fetchNotifications->execute();
                    $result = $fetchNotifications->get_result();

                    if ($result->num_rows > 0) {
                        echo '<div class="dot">.</div>';
                    }
                    ?>

                    <i class="fa-solid fa-bell"></i></a>
            </div>
            <a href="./my-profile.php">
                <li class="profile-container">
                    <?php
                    global $conn;
                    $fetchUserQuery = "SELECT S_Fname,S_Profile_pic from student where S_College_Email = ?";
                    $fetchUser = $conn->prepare($fetchUserQuery);
                    $fetchUser->bind_param("s", $_SESSION["user_email"]);
                    $fetchUser->execute();
                    $result = $fetchUser->get_result();
                    $row = $result->fetch_assoc();
                    echo '<span>' . $row["S_Fname"] . '</span>
                        <img src="../Data/Students/Profile_Images/' . $row["S_Profile_pic"] . '" alt="">';
                    ?>
                </li>
            </a>
        </ul>
    </div>
</header>