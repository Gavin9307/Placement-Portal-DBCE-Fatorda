<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/analysis-and-report-company-report.css">
    <title>Analysis and Reports Company</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Analysis and Reports</h2>
                <h3>Company Report</h3>
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

                            <div class="inputbox">
                                <div>
                                    <label for=""><strong>Company</strong></label>
                                    <input type="text" placeholder="Company">
                                </div>
                            </div>
                            <div class="getreportbutton">
                                <a href=" "><button class="add-button">Get Report</button></a>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="sections-1">
                    <div class="section-1-content">
                    <div class="img-conatiner">
                        <img src="" alt=""><a href="">Google</a>
                    </div>
                    <p><strong>Students Recruited</strong>: 100</p>
                    <p><strong>Average recruitment</strong>: 20</p>
                    </div>

                    <div>
                    <iframe class="responsive-iframe" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQwj2XQEskPgLtqr0YpmTsA4eb36sbaUt16rtthRpDURHxbVRPVZVkr-icApfmjR0Lv0WiMdjeGzFEV/pubchart?oid=1931950964&amp;format=interactive"></iframe>
                    </div>
                </div>
                <div class="sections-1">
                    <div class="section-1-content">
                    <p><strong>Students Recruited Per Department</strong></p><br>
                    <p><strong>ECS</strong>: 8</p>
                    <p><strong>COMP</strong>: 18</p>
                    <p><strong>MECH</strong>: 0</p>
                    <p><strong>CIVIL</strong>: 0</p>
                    </div>

                    <div>
                    <iframe class="responsive-iframe" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQwj2XQEskPgLtqr0YpmTsA4eb36sbaUt16rtthRpDURHxbVRPVZVkr-icApfmjR0Lv0WiMdjeGzFEV/pubchart?oid=1931950964&amp;format=interactive"></iframe>
                    </div>
                </div>

                <div class="sections">
                    <p><strong>Students Recruited Per Year</strong>: 20</p><br>
                    <iframe class="responsive-iframe" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQwj2XQEskPgLtqr0YpmTsA4eb36sbaUt16rtthRpDURHxbVRPVZVkr-icApfmjR0Lv0WiMdjeGzFEV/pubchart?oid=1931950964&amp;format=interactive"></iframe>
                </div>
                
                <div class="sections">
                    <p><strong>Package Offered Per Year</strong></p><br>
                    <iframe class="responsive-iframe" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQwj2XQEskPgLtqr0YpmTsA4eb36sbaUt16rtthRpDURHxbVRPVZVkr-icApfmjR0Lv0WiMdjeGzFEV/pubchart?oid=1931950964&amp;format=interactive"></iframe>
                    <p><strong>Highest Offered Salary</strong>: 12 lpa</p>
                    <p><strong>Lowest Offered Salary</strong>: 4 lpa</p>
                    <p><strong>Average Offered Salary</strong>: 8 lpa</p>
                </div>



                <h3>Other Reports:</h3>
                <div class="button-container-2">
                    <a href="./notification-post.php"><button class="add-button">Company Report</button></a>
                    <a href="./notification-post.php"><button class="add-button">Student Report</button></a>
                    <a href="./notification-post.php"><button class="add-button">Alumini Report</button></a>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>