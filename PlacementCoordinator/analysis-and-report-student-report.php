<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/analysis-and-report-student-report.css">
    <title>Analysis and Reports Students</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./analysis-and-report.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Analysis and Reports</h2>
                <h3>Student Report</h3>

                <div class="sections">
                    <div class="form-adjust">
                        <form action="">
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
                        <div class="batch-container">

                            <label for=""><strong>Batch:</strong></label>
                            <select name="" id="">
                                <option value="">2025</option>
                                <option value="">2024</option>
                                <option value="">2023</option>
                                <option value="">2022</option>
                                <option value="">2021</option>
                            </select>
                        
                        </div>
                        <div class="batch-container">
                        <label for=""><strong>Class:</strong></label>
                            <select name="" id="">
                                <option value="">TE COMP</option>
                                <option value="">TE CIVIL</option>
                                <option value="">TE ECS</option>
                                <option value="">TE MECH</option>
                                <option value="">BE COMP</option>
                            </select>
                        </div>
                        <div class="batch-container">
                        <label for=""><strong>Gender:</strong></label>
                            <select name="" id="">
                                <option value="" disabled selected>select</option>
                                <option value="">Male</option>
                                <option value="">Female</option>
                                <option value="">Other</option>
                                
                            </select>
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


                    </form>
                </div>
                </div>

                <div class="sections-1">
                    <div class="section-1-content">
                        <p><strong>Total students enrolled for placement:</strong>100</p><br>
                        <p><strong>Total Students Placed:</strong> 8</p>
                        <p><strong>Average Placement:</strong> 18</p>
                    </div>

                    <div>
                        <iframe class="responsive-iframe" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQwj2XQEskPgLtqr0YpmTsA4eb36sbaUt16rtthRpDURHxbVRPVZVkr-icApfmjR0Lv0WiMdjeGzFEV/pubchart?oid=1931950964&amp;format=interactive"></iframe>
                    </div>
                </div>

                <div class="sections">
                    <p><strong>Students Recruited Per Year:</strong> 20</p><br>
                    <iframe class="responsive-iframe" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQwj2XQEskPgLtqr0YpmTsA4eb36sbaUt16rtthRpDURHxbVRPVZVkr-icApfmjR0Lv0WiMdjeGzFEV/pubchart?oid=1931950964&amp;format=interactive"></iframe>
                </div>

                <div class="sections">
                    <p><strong>Average Package:</strong></p><br>
                    <iframe class="responsive-iframe" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQwj2XQEskPgLtqr0YpmTsA4eb36sbaUt16rtthRpDURHxbVRPVZVkr-icApfmjR0Lv0WiMdjeGzFEV/pubchart?oid=1931950964&amp;format=interactive"></iframe>
                    <p><strong>Highest Package:</strong> 12 lpa</p>
                    <p><strong>Lowest Package:</strong> 4 lpa</p>
                </div>



                <h3>Other Reports:</h3>
                <div class="button-container-2">
                    <a href="./analysis-and-report-company-report.php"><button class="add-button">Company Report</button></a>
                    <a href="./analysis-and-report-student-report.php"><button class="add-button">Student Report</button></a>
                    <a href="./alumni-report.php"><button class="add-button">Alumini Report</button></a>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>