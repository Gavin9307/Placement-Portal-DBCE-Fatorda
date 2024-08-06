<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/analysis-and-report.css">
    <title>Analysis and Reports</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Analysis and Reports</h2>
                <h3>Live Placement Drive Reports</h3>
                <div class="sections">
                    <div class="company-container">
                        <div class="company-logo-container">
                            <img src="../Assets/profile.jpg" alt="">
                            <p>Google</p>
                        </div>
                        <p><strong>Due Date:</strong> 12/12/2003</p>
                    </div>
                    <p class="position"><strong>Position:</strong> Associate Developer</p>
                    <p class="department"><strong>Departments</strong>: Computer</p>
                    <a href="./job-live-listing-analysis.php"><button>View Report</button></a>
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
                    <p class="department"><strong>Departments</strong>: Computer</p>
                    <a href="./my-applications-details.html"><button>View Report</button></a>
                </div>
                <h3>Yearly Placement Drive Reports</h3>
                <div class="sections">
                <div class="form-adjust">
                    <div class="datebox">
                        <div>
                            <label for=""><strong>From:</strong></label>
                            <input type="date">
                        </div>
                        <div>
                            <label for=""><strong>To:</strong></label>
                            <input type="date">
                        </div>
                    </div>

                    <div class="departmentbox">
                        <label for=""><strong>Department</strong></label>
                        <div class="Checkbox">
                            <div>
                                <input type="checkbox">
                                <label for="">ECS</label>
                            </div>

                            <div><input type="checkbox">
                                <label for="">COMP</label>
                            </div>
                            <div><input type="checkbox">
                                <label for="">MECH</label>
                            </div>
                            <div><input type="checkbox">
                                <label for="">CIVIL</label>
                            </div>


                        </div>
                    </div>
                    <a href="./analysis-and-report-yearly.php"><button class="add-button">Get Report</button></a>
                </div>
                </div>
                <h3>Other Reports:</h3>
                <div class="button-container-2">
                    <a href="./analysis-and-report-company-report.php"><button class="add-button">Company Report</button></a>
                    <a href="./analysis-and-report-student-report.php"><button class="add-button">Student Report</button></a>
                    <a href="./alumni-report.php"><button class="add-button">Alumini Report</button></a>
                </div>
            </div>
        </div>
    </div>

    <?php include './footer.php' ?>
    </div>

</body>

</html>