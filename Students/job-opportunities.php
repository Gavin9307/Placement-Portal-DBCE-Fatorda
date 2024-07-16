<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/job-opportunities.css">
    <title>Job Opportunities</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Job Opportunities</h2>

                <div class="sections">
                    <div class="company-container">
                        <div class="company-logo-container">
                            <img src="../Assets/profile.jpg" alt="">
                            <p>Google</p>
                        </div>
                        <p><strong>Due Date:</strong> 12/12/2003</p>
                    </div>
                    <p class="position"><strong>Position:</strong> Associate Developer</p>
                    <a href="./my-applications-details.html"><button>View More</button></a>
                </div>

                <div class="sections">
                    <div class="company-container">
                        <div class="company-logo-container">
                            <img src="../Assets/profile.jpg" alt="">
                            <p>Google</p>
                        </div>
                        <p><strong>Apply Date:</strong> 12/12/2003</p>
                    </div>
                    <p class="position"><strong>Position:</strong> Associate Developer</p>
                    <a href="./my-applications-details.html"><button>View More</button></a>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>