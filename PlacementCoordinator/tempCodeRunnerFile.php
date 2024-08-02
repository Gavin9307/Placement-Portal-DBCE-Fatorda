<?php
                        $fetchNotiQuery = "SELECT Subject, Message, Attachment1, Attachment2, Notification_Due_Date 
                                           FROM notificationdetails
                                           WHERE Notification_ID = ?";
                        $fetchNoti = $conn->prepare($fetchNotiQuery);
                        $fetchNoti->bind_param("i", $nid);
                        $fetchNoti->execute();
                        $result = $fetchNoti->get_result();
                        $row = $result->fetch_assoc();
                        ?>