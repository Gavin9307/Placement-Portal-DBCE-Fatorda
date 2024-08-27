<header>
    <div class="header-container">
        <div class="left-part">
            <img src="../Assets/dbce-logo.jpeg" alt="" class="logo">
            <h2>Placement Portal - Don Bosco College of Engineering</h2>
        </div>
        <ul class="right-part">
            <a href="../index.php"><li>Home</li></a>
            <a href="./dashboard.php"><li>Dashboard</li></a>
          <a href="./tpo-profile.php"> <li class="profile-container">
            <?php
                $fetchQuery = "SELECT pc.PC_Fname as fname,pc.PC_Profile_pic as pic 
                FROM placementcoordinator as pc
                WHERE pc.PC_Email = ?;";
                $fetch = $conn->prepare($fetchQuery);
                $fetch->bind_param("s",$_SESSION["user_email"]);
                $fetch->execute();
                $result5 = $fetch->get_result();
                $row5 = $result5->fetch_assoc();
                echo '<span>'.$row5["fname"].'</span>
                <img src="../Data/Placement_Coordinators/Profile_Images/'.$row5["pic"].'" alt="">';
            ?>
                
            </li></a> 
        </ul>
    </div>
</header>