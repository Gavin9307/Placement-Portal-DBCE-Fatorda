<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>

    <link rel="stylesheet" href="./css/dashboard.css">
    <title>Dashboard</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading">Dashboard</h2>
                <div class="sections">
                    <h3>Student Management</h3>
                    <div class="sub-sections performance">
                        <div class="right1"><i class=" fa-solid fa-chevron-right fa-2x" style="color: #000000;"></i>
                        </div>
                        <p>Total Applications : 5</p>
                        <p>Interviews Attended : 3</p>
                        <p>Rejections : 3</p>
                    </div>
                </div>

                <div class="sections">
                    <h3>Company Management</h3>
                    <div class="sub-sections companies">
                        <div class="right1"><a href="./my-applications.php"><i class=" fa-solid fa-chevron-right fa-2x" style="color: #000000;"></i></a>
                        </div>
                        <div class="sub-table">
                            <div class="sub-table-row">
                                <img src="../Assets/dbce-logo.jpeg" alt="">
                                <p>Associate Developer</p>
                            </div>
                            <hr>
                            <div class="sub-table-row">
                                <img src="../Assets/dbce-logo.jpeg" alt="">
                                <p>Software Analyst</p>
                            </div>
                            <hr>
                            <div class="sub-table-row">
                                <img src="../Assets/dbce-logo.jpeg" alt="">
                                <p>UI/UX Designer</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sections">
                    <h3>Job Management</h3>
                    <div class="sub-sections performance">
                        <div class="right1"><i class=" fa-solid fa-chevron-right fa-2x" style="color: #000000;"></i>
                        </div>
                        <p>Live Opportunities : 2</p>
                        <p>Students Applied : 15</p>
                    </div>
                </div>
                <div class="sections">
                    <h3>Placement Coordinators</h3>
                    <div class="sub-sections performance">
                        <div class="right1"><i class=" fa-solid fa-chevron-right fa-2x" style="color: #000000;"></i>
                        </div>
                        <p>Total Coordinators : 4</p>
                    </div>
                </div>
            </div>


        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>