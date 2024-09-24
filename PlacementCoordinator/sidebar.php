<?php
require "../conn.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["user_type"]) && isset($_SESSION["user_email"])) {
    $usertype = $_SESSION["user_type"]; // For Restriction
    $useremail = $_SESSION["user_email"];

    $fetchStudentQuery = "SELECT PC_Email,PC_Fname,PC_Lname,PC_Profile_pic from placementcoordinator
WHERE PC_Email= ?;";
    $fetchStudent = $conn->prepare($fetchStudentQuery);
    $fetchStudent->bind_param("s", $useremail);
    $fetchStudent->execute();
    $result = $fetchStudent->get_result();

    if ($result->num_rows > 0) {
        $userInfo = $result->fetch_assoc();
        $userName = htmlspecialchars($userInfo['PC_Fname'] . ' ' . $userInfo['PC_Lname']);
        $userProfilePic = htmlspecialchars($userInfo['PC_Profile_pic']);
        $userEmail = htmlspecialchars($useremail);

        echo '<div class="side-bar-container">
    <div class="fixed-container">
        <div class="top-container">
            <img src="../Data/Placement_Coordinators/Profile_Images/'.$userProfilePic.'" alt="">
            <p>'.$userName.'</p>
            <p>'.$userEmail.'</p>
            <a href="../logout.php"><button id="logout">Logout</button></a>
        </div>

        <div class="bottom-container">
            <a href="./student-management.php"><button id="studentmanagement">Student Management</button></a>
            <a href="./company.php"><button id="companymanagement">Company Management</button></a>
            <a href="./job-management.php"><button id="jobmanagement">Job Management</button></a>
            <a href="./notifications.php"><button id="notifications">Send Notifications</button></a>
            <!-- <a href="./Placement-Coordinator.php"><button id="placementcoordinator">Placement Coordinators</button></a> -->
            <a href="./analysis-and-report-yearly.php"><button id="analysisreport">Analysis & Reports</button></a>
            <a href="./add-departments.php"><button id="departments">Department Management</button></a>
        </div>
    </div>
</div>';
} else {
    // Case where results are not obtained
    }
} else {
    // Case where session variables are not set
    // Restricted
    echo "Session variables not set.";
}





