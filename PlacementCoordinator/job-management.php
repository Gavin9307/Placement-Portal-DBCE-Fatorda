<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/job-management.css">
    <title>Job Management</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Job Listings</h2>
                    <a href="./notification-post.php"><button class="add-button">Post a Job</button></a>    
                </div>
                <h3>Live Listings</h3>
                <div class="sections">
                    <div class="company-container">
                        <div class="company-logo-container">
                            <img src="../Assets/profile.jpg" alt="">
                            <p>Google</p>
                        </div>
                        <p><strong>Date:</strong> 12/12/2003</p>
                    </div>
                    <p class="position"><strong>Postion</strong>: Associate Developer</p>
                    <p class= "department"><strong>Departments</strong>: Computer</p>
                    <a href=""><button class="analysis-button">Analysis</button></a>
                    <a href=""><button class="edit-button">Edit Details</button></a>
                </div>
                <div class="sections">
                    <div class="company-container">
                        <div class="company-logo-container">
                            <img src="../Assets/profile.jpg" alt="">
                            <p>IBM</p>
                        </div>
                        <p><strong>Date:</strong> 12/12/2003</p>
                    </div>
                    <p class="position"><strong>Postion</strong>: Software Developer</p>
                    <p class= "department"><strong>Departments</strong>: Computer</p>
                    <a href=""><button class="analysis-button">Analysis</button></a>
                    <a href=""><button class="edit-button">Edit Details</button></a>
                </div>
                <h3>Completed Listings</h3>
                <div class="sections">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Company</th>
                        <th>Students Placed</th>
                        <th>Details</th>
                    </tr>
                    <tr>
                        <td>12/12/23</td>
                        <td>Google</td>
                        <td>2</td>
                        <td><a href="">View more</a></td>
                    </tr>
                    <tr>
                        <td>24/12/23</td>
                        <td>IBM</td>
                        <td>9</td>
                        <td><a href="">View more</a></td>
                    </tr>
                    <tr>
                        <td>24/12/23</td>
                        <td>IBM</td>
                        <td>9</td>
                        <td><a href="">View more</a></td>
                    </tr>
                    <tr>
                        <td>24/12/23</td>
                        <td>IBM</td>
                        <td>9</td>
                        <td><a href="">View more</a></td>
                    </tr>
                </table>
                <div class="button-container">
                <a href="./notification-post.php"><button class="viewmore-button">View More</button></a>
                </div>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>