<?php
require "../conn.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["user_type"]) && isset($_SESSION["user_email"])) {
    $usertype = $_SESSION["user_type"]; // For Restriction
    $useremail = $_SESSION["user_email"];

    $fetchStudentQuery = "SELECT S_Fname, S_Lname, S_Profile_pic FROM student WHERE S_College_Email = ?";
    $fetchStudent = $conn->prepare($fetchStudentQuery);
    $fetchStudent->bind_param("s", $useremail);
    $fetchStudent->execute();
    $result = $fetchStudent->get_result();

    if ($result->num_rows > 0) {
        $userInfo = $result->fetch_assoc();
        $userName = htmlspecialchars($userInfo['S_Fname'] . ' ' . $userInfo['S_Lname']);
        $userProfilePic = htmlspecialchars($userInfo['S_Profile_pic']);
        $userEmail = htmlspecialchars($useremail);

        echo '<div class="side-bar-container">
                        <div class="fixed-container">
                            <div class="top-container">
                                <img src="../Data/Students/Profile_Images/'. $userProfilePic . '" alt="'.$userProfilePic.'">
                                <p>' . $userName . '</p>
                                <p>' . $userEmail . '</p>
                                <a href="../logout.php"><button>Logout</button></a>
                            </div>
                            <div class="bottom-container">
                                <a href="./my-profile.php"><button id="myprofile">Update Profile</button></a>
                                <a href="./performance-and-metrics.php"><button id="performance">Performance</button></a>
                                <a href="./my-applications.php"><button id="myapplications">My Application</button></a>
                                <a href="./job-opportunities.php"><button id="jobopportunities">Job Opportunities</button></a>
                                <a href="./notifications.php"><button id="notifications">Notifications</button></a>
                            </div>
                        </div>
                    </div>';
    } else {
    // Handle case where results are not obtained
    }
} else {
    // Handle case where session variables are not set
    // Restricted
    echo "Session variables not set.";
}
