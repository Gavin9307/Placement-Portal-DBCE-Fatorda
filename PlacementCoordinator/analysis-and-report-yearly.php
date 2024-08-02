<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/analysis-and-report-yearly.css">
    <title>Analysis and Reports</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Analysis and Reports</h2>
                <h3>Yearly Placement Drive Reports</h3>
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
                            <div class="getreportbutton">
                                <a href=" "><button class="add-button">Get Report</button></a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="sections section-container">

                    <div class="sections-1">
                        <p><strong>Total Number of students</strong>: 100</p>
                        <p><strong>Total Number of students Placed</strong>: 20</p>
                        <iframe class="responsive-iframe" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQwj2XQEskPgLtqr0YpmTsA4eb36sbaUt16rtthRpDURHxbVRPVZVkr-icApfmjR0Lv0WiMdjeGzFEV/pubchart?oid=1931950964&amp;format=interactive"></iframe>
                    </div>
                    <div class="sections-1">
                        <p><strong>Total Number of Companies</strong>: 20</p>
                        <p><strong>Companies That hired</strong>: 8</p>
                        <iframe class="responsive-iframe" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQwj2XQEskPgLtqr0YpmTsA4eb36sbaUt16rtthRpDURHxbVRPVZVkr-icApfmjR0Lv0WiMdjeGzFEV/pubchart?oid=1931950964&amp;format=interactive"></iframe>
                    </div>


                </div>
                <h3><strong>Student Details</strong></h3>

                <div class="sections">
                    
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Offered Salary</th>
                            <th>Joining Date</th>
                            <th>Details</th>
                        </tr>
                        <tr>
                            <td>Nimish</td>
                            <td>Google</td>
                            <td>30,000</td>
                            <td>2/3/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                        <tr>
                            <td>Patric</td>
                            <td>Facebook</td>
                            <td>20,000</td>
                            <td>30/3/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                        <tr>
                            <td>Gavin</td>
                            <td>Google</td>
                            <td>50,000</td>
                            <td>12/11/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                        <tr>
                            <td>Stephen</td>
                            <td>Reliance</td>
                            <td>40,000</td>
                            <td>24/5/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                    </table>
                    <div class="button-container-1">
                        <div class="dropdown">
                            <button class="viewmore-button">View More</button>
                            <div class="dropdown-content">
                                <a href="./notification-post.php">Option 1</a>
                                <a href="./another-link.php">Option 2</a>
                                <a href="./yet-another-link.php">Option 3</a>
                            </div>
                        </div>
                    </div>
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