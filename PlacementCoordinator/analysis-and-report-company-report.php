<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
include "./report-utility.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST["submit"]))
{
    $queries = [
        "SELECT 
            COUNT(CASE WHEN d.Dept_name = 'CIVIL' THEN 1 END) as CIVIL,
            COUNT(CASE WHEN d.Dept_name = 'MECH' THEN 1 END) as MECH,
            COUNT(CASE WHEN d.Dept_name = 'ETC' THEN 1 END) as ETC,
            COUNT(CASE WHEN d.Dept_name = 'COMP' THEN 1 END) as COMP
        FROM 
            student as s 
        INNER JOIN 
            jobapplication as ja ON ja.S_College_Email = s.S_College_Email
        INNER JOIN 
            class as c ON c.Class_id = s.S_Class_id
        INNER JOIN 
            department as d ON c.Dept_id = d.Dept_id
        WHERE
        s.S_Year_of_Admission = '2021' AND ja.J_id = 1;",
        
        "SELECT 
            COUNT(CASE WHEN d.Dept_name = 'CIVIL' THEN 1 END) as CIVIL,
            COUNT(CASE WHEN d.Dept_name = 'MECH' THEN 1 END) as MECH,
            COUNT(CASE WHEN d.Dept_name = 'ETC' THEN 1 END) as ETC,
            COUNT(CASE WHEN d.Dept_name = 'COMP' THEN 1 END) as COMP
        FROM 
            student as s 
        INNER JOIN 
            jobapplication as ja ON ja.S_College_Email = s.S_College_Email
        INNER JOIN 
            class as c ON c.Class_id = s.S_Class_id
        INNER JOIN 
            department as d ON c.Dept_id = d.Dept_id
        WHERE
        s.S_Year_of_Admission = '2021' AND ja.J_id = 1 AND ja.Interest = 1;",
        
        "SELECT 
            COUNT(CASE WHEN d.Dept_name = 'CIVIL' THEN 1 END) as CIVIL,
            COUNT(CASE WHEN d.Dept_name = 'MECH' THEN 1 END) as MECH,
            COUNT(CASE WHEN d.Dept_name = 'ETC' THEN 1 END) as ETC,
            COUNT(CASE WHEN d.Dept_name = 'COMP' THEN 1 END) as COMP
        FROM 
            student as s 
        INNER JOIN 
            jobapplication as ja ON ja.S_College_Email = s.S_College_Email
        INNER JOIN 
            class as c ON c.Class_id = s.S_Class_id
        INNER JOIN 
            department as d ON c.Dept_id = d.Dept_id
        WHERE
        s.S_Year_of_Admission = '2021' AND ja.J_id = 1 AND ja.Interest = 0;",
        
        "SELECT 
            COUNT(CASE WHEN d.Dept_name = 'CIVIL' THEN 1 END) as CIVIL,
            COUNT(CASE WHEN d.Dept_name = 'MECH' THEN 1 END) as MECH,
            COUNT(CASE WHEN d.Dept_name = 'ETC' THEN 1 END) as ETC,
            COUNT(CASE WHEN d.Dept_name = 'COMP' THEN 1 END) as COMP
        FROM 
            student as s 
        INNER JOIN 
            jobapplication as ja ON ja.S_College_Email = s.S_College_Email
        INNER JOIN 
            class as c ON c.Class_id = s.S_Class_id
        INNER JOIN 
            department as d ON c.Dept_id = d.Dept_id
        WHERE
        s.S_Year_of_Admission = '2021' AND ja.J_id = 0;",
        "WITH AggregatedPlacements AS (
        SELECT
            c.C_Name AS company_name,
            c.C_Location AS location,
            jp.Job_Post_Date AS interview_date,
            d.Dept_Name AS dept_name,
            COUNT(DISTINCT ja.S_College_Email) AS students_count,
            jo.J_Offered_salary AS offered_salary
        FROM
            company AS c
        INNER JOIN
            jobposting AS jp ON jp.C_id = c.C_id
        INNER JOIN
            jobplacements AS jo ON jo.J_id = jp.J_id
        INNER JOIN
            jobdepartments AS jd ON jd.J_id = jp.J_id
        INNER JOIN
            jobapplication AS ja ON ja.J_id = jp.J_id
        INNER JOIN
            student AS s ON s.S_College_Email = ja.S_College_Email
        INNER JOIN
            class AS cl ON cl.Class_id = s.S_Class_id
        INNER JOIN
            department AS d ON cl.Dept_id = d.Dept_id
        WHERE ja.placed = 1 AND jp.Job_Post_Date BETWEEN '2024-01-01' AND '2024-12-31'
        GROUP BY
            c.C_Name, c.C_Location, jp.Job_Post_Date, jo.J_Offered_salary, d.Dept_Name
    )
    
    , DepartmentList AS (
        SELECT DISTINCT Dept_Name
        FROM department
    )
    
    , JobPostings AS (
        SELECT DISTINCT
            jp.J_id AS job_id,
            c.C_Name AS company_name,
            c.C_Location AS location,
            jp.Job_Post_Date AS interview_date,
            jo.J_Offered_salary AS offered_salary
        FROM
            jobposting AS jp
        LEFT JOIN
            company AS c ON c.C_id = jp.C_id
        LEFT JOIN
            jobplacements AS jo ON jo.J_id = jp.J_id
    )
    
    , JobDepartmentCross AS (
        SELECT
            jp.company_name,
            jp.location,
            jp.interview_date,
            jp.offered_salary,
            d.Dept_Name AS dept_name
        FROM
            JobPostings jp
        CROSS JOIN
            DepartmentList d
    )
    
    , DepartmentAggregates AS (
        SELECT
            j.company_name,
            j.location,
            j.interview_date,
            j.offered_salary,
            COALESCE(SUM(CASE WHEN j.dept_name = 'CIVIL' THEN ap.students_count ELSE 0 END), 0) AS CIVIL,
            COALESCE(SUM(CASE WHEN j.dept_name = 'MECH' THEN ap.students_count ELSE 0 END), 0) AS MECH,
            COALESCE(SUM(CASE WHEN j.dept_name = 'ETC' THEN ap.students_count ELSE 0 END), 0) AS ETC,
            COALESCE(SUM(CASE WHEN j.dept_name = 'COMP' THEN ap.students_count ELSE 0 END), 0) AS COMP,
            COALESCE(SUM(ap.students_count), 0) AS Total
        FROM
            JobDepartmentCross j
        LEFT JOIN
            AggregatedPlacements ap ON j.company_name = ap.company_name
                                  AND j.interview_date = ap.interview_date
                                  AND j.dept_name = ap.dept_name
        GROUP BY
            j.company_name, j.location, j.interview_date, j.offered_salary
    )
    
    SELECT
        ROW_NUMBER() OVER (ORDER BY da.company_name, da.interview_date) AS Sr_No,
        da.company_name AS 'Company Name',
        da.location AS 'Location',
        da.interview_date AS 'Interview Date',
        COALESCE(da.CIVIL, 0) AS CIVIL,
        COALESCE(da.MECH, 0) AS MECH,
        COALESCE(da.ETC, 0) AS ETC,
        COALESCE(da.COMP, 0) AS COMP,
        COALESCE(da.Total, 0) AS Total,
        COALESCE(da.offered_salary, 0) AS 'Salary Package in LPA (Lakhs per annum)'
    FROM
        DepartmentAggregates da
    ORDER BY
        da.company_name, da.interview_date;
    "
    ];
    
    // Specify starting rows for each query
    $startRows = [9, 10, 11, 12, 18]; // Starting row numbers for each query
    
    foreach ($queries as $index => $sql) {
        $result = $conn->query($sql);
    
        if (!$result) {
            echo "SQL Error for query $index: " . $conn->error . "\n";
            continue;
        }
    
        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = array_values($row);
            }
    
            // Calculate the number of rows to be written
            $numRows = count($data);
            $endRow = $startRows[$index] + $numRows - 1; // Calculate the end row
    
            // Define the range dynamically based on the number of rows
            if ($index == 4) { // Special handling for the 5th query
                $range = 'batch2025!A' . $startRows[$index] . ':Z' . $endRow;
            } else {
                $range = 'batch2025!E' . $startRows[$index] . ':H' . $endRow;
            }
    
            // Clear the specified range before updating the Google Sheet with the current query's data
            try {
                $clearRange = $index == 4 ? 'batch2025!A' . $startRows[$index] . ':Z' . ($startRows[$index] + 999) : 'batch2025!E' . $startRows[$index] . ':H' . ($startRows[$index] + 999);
                $clearResponse = $service->spreadsheets_values->clear($spreadsheetId, $clearRange, new \Google_Service_Sheets_ClearValuesRequest());
    
                $body = new Sheets\ValueRange([
                    'values' => $data
                ]);
                $params = [
                    'valueInputOption' => 'USER_ENTERED'
                ];
    
                $response = $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
                printf("%d cells updated for query %d.\n", $response->getUpdatedCells(), $index + 1);
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
    
    $conn->close();
}


?>

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
                <h2 class="main-container-heading"><a href="./analysis-and-report.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
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
                                    <label for=""><strong>Company:</strong></label>
                                    <input type="text" placeholder="Company">      
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