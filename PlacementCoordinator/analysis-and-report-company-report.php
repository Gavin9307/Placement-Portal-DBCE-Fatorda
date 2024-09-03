<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
// include "./report-utility.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}
require __DIR__ . '/GoogleSheetsReports/vendor/autoload.php';

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Drive;
use Google\Service\Calendar;
use Google\Service\Drive\DriveFile;

// Initialize the Google Client
$client = new Client();
$client->setApplicationName('XAMPP to Google Sheets');
$client->setScopes([Sheets::SPREADSHEETS, Drive::DRIVE, Calendar::CALENDAR]);
$client->setAuthConfig(__DIR__ . '/client_secret.json');
$client->setAccessType('offline');
$client->setPrompt('select_account consent');
$client->setRedirectUri('http://localhost:8080/'); // Adjust based on your setup

// Load previously authorized credentials from a file.
$tokenPath = __DIR__ . '/GoogleSheetsReports/token.json'; // Adjust path if needed
if (file_exists($tokenPath)) {
    $accessToken = json_decode(file_get_contents($tokenPath), true);
    $client->setAccessToken($accessToken);
}

// If there is no previous token or it's expired.
if ($client->isAccessTokenExpired()) {
    // Refresh the token if possible, else fetch a new one.
    if ($client->getRefreshToken()) {
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    } else {
        // Handle authorization based on the environment (CLI or web server)
        if (php_sapi_name() == 'cli') {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            echo "Authorization complete. Token saved.";
            exit();
        } else {
            // For web server environments, redirect to the authorization URL
            if (!isset($_GET['code'])) {
                $authUrl = $client->createAuthUrl();
                header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
                exit();
            } else {
                $authCode = $_GET['code'];
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Save the token to a file.
                if (!file_exists(dirname($tokenPath))) {
                    mkdir(dirname($tokenPath), 0700, true);
                }
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
                echo "Authorization complete. Token saved.";
                exit();
            }
        }
    }
}

// Initialize the Google Sheets API Service
$service = new Sheets($client);
$driveService = new Drive($client);

$report_Query = "SELECT
        ROW_NUMBER() OVER (ORDER BY jp.Job_Post_Date) AS 'Sr No',
        c.C_Name AS 'Company Name',
        c.C_Location AS Location,
        jp.Job_Post_Date AS 'Interview Date',
        COUNT(CASE WHEN d.Dept_name = 'CIVIL' THEN 1 END) as CIVIL,
        COUNT(CASE WHEN d.Dept_name = 'MECH' THEN 1 END) as MECH,
        COUNT(CASE WHEN d.Dept_name = 'ECS' THEN 1 END) as ECS,
        COUNT(CASE WHEN d.Dept_name = 'COMP' THEN 1 END) as COMP,
        COUNT(*) as Total,
        jo.J_Offered_salary AS 'Offered Salary'
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
    WHERE ja.placed = 1 AND jp.Job_Post_Date < CURRENT_DATE ";

$report_Query_1 = "SELECT 
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'CIVIL' THEN s.S_College_Email END) AS CIVIL,
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'MECH' THEN s.S_College_Email END) AS MECH,
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'ECS' THEN s.S_College_Email END) AS ECS,
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'COMP' THEN s.S_College_Email END) AS COMP
    FROM 
        student AS s
    INNER JOIN 
        class AS cl ON s.S_Class_id = cl.Class_id
    INNER JOIN 
        department AS d ON cl.Dept_id = d.Dept_id ";
$report_Query_2 = "SELECT
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'CIVIL' THEN s.S_College_Email END) AS CIVIL,
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'MECH' THEN s.S_College_Email END) AS MECH,
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'ECS' THEN s.S_College_Email END) AS ECS,
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'COMP' THEN s.S_College_Email END) AS COMP
    FROM
        student AS s
    INNER JOIN 
        jobapplication AS ja ON ja.S_College_Email = s.S_College_Email
    INNER JOIN 
        class AS c ON c.Class_id = s.S_Class_id
    INNER JOIN 
        department AS d ON c.Dept_id = d.Dept_id
    INNER JOIN
        jobplacements AS jp ON jp.J_id = ja.J_id
    WHERE ja.Interest = 1 AND jp.J_Due_date < CURDATE()";
$report_Query_3 = "SELECT
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'CIVIL' THEN s.S_College_Email END) AS CIVIL,
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'MECH' THEN s.S_College_Email END) AS MECH,
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'ECS' THEN s.S_College_Email END) AS ECS,
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'COMP' THEN s.S_College_Email END) AS COMP
    FROM
        student AS s
    INNER JOIN 
        jobapplication AS ja ON ja.S_College_Email = s.S_College_Email
    INNER JOIN 
        class AS c ON c.Class_id = s.S_Class_id
    INNER JOIN 
        department AS d ON c.Dept_id = d.Dept_id
    INNER JOIN
        jobplacements AS jp ON jp.J_id = ja.J_id
    WHERE ja.Interest = 1 AND jp.J_Due_date > CURDATE() ";
$report_Query_4 =  "SELECT
COUNT(DISTINCT CASE WHEN d.Dept_name = 'CIVIL' THEN s.S_College_Email END) AS CIVIL,
COUNT(DISTINCT CASE WHEN d.Dept_name = 'MECH' THEN s.S_College_Email END) AS MECH,
COUNT(DISTINCT CASE WHEN d.Dept_name = 'ECS' THEN s.S_College_Email END) AS ECS,
COUNT(DISTINCT CASE WHEN d.Dept_name = 'COMP' THEN s.S_College_Email END) AS COMP
FROM
student AS s
INNER JOIN 
jobapplication AS ja ON ja.S_College_Email = s.S_College_Email
INNER JOIN 
class AS c ON c.Class_id = s.S_Class_id
INNER JOIN 
department AS d ON c.Dept_id = d.Dept_id
INNER JOIN
jobplacements AS jp ON jp.J_id = ja.J_id
WHERE ja.Interest = 0 AND jp.J_Due_date > CURDATE() ";
$report_Query_5 = "SELECT
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'CIVIL' THEN s.S_College_Email END) AS CIVIL,
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'MECH' THEN s.S_College_Email END) AS MECH,
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'ECS' THEN s.S_College_Email END) AS ECS,
            COUNT(DISTINCT CASE WHEN d.Dept_name = 'COMP' THEN s.S_College_Email END) AS COMP
    FROM
        student AS s
    INNER JOIN 
        jobapplication AS ja ON ja.S_College_Email = s.S_College_Email
    INNER JOIN 
        class AS c ON c.Class_id = s.S_Class_id
    INNER JOIN 
        department AS d ON c.Dept_id = d.Dept_id
    INNER JOIN
        jobplacements AS jp ON jp.J_id = ja.J_id
    WHERE ja.placed = 1 AND jp.J_Due_date < CURRENT_DATE() ";


if (isset($_POST["get-filter-report"])) {
    if (!empty($_POST['d_batch_year'])) {
        $batch_year = (int)$_POST['d_batch_year'] - 4;
        $report_Query .= " AND s.S_Year_of_Admission = '$batch_year'";
    }
}

if (isset($_POST["get-report-students"])) {
    $sql = urldecode($_POST['query']);
    $sql1 = urldecode($_POST['query1']);
    $sql2 = urldecode($_POST['query2']);
    $sql3 = urldecode($_POST['query3']);
    $sql4 = urldecode($_POST['query4']);
    $sql5 = urldecode($_POST['query5']);

//     echo "SQL Query: " . $sql . "<br>";
// echo "SQL Query 2: " . $sql1 . "<br>";
// echo "SQL Query 3: " . $sql2 . "<br>";
// echo "SQL Query 4: " . $sql3 . "<br>";
// echo "SQL Query 5: " . $sql4 . "<br>";
// echo "SQL Query 6: " . $sql5 . "<br>";

    // Specify the spreadsheet ID and range
    $spreadsheetId = '1-WaAX--E--eWShVlqYrjqdwGs1IGzJCjk7Z8eXQ1OGo';
    $queries = [$report_Query_1,$report_Query_2,$report_Query_3,$report_Query_4,$report_Query_5,$sql
    ];

    // Specify starting rows for each query
$startRows = [9, 10, 11, 12, 13,  18]; // Starting row numbers for each query

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
        if ($index == 5) { // Special handling for the 5th query
            $range = 'batch2025!A' . $startRows[$index] . ':Z' . $endRow;
        } else {
            $range = 'batch2025!E' . $startRows[$index] . ':H' . $endRow;
        }

        // Clear the specified range before updating the Google Sheet with the current query's data
        try {
            $clearRange = $index == 5 ? 'batch2025!A' . $startRows[$index]-1 . ':Z' . ($startRows[$index] + 999) : 'batch2025!E' . $startRows[$index] . ':H13';
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

header("Location: https://docs.google.com/spreadsheets/d/1-WaAX--E--eWShVlqYrjqdwGs1IGzJCjk7Z8eXQ1OGo");
exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/analysis-and-report-yearly.css">
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
                    <form action="" method="post">
                            <div class="batch-container">
                                <label for=""><strong>Batch: </strong></label>
                                <select name="d_batch_year" id="d_batch_year">
                                    <option value="" selected>Select Batch</option>
                                    <?php
                                    $currentYear = date('Y');
                                    for ($year = $currentYear + 4; $year >= 2016 + 4; $year--) {
                                        echo '<option value="' . $year . '">' . $year . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <button name="get-filter-report" class="add-button">Get Report</button>
                        </form>
                    </div>
                </div>
                <div class="sections">

                    <table>
                        <tr>
                            <th>Company Name</th>
                            <th>Interview Date</th>
                            <th>CIVIL</th>
                            <th>ECS</th>
                            <th>MECH</th>
                            <th>COMP</th>
                            <th>Offered Salary</th>
                        </tr>
                        <?php
                        $reportExcel = mysqli_query($conn, $report_Query);
                        if (mysqli_num_rows($reportExcel) > 0) {
                            while ($reportExcelRow = mysqli_fetch_assoc($reportExcel)) {
                                echo '<tr>
                                                    <td>' . $reportExcelRow["Company Name"] . '</td>
                                                    <td>' . $reportExcelRow["Interview Date"] . '</td>
                                                    <td>' . $reportExcelRow["CIVIL"] . '</td>
                                                    <td>' . $reportExcelRow["ECS"] . '</td>
                                                    <td>' . $reportExcelRow["MECH"] . '</td>
                                                    <td>' . $reportExcelRow["COMP"] . '</td>
                                                    <td>' . $reportExcelRow["Offered Salary"] . '</td>
                                                </tr>';
                            }
                        } else {
                            echo "No results Found";
                        }
                        ?>


                    </table>
                    <div class="button-container-1">
                        <div class="dropdown">
                            <form action="" method="post">
                                <input type="text" value="<?php echo urlencode($report_Query); ?>" name="query" hidden>
                                <input type="text" value="<?php echo urlencode($report_Query_1); ?>" name="query1" hidden>
                                <input type="text" value="<?php echo urlencode($report_Query_2); ?>" name="query2" hidden>
                                <input type="text" value="<?php echo urlencode($report_Query_3); ?>" name="query3" hidden>
                                <input type="text" value="<?php echo urlencode($report_Query_4); ?>" name="query4" hidden>
                                <input type="text" value="<?php echo urlencode($report_Query_5); ?>" name="query5" hidden>
                                <button name="get-report-students" class="download-button">Get report</button>
                            </form>
                        </div>
                    </div>
                </div>                    
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>