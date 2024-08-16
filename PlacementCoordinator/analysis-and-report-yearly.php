<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST["submit"])) {
    // Initialize variables
    $fromDate = $_GET['from_date'] ?? null;
    $toDate = $_GET['to_date'] ?? null;
    $departments = $_GET['departments'] ?? [];

    // Construct SQL query
    $sql = "SELECT 
    ROW_NUMBER() OVER (ORDER BY s.S_Fname, s.S_Lname) AS 'Sr. No',
    c.C_Name AS 'Company Name', 
    jp.Job_Post_Date AS 'interview_date',
    COALESCE(s.PLACED, 0) AS PLACED,
    CASE 
        WHEN d.Dept_name = 'COMP' THEN COALESCE(s.PLACED, 0)
        ELSE 0
    END AS no_of_students_in_comp,
    CASE 
        WHEN d.Dept_name = 'ECS' THEN COALESCE(s.PLACED, 0)
        ELSE 0
    END AS no_of_students_in_ecs,
    CASE 
        WHEN d.Dept_name = 'CIVIL' THEN COALESCE(s.PLACED, 0)
        ELSE 0
    END AS no_of_students_in_civil,
    CASE 
        WHEN d.Dept_name = 'MECH' THEN COALESCE(s.PLACED, 0)
        ELSE 0
    END AS no_of_students_in_mech,
    COALESCE(
        CASE WHEN d.Dept_name = 'COMP' THEN s.PLACED ELSE NULL END, 0
    ) + COALESCE(
        CASE WHEN d.Dept_name = 'ECS' THEN s.PLACED ELSE NULL END, 0
    ) + COALESCE(
        CASE WHEN d.Dept_name = 'CIVIL' THEN s.PLACED ELSE NULL END, 0
    ) + COALESCE(
        CASE WHEN d.Dept_name = 'MECH' THEN s.PLACED ELSE NULL END, 0
    ) AS total,
    COALESCE(jb.J_Offered_salary, 0) AS offered_salary
    
FROM 
    student s
INNER JOIN 
    jobapplication j ON j.S_College_Email = s.S_College_Email
INNER JOIN 
    jobposting jp ON jp.J_id = j.J_id
INNER JOIN 
    company c ON c.C_id = jp.C_id
INNER JOIN 
    jobplacements jb ON jb.J_id = j.J_id
INNER JOIN 
    class cl ON cl.Class_id = s.S_Class_id
INNER JOIN 
    department d ON d.Dept_id = cl.Dept_id
WHERE 
    1=1";

    if ($fromDate && $toDate) {
        $sql .= " AND jp.Job_Post_Date BETWEEN '$fromDate' AND '$toDate'";
    }

    if (!empty($departments)) {
        $departmentList = implode("','", $departments);
        $sql .= " AND d.Dept_name IN ('$departmentList')";
    }

    header("Location: ./GoogleSheetsReports/StudentsReport.php?sql=" . urlencode($sql));
}
?>

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
                <h2 class="main-container-heading"><a href="./analysis-and-report.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Analysis and Reports</h2>
                <h3>Yearly Placement Drive Reports</h3>
                <div class="sections">
                    <div class="form-adjust">
                        <form action="" method="post">
                            <div class="datebox">
                                <div>
                                    <label for="from_date"><strong>From:</strong></label>
                                    <input type="date" name="from_date" id="from_date">
                                </div>
                                <div>
                                    <label for="to_date"><strong>To:</strong></label>
                                    <input type="date" name="to_date" id="to_date">
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

                            <div class="departmentbox">
                                <label><strong>Department</strong></label>
                                <div class="Checkbox">
                                    <div>
                                        <input type="checkbox" name="departments[]" value="ECS" id="ecs">
                                        <label for="ecs">ECS</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="departments[]" value="COMP" id="comp">
                                        <label for="comp">COMP</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="departments[]" value="MECH" id="mech">
                                        <label for="mech">MECH</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="departments[]" value="CIVIL" id="civil">
                                        <label for="civil">CIVIL</label>
                                    </div>
                                </div>
                            </div>

                            <div class="getreportbutton">
                                <button class="add-button" name="submit" type="submit">Get Report</button>
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

                <div class="sortby-container">
                    <h3><strong>Student Details</strong></h3>
                    <div>
                        <label for=""><strong>Sort-By</strong></label>
                        <select name="" id="">
                            <option value="">Date: Latest to Oldest</option>
                            <option value="">Date: Oldest to Latest</option>
                            <option value="">Department</option>
                            <option value="">Offered Salary: High to Low</option>
                            <option value="">Offered Salary: Low to High</option>
                        </select>
                    </div>
                </div>
                <div class="sections">

                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Company</th>
                            <th>Offered Salary</th>
                            <th>Joining Date</th>
                            <th>Details</th>
                        </tr>
                        <tr>
                            <td>Nimish</td>
                            <td>Comp</td>
                            <td>Google</td>
                            <td>30,000</td>
                            <td>2/3/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                        <tr>
                            <td>Patric</td>
                            <td>Comp</td>
                            <td>Facebook</td>
                            <td>20,000</td>
                            <td>30/3/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                        <tr>
                            <td>Gavin</td>
                            <td>Comp</td>
                            <td>Google</td>
                            <td>50,000</td>
                            <td>12/11/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                        <tr>
                            <td>Stephen</td>
                            <td>Civil</td>
                            <td>Reliance</td>
                            <td>40,000</td>
                            <td>24/5/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                    </table>
                    <div class="button-container-1">
                        <div class="dropdown">
                            <button class="download-button">Download</button>
                            <div class="dropdown-content">
                                <a href="https://docs.google.com/spreadsheets/d/1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0/export?format=csv&id=1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0">Download as CSV</a>
                                <a href="https://docs.google.com/spreadsheets/d/1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0/export?format=pdf&id=1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0">Download as PDF</a>
                                <a href="https://docs.google.com/spreadsheets/d/1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0/export?format=xlsx&id=1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0">Download as Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
                <h3>Other Reports:</h3>
                <div class="button-container-2">
                    <a href="./analysis-and-report-company-report.php"><button class="add-button">Company Report</button></a>
                    <a href="./notification-post.php"><button class="add-button">Student Report</button></a>
                    <a href="./notification-post.php"><button class="add-button">Alumini Report</button></a>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>