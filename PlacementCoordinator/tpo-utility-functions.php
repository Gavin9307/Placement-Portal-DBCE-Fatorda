<?php

function getTpoNotifications()
{
    global $conn;

    $fetchNotificationsQuery = "SELECT ND.Notification_ID as nid, ND.Message AS message, ND.Subject AS subject, ND.Attachment1 AS attach1, ND.Attachment2 AS attach2, ND.Notification_Date AS notidate, ND.Notification_Due_Date as duedate
FROM notificationdetails AS ND
WHERE ND.PC_Email = ?
ORDER BY ND.Notification_Date DESC;";
    $fetchNotifications = $conn->prepare($fetchNotificationsQuery);
    $fetchNotifications->bind_param("s", $_SESSION["user_email"]);
    $fetchNotifications->execute();
    $result = $fetchNotifications->get_result();

    while ($row = $result->fetch_assoc()) {
        $timestamp = $row["notidate"];
        $istTimeZone = new DateTimeZone('Asia/Kolkata');
        $dateTime = new DateTime($timestamp);
        $dateTime->setTimezone($istTimeZone);
        $date = $dateTime->format('Y-m-d');
        $time = $dateTime->format('h:i:s A');

        echo '<div class="sections">
                    <div class="company-container">
                        <p><strong>Date:</strong> ' . $date . '</p>
                        <p><strong>Time:</strong> ' . $time . '</p>
                    </div>
                    <p><strong>Due Date:</strong> ' . $row["duedate"] . '</p>
                    <p class="subject"><strong>Subject:</strong> ' . $row["subject"] . '</p>
                    <p class= "message"><strong>Message:</strong> ' . $row["message"] . '</p>';

        if ($row['attach1'] != NULL) {
            echo '<a href="../Data/Notifications/' . $row['attach1'] . '" class="attachment-links">Attachment 1</a>';
        }

        if ($row['attach2'] != NULL) {
            echo '<a href="../Data/Notifications/' . $row['attach2'] . '" class="attachment-links">Attachment 2</a>';
        }

        echo '</p>
                    <a href="./notifications-edit.php?nid=' . $row["nid"] . '"><button class="edit-button">Edit</button></a>
                    <form action="" method="post">
                        <input type="number" value="' . $row["nid"] . '" hidden name="nid">
                        <button name="delete_noti" class="delete-button">Delete</button>
                    </form>
                </div>';
    }
}


function getLiveJobListings()
{
    global $conn;
    $fetchJobQuery = "
        SELECT P.Accept_Responses as acceptresponses, C.C_Name as cname, C.C_Logo clogo, P.J_Due_date duedate, P.J_Position position, J.J_id jid 
        FROM company as C
        INNER JOIN jobposting as J ON J.C_id = C.C_id
        INNER JOIN jobplacements as P ON P.J_id = J.J_id
        WHERE P.J_Due_date >= CURRENT_DATE;
    ";

    $fetchJob = $conn->prepare($fetchJobQuery);
    $fetchJob->execute();
    $result = $fetchJob->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row["jid"] = (int) $row["jid"];
            $fetchJobDeptQuery = "
            SELECT d.Dept_name dname FROM department as d
            INNER JOIN jobdepartments as jd on d.Dept_id = jd.Dept_id
            WHERE jd.J_id = ?;
        ";
            $fetchJobDept = $conn->prepare($fetchJobDeptQuery);
            $fetchJobDept->bind_param("i", $row["jid"]);
            $fetchJobDept->execute();
            $resultDept = $fetchJobDept->get_result();

            // Check if there are rounds associated with the job
            $fetchRoundsQuery = "SELECT R_id FROM rounds WHERE J_id = ?";
            $fetchRounds = $conn->prepare($fetchRoundsQuery);
            $fetchRounds->bind_param("i", $row["jid"]);
            $fetchRounds->execute();
            $resultRounds = $fetchRounds->get_result();
            $hasRounds = $resultRounds->num_rows > 0;

            echo '<div class="sections">
                <div class="company-container">
                    <div class="company-logo-container">
                        <img src="../Data/Companies/Company_Logo/' . $row['clogo'] . '" alt="">
                        <p>' . $row['cname'] . '</p>
                    </div>
                    <p><strong>Due Date:</strong> ' . date("d/m/Y", strtotime($row['duedate'])) . '</p>
                </div>
                <p class="position"><strong>Position:</strong> ' . $row['position'] . '</p>
                <p class="department"><strong>Departments </strong>: ';

            while ($rowDept = $resultDept->fetch_assoc()) {
                echo $rowDept["dname"] . " ";
            }

            echo '</p>
                <form action="" method="post">
                    <input name="jid" type="hidden" value="' . $row["jid"] . '">
                    <button name="delete-listing" class="delete-button">Delete</button>
                </form>';

            // Only show start/stop buttons if no rounds are associated
            if (!$hasRounds) {
                if ($row["acceptresponses"] == 1) {
                    echo '<div class="acceptresp-container"><div><a href="./job-management.php?jid=' . $row["jid"] . '&responsestatus=0"><button class="stop-button">Stop Accepting Responses</button></a></div>';
                } else {
                    echo '<div><a href="./job-management.php?jid=' . $row["jid"] . '&responsestatus=1"><button class="start-button">Accept Responses</button></a></div>';
                    // Only show "Add Rounds" button if "Start Accepting Responses" button is visible
                    echo '<div><a href="#" onclick="return confirmAddRounds(' . $row["jid"] . ');"><button class="add-rounds-button">Add Rounds</button></a></div>';
                }
            }

            echo '<div><a href="./job-live-listing-analysis.php?jid=' . $row["jid"] . '"><button class="analysis-button">Analysis</button></a></div>
                <div><a href="./job-edit.php?jid=' . $row["jid"] . '"><button class="edit-button">Edit Details</button></a></div></div>
            </div>';
        }
    } else {
        echo '<div class="sections">
                No Live Listings
            </div>';
    }
}




function getCompletedJobListings()
{
    global $conn;
    $fetchJobQuery = "SELECT c.C_Name as cname, j.J_Due_date as duedate, SUM(ja.placed) as totalplaced
        FROM company as c 
        INNER JOIN jobposting as jp ON jp.C_id=c.C_id
        INNER JOIN jobplacements as j ON jp.J_id=j.J_id
        INNER JOIN jobapplication as ja ON ja.J_id=j.J_id
        WHERE j.J_Due_date < CURRENT_DATE
        GROUP BY c.C_Name, j.J_Due_date LIMIT 5;";
    $fetchJob = $conn->prepare($fetchJobQuery);
    $fetchJob->execute();
    $result = $fetchJob->get_result();
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                        <td>' . $row["duedate"] . '</td>
                        <td>' . $row["cname"] . '</td>
                        <td>' . $row["totalplaced"] . '</td>
                        <td><a href="">View more</a></td>
                    </tr>';
    }
}

function getCompletedJobListingsAll()
{
    global $conn;
    $fetchJobQuery = "SELECT c.C_Name as cname, j.J_Due_date as duedate, SUM(ja.placed) as totalplaced
        FROM company as c 
        INNER JOIN jobposting as jp ON jp.C_id=c.C_id
        INNER JOIN jobplacements as j ON jp.J_id=j.J_id
        INNER JOIN jobapplication as ja ON ja.J_id=j.J_id
        WHERE j.J_Due_date < CURRENT_DATE
        GROUP BY c.C_Name, j.J_Due_date;";
    $fetchJob = $conn->prepare($fetchJobQuery);
    $fetchJob->execute();
    $result = $fetchJob->get_result();
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                        <td>' . $row["duedate"] . '</td>
                        <td>' . $row["cname"] . '</td>
                        <td>' . $row["totalplaced"] . '</td>
                        <td><a href="">View more</a></td>
                    </tr>';
    }
}


function getEligibleStudents()
{
    global $conn;
    $jid = (int) $_GET["jid"];
    $fetchJobEligibleQuery = "SELECT s.S_Year_of_Admission as yoa, s.S_College_Email as semail,s.S_Fname as sfname,s.S_Lname as lfname,d.Dept_name as dname,ja.J_id as jid,ja.Interest as interest FROM student as s
INNER JOIN jobapplication as ja ON s.S_College_Email=ja.S_College_Email
INNER JOIN class as c ON c.Class_id=s.S_Class_id
INNER JOIN department as d ON d.Dept_id=c.Dept_id
WHERE ja.J_id = ? LIMIT 5;";
    $fetchJobEligible = $conn->prepare($fetchJobEligibleQuery);
    $fetchJobEligible->bind_param("i", $jid);
    $fetchJobEligible->execute();
    $result = $fetchJobEligible->get_result();
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row["sfname"] . ' ' . $row["lfname"] . '</td>
                <td>' . $row["dname"] . '</td>
                <td>' . $row["yoa"]+4 . '</td>';
        if ($row['interest'] == 0) {
            echo  '<td>Not Applied</td>';
        } else {
            echo '<td>Applied</td>';
        }

        echo '<td><a href="job-eligible-students-details.php?jid=' . $jid . '&semail=' . $row["semail"] . '">View More</a></td>
                <td><button class="remove-button">Remove</button></td>
            </tr>';
    }
}


function getInterestedStudents()
{
    global $conn;
    $jid = (int) $_GET["jid"];
    $fetchJobEligibleQuery = "SELECT s.S_Year_of_Admission as yoa, s.S_College_Email as semail,ja.placed as placed,s.S_Fname as sfname,s.S_Lname as lfname,d.Dept_name as dname,ja.J_id as jid,ja.Interest as interest,jp.J_Due_date as duedate FROM student as s
INNER JOIN jobapplication as ja ON s.S_College_Email=ja.S_College_Email
INNER JOIN class as c ON c.Class_id=s.S_Class_id
INNER JOIN department as d ON d.Dept_id=c.Dept_id
INNER JOIN jobplacements as jp ON jp.J_id = ja.J_id
WHERE ja.J_id = ? AND ja.Interest = ? LIMIT 5;";
    $inte = 1;
    $fetchJobEligible = $conn->prepare($fetchJobEligibleQuery);
    $fetchJobEligible->bind_param("ii", $jid, $inte);
    $fetchJobEligible->execute();
    $result = $fetchJobEligible->get_result();
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row["sfname"] . ' ' . $row["lfname"] . '</td>
                <td>' . $row["dname"] . '</td>
                <td>' . $row["yoa"]+4 . '</td>';
        if ($row['placed'] == 0) {
            $retrieved_date = $row['duedate'];
            $date_from_db = new DateTime($retrieved_date);
            $current_date = new DateTime();
            if ($date_from_db > $current_date) {
                echo '<td>Pending</td>';
            } else {
                echo '<td>Rejected</td>';
            }
        } else {
            echo '<td>Placed</td>';
        }

        echo '<td><a href="job-interested-students-details.php?jid=' . $jid . '&semail=' . $row["semail"] . '">View More</a></td>
                <td><button class="remove-button">Remove</button></td>
            </tr>';
    }
}

function getEligibleStudentsAll()
{
    global $conn;
    $jid = (int) $_GET["jid"];
    $fetchJobEligibleQuery = "SELECT s.S_Year_of_Admission as yoa,s.S_College_Email as semail,s.S_Fname as sfname,s.S_Lname as lfname,d.Dept_name as dname,ja.J_id as jid,ja.Interest as interest FROM student as s
INNER JOIN jobapplication as ja ON s.S_College_Email=ja.S_College_Email
INNER JOIN class as c ON c.Class_id=s.S_Class_id
INNER JOIN department as d ON d.Dept_id=c.Dept_id
WHERE ja.J_id = ?;";
    $fetchJobEligible = $conn->prepare($fetchJobEligibleQuery);
    $fetchJobEligible->bind_param("i", $jid);
    $fetchJobEligible->execute();
    $result = $fetchJobEligible->get_result();
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row["sfname"] . ' ' . $row["lfname"] . '</td>
                <td>' . $row["dname"] . '</td>
                <td>' . $row["yoa"]+4 . '</td>';
        if ($row['interest'] == 0) {
            echo  '<td>Not Applied</td>';
        } else {
            echo '<td>Applied</td>';
        }

        echo '<td><a href="job-interested-students-details.php?jid=' . $jid . '&semail=' . $row["semail"] . '">View More</a></td>
                <td><button class="remove-button">Remove</button></td>
            </tr>';
    }
}


function getInterestedStudentsAll()
{
    global $conn;
    $jid = (int) $_GET["jid"];
    $fetchJobEligibleQuery = "SELECT s.S_Year_of_Admission as yoa, s.S_College_Email as semail,ja.placed as placed,s.S_Fname as sfname,s.S_Lname as lfname,d.Dept_name as dname,ja.J_id as jid,ja.Interest as interest,jp.J_Due_date as duedate FROM student as s
INNER JOIN jobapplication as ja ON s.S_College_Email=ja.S_College_Email
INNER JOIN class as c ON c.Class_id=s.S_Class_id
INNER JOIN department as d ON d.Dept_id=c.Dept_id
INNER JOIN jobplacements as jp ON jp.J_id = ja.J_id
WHERE ja.J_id = ? AND ja.Interest = ?;";
    $inte = 1;
    $fetchJobEligible = $conn->prepare($fetchJobEligibleQuery);
    $fetchJobEligible->bind_param("ii", $jid, $inte);
    $fetchJobEligible->execute();
    $result = $fetchJobEligible->get_result();
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row["sfname"] . ' ' . $row["lfname"] . '</td>
                <td>' . $row["dname"] . '</td>
                <td>' . $row["yoa"]+4 . '</td>';
        if ($row['placed'] == 0) {
            $retrieved_date = $row['duedate'];
            $date_from_db = new DateTime($retrieved_date);
            $current_date = new DateTime();
            if ($date_from_db > $current_date) {
                echo '<td>Pending</td>';
            } else {
                echo '<td>Rejected</td>';
            }
        } else {
            echo '<td>Placed</td>';
        }

        echo '<td><a href="job-interested-students-details.php?jid=' . $jid . '&semail=' . $row["semail"] . '">View More</a></td>
                <td><button class="remove-button">Remove</button></td>
            </tr>';
    }
}


function getEligibleStudentsDetails()
{
    global $conn;
    $jid = (int) $_GET['jid'];
    $semail = (string) $_GET['semail'];
    $fetchStudentQuery = 'SELECT s.S_Fname as fname, CONCAT_WS(" ",s.S_Fname,s.S_Mname,s.S_Lname) as name,s.S_Profile_pic as logo, s.S_Personal_Email as pemail,s.S_Phone_no as phno,s.S_Roll_no as rollno,c.Class_name as cname,d.Dept_name as dname,r.CGPA as cgpa FROM student AS s
        INNER JOIN class AS c ON c.Class_id = s.S_Class_id
        INNER JOIN department AS d ON c.Dept_id = d.Dept_id
        INNER JOIN result AS r ON s.S_College_Email = r.S_College_Email
        WHERE s.S_College_Email = ?';
    $fetchStudent = $conn->prepare($fetchStudentQuery);
    $fetchStudent->bind_param("s", $semail);
    $fetchStudent->execute();
    $result = $fetchStudent->get_result();
    $row = $result->fetch_assoc();

    echo '<div class="section-details">
                        <p><strong>Name: </strong>' . $row["name"] . '</p>
                        <p><strong>Department: </strong>' . $row["dname"] . '</p>
                        <p><strong>Class: </strong>' . $row["cname"] . '</p>
                        <p><strong>Contact Number: </strong>' . $row["phno"] . '</p>
                        <p><strong>College Email: </strong>' . $semail . '</p>
                        <p><strong>Personal Email: </strong>' . $row["pemail"] . '</p>
                        <p><strong>Roll No.: </strong>' . $row["rollno"] . '</p>
                        <p><strong>CGPA: </strong>' . $row["cgpa"] . '</p>
                    </div>
                    <div class="section-img">
                        <img src="../Data/Students/Profile_Images/' . $row["logo"] . '" alt="">
                        <div class="button-container">
                            <a href="./notification-post-solo.php?semail='.$semail.'&sname='.$row["fname"].'"><button class="send-message-button">Send Message</button></a>
                        </div>
                    </div>';
}


function getInterestedStudentsDetails()
{
    global $conn;
    $jid = (int) $_GET['jid'];
    $semail = (string) $_GET['semail'];
    $fetchStudentQuery = 'SELECT s.S_Fname as fname,CONCAT_WS(" ",s.S_Fname,s.S_Mname,s.S_Lname) as name,s.S_Profile_pic as logo, s.S_Personal_Email as pemail,s.S_Phone_no as phno,s.S_Roll_no as rollno,c.Class_name as cname,d.Dept_name as dname,r.CGPA as cgpa FROM student AS s
        INNER JOIN class AS c ON c.Class_id = s.S_Class_id
        INNER JOIN department AS d ON c.Dept_id = d.Dept_id
        INNER JOIN result AS r ON s.S_College_Email = r.S_College_Email
        WHERE s.S_College_Email = ?';
    $fetchStudent = $conn->prepare($fetchStudentQuery);
    $fetchStudent->bind_param("s", $semail);
    $fetchStudent->execute();
    $result1 = $fetchStudent->get_result();
    $row1 = $result1->fetch_assoc();

    $fetchRoundsQuery = 'SELECT r.Round_no roundno, sr.R_id rid, sr.RoundStatus roundstatus FROM rounds as r 
INNER JOIN studentrounds AS sr ON sr.R_id=r.R_id
WHERE r.J_id = ? AND sr.S_College_Email= ?;';

    $fetchRounds = $conn->prepare($fetchRoundsQuery);
    $fetchRounds->bind_param("is", $jid, $semail);
    $fetchRounds->execute();
    $result2 = $fetchRounds->get_result();

    echo '<div class="section-details">
                        <p><strong>Name: </strong>' . $row1["name"] . '</p>
                        <p><strong>Department: </strong>' . $row1["dname"] . '</p>
                        <p><strong>Class: </strong>' . $row1["cname"] . '</p>
                        <p><strong>Contact Number: </strong>' . $row1["phno"] . '</p>
                        <p><strong>College Email: </strong>' . $semail . '</p>
                        <p><strong>Personal Email: </strong>' . $row1["pemail"] . '</p>
                        <p><strong>Roll No.: </strong>' . $row1["rollno"] . '</p>
                        <p><strong>CGPA: </strong>' . $row1["cgpa"] . '</p>
                        <br/>
                        <form class="status-form" action="" method="post">
                        <div>';

    while ($row2 = $result2->fetch_assoc()) {
        echo '<p class="status-form-inputs">
                            <strong>Round ' . $row2["roundno"] . ': </strong>
                            <select name="round_status[' . $row2["rid"] . ']" id="" >
                                <option value="pending"' . ($row2["roundstatus"] == 'pending' ? ' selected' : '') . '>Pending</option>
                                <option value="passed"' . ($row2["roundstatus"] == 'passed' ? ' selected' : '') . '>Passed</option>
                                <option value="rejected"' . ($row2["roundstatus"] == 'rejected' ? ' selected' : '') . '>Rejected</option>
                            </select>
                        </p>';
    }

    echo ' </div>
                    <button class="update-round-status" name="update-round-status"> Update Status </button>
                    </form>    
                    </div>
                    <div class="section-img">
                        <img src="../Data/Students/Profile_Images/' . $row1["logo"] . '" alt="">
                        <div class="button-container">
                            <a href="./notification-post-solo.php?semail='.$semail.'&sname='.$row1["fname"].'"><button class="send-message-button">Send Message</button></a>
                        </div>
                    </div>';
}


function fetchStudents($isDeleted, $sname = null, $departments = [], $gender = null, $batch_year = null)
{
    global $conn;
    $table = $isDeleted ? 'deletedstudents' : 'student';
    $query = "SELECT s.S_College_Email as semail,S.S_Year_of_Admission as yoa, s.S_Fname as fname, s.S_Lname as lname, c.Class_name as cname, d.Dept_name as dname, r.CGPA as cgpa
              FROM $table as s
              INNER JOIN class as c ON c.Class_id = s.S_Class_id
              INNER JOIN department as d ON d.Dept_id = c.Dept_id 
              INNER JOIN result as r on r.S_College_Email = s.S_College_Email
              WHERE 1=1";

    $params = [];
    $types = "";

    if (!is_null($sname)) {
        $query .= " AND s.S_Fname LIKE ?";
        $params[] = "%$sname%";
        $types .= "s";
    }

    if (!is_null($gender)) {
        $query .= " AND s.gender = ?";
        $params[] = $gender;
        $types .= "s";
    }

    if (!is_null($batch_year)) {
        $year_of_admission = $batch_year - 4;
        $query .= " AND s.S_Year_of_Admission = ?";
        $params[] = $year_of_admission;
        $types .= "s";
    }

    if (!empty($departments)) {
        $placeholders = implode(',', array_fill(0, count($departments), '?'));
        $query .= " AND d.Dept_name IN ($placeholders)";
        $params = array_merge($params, $departments);
        $types .= str_repeat("s", count($departments));
    }

    $query .= " LIMIT 5"; // Adjust the LIMIT as needed

    $stmt = $conn->prepare($query);
    if ($params) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    return $stmt->get_result();
}

function fetchStudentsAll($isDeleted, $sname = null, $departments = [], $gender = null, $batch_year = null)
{
    global $conn;
    $table = $isDeleted ? 'deletedstudents' : 'student';
    $query = "SELECT s.S_College_Email as semail,S.S_Year_of_Admission as yoa, s.S_Fname as fname, s.S_Lname as lname, c.Class_name as cname, d.Dept_name as dname, r.CGPA as cgpa
              FROM $table as s
              INNER JOIN class as c ON c.Class_id = s.S_Class_id
              INNER JOIN department as d ON d.Dept_id = c.Dept_id 
              INNER JOIN result as r on r.S_College_Email = s.S_College_Email
              WHERE 1=1";

    $params = [];
    $types = "";

    if (!is_null($sname)) {
        $query .= " AND s.S_Fname LIKE ?";
        $params[] = "%$sname%";
        $types .= "s";
    }

    if (!is_null($gender)) {
        $query .= " AND s.gender = ?";
        $params[] = $gender;
        $types .= "s";
    }
    if (!is_null($batch_year)) {
        $year_of_admission = $batch_year - 4;
        $query .= " AND s.S_Year_of_Admission = ?";
        $params[] = $year_of_admission;
        $types .= "s";
    }

    if (!empty($departments)) {
        $placeholders = implode(',', array_fill(0, count($departments), '?'));
        $query .= " AND d.Dept_name IN ($placeholders)";
        $params = array_merge($params, $departments);
        $types .= str_repeat("s", count($departments));
    }

    $stmt = $conn->prepare($query);
    if ($params) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    return $stmt->get_result();
}


function getPlacementCoordinators()
{
    global $conn;
    $fetchPlacementCoordinatorsQuery = "SELECT p.PC_Email as pcemail,p.PC_Lname as lname,p.PC_Fname as fname,d.Dept_name as dname from placementcoordinator as p INNER JOIN department as d ON d.Dept_id = p.PC_Dept_id";
    $fetchPlacementCoordinators = $conn->prepare($fetchPlacementCoordinatorsQuery);
    $fetchPlacementCoordinators->execute();
    $result = $fetchPlacementCoordinators->get_result();

    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row["fname"] . ' ' . $row["lname"] . '</td>
                <td>' . $row["dname"] . '</td>
                <td><a href="./Placement-Coordinator-Details.php?pcemail=' . $row["pcemail"] . '">View more</a></td>
              </tr>';
    }
}
