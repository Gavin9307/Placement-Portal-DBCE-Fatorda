<?php

function getTpoNotifications()
{
    global $conn;

    $fetchNotificationsQuery = "SELECT ND.Notification_ID as nid, ND.Message AS message, ND.Subject AS subject, ND.Attachment1 AS attach1, ND.Attachment2 AS attach2, ND.Notification_Date AS notidate, ND.Notification_Due_Date as duedate
FROM notificationdetails AS ND
INNER JOIN studentnotifications AS SN ON ND.Notification_ID = SN.Notification_ID
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
                        <input type="number" value="'.$row["nid"].'" hidden name="nid">
                        <button name="delete_noti" class="delete-button">Delete</button>
                    </form>
                </div>';
    }
}


function getLiveJobListings() {
    global $conn;
    $fetchJobQuery = "
        SELECT C.C_Name as cname, C.C_Logo clogo, P.J_Due_date duedate, P.J_Position position, J.J_id jid 
        FROM company as C
        INNER JOIN jobposting as J ON J.C_id = C.C_id
        INNER JOIN jobplacements as P ON P.J_id = J.J_id
        WHERE P.J_Due_date >= CURRENT_DATE;
    ";

    $fetchJob = $conn->prepare($fetchJobQuery);
    $fetchJob->execute();
    $result = $fetchJob->get_result();

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
                <a href=""><button class="analysis-button">Analysis</button></a>
                <a href=""><button class="edit-button">Edit Details</button></a>
            </div>';
    }
}


function getCompletedJobListings() {
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
                        <td>'.$row["duedate"].'</td>
                        <td>'.$row["cname"].'</td>
                        <td>'.$row["totalplaced"].'</td>
                        <td><a href="">View more</a></td>
                    </tr>';
    }
}
