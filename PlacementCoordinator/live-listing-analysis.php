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
    <link rel="stylesheet" href="./css/live-listing-analysis.css">
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
                    <div class="company-container">
                        <p>Google</p>
                    </div>
                
                </div>
    
                <h3>Eligible Students</h3>
                
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
                        <td>Not Interested</td>
                        <td><a href="">View More</a></td>
                        <td><button class="remove-button">Remove</button></td>
                    </tr>
                    <tr>
                        <td>Warren</td>
                        <td>COMP</td>
                        <td>Interested</td>
                        <td><a href="">View More</a></td>
                        <td><button class="remove-button">Remove</button></td>
                    </tr>
                    <tr>
                        <td>Nimish</td>
                        <td>MECH</td>
                        <td>Not Interested</td>
                        <td><a href="">View More</a></td>
                        <td><button class="remove-button">Remove</button></td>
                    </tr>
                </table>
                <div class="button-container">
                <a href="#"><button class="viewmore-button">View More</button></a>
                </div>
                </div>
                

                <h3>Interested Students</h3>
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
                        <td>Bliss</td>
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
                    <tr>
                        <td>Bliss</td>
                        <td>MECH</td>
                        <td>Pending</td>
                        <td><a href="">View More</a></td>
                        <td><button class="remove-button">Remove</button></td>
                    </tr>
                </table>
                <div class="button-container">
                <a href="#"><button class="viewmore-button">View More</button></a>
                </div>
                </div>
                <button class="getreport-button">Get Report</button>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>