<?php
    require "../conn.php";
    require "../restrict.php";
    include "./tpo-utility-functions.php";
    global $conn;
    if (!isset($_SESSION)) {
        session_start();
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/interested-students.css">
    <title>Live Listing Analysis</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Details</h2> 
                </div>
                <div class="interested-company">
                    <h3>Interested Students</h3>
                    <div class="company-container">
                        <p>Google</p>
                    </div>
                </div>
                <div class="sections">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Details</th>
                        <th>Remove</th>
                    </tr>
                    <tr>
                        <td>Nimish</td>
                        <td>MECH</td>
                        <td>Pending</td>
                        <td><a href="">View More</a></td>
                        <td><button class="remove-button">Remove</button></td>
                    </tr>
                    <tr>
                        <td>Warren</td>
                        <td>COMP</td>
                        <td>Placed</td>
                        <td><a href="">View More</a></td>
                        <td><button class="remove-button">Remove</button></td>
                    </tr>
                    
                </table>
                <div class="button-container">
                <a href="#"><button class="send-message-button">Send Message</button></a>
                </div>
                </div>
                
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>