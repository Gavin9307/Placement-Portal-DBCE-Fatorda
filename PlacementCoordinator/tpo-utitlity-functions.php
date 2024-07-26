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
                    <a href="./notifications-edit?nid=' . $row["nid"] . '"><button class="edit-button">Edit</button></a>
                    <form action="" method="post">
                        <input type="number" value="'.$row["nid"].'" hidden name="nid">
                        <button name="delete_noti" class="delete-button">Delete</button>
                    </form>
                </div>';
    }
}
