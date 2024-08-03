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
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
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

                            <div class="inputbox">
                                    <div>
                                    <label for=""><strong>Department:</strong></label>
                                    <select name="" id="">
                                        <option value="">MECH</option>
                                        <option value="">COMP</option>
                                        <option value="">ETC</option>
                                        <option value="">CIVIL</option>
                                    </select>
                                    </div>
                                    <div>
                                    <label for=""><strong>Class:</strong></label>
                                    <select name="" id="">
                                        <option value="">FE</option>
                                        <option value="">SE</option>
                                        <option value="">TE</option>
                                        <option value="">BE</option>
                                    </select>
                                    </div>
                                    <div>
                                    <label for=""><strong>Gender:</strong></label>
                                    <select name="" id="">
                                        <option value="">Male</option>
                                        <option value="">Female</option>
                                    </select>
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
                    <p><strong>Total students enrolled for placement:</strong> 100</p><br>
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