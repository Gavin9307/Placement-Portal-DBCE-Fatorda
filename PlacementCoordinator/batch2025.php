<?php

// Include the Composer autoloader
require __DIR__ . '/GoogleSheetsReports/vendor/autoload.php';

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;

// Initialize the Google Client
$client = new Client();
$client->setApplicationName('XAMPP to Google Sheets');
$client->setScopes([Sheets::SPREADSHEETS, Sheets::DRIVE]);
$client->setAuthConfig(__DIR__ . '/client_secret.json');
$client->setAccessType('offline');
$client->setPrompt('select_account consent');
$client->setRedirectUri('http://localhost:8080/'); // or your redirect URI

// Load previously authorized credentials from a file.
$tokenPath = __DIR__ . '/GoogleSheetsReports/token.json';
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
        // Check if the script is run from the command line
        if (php_sapi_name() == 'cli') {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
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

    // Save the token to a file (token.json).
    if (!file_exists(dirname($tokenPath))) {
        mkdir(dirname($tokenPath), 0700, true);
    }
    file_put_contents($tokenPath, json_encode($client->getAccessToken()));
}

// Initialize the Google Sheets API Service
$service = new Sheets($client);
$driveService = new Drive($client);

// *Define the spreadsheet ID*
$spreadsheetId = '1-WaAX--E--eWShVlqYrjqdwGs1IGzJCjk7Z8eXQ1OGo'; 

// Create database connection
$conn = new mysqli('localhost', 'root', '', 'placementdbce');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define queries
$queries = [
    "SELECT 
    COUNT(CASE WHEN d.Dept_name = 'CIVIL' THEN 1 END) AS 'CIVIL',
    COUNT(CASE WHEN d.Dept_name = 'MECH' THEN 1 END) AS 'MECH',
    COUNT(CASE WHEN d.Dept_name = 'ETC' THEN 1 END) AS 'ETC',
    COUNT(CASE WHEN d.Dept_name = 'COMP' THEN 1 END) AS 'COMP'
FROM 
    student AS s
INNER JOIN 
    class AS cl ON s.S_Class_id = cl.Class_id
INNER JOIN 
    department AS d ON cl.Dept_id = d.Dept_id;",
    
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




$range = "batch2025!A1:M";
function downloadSheetAsPDF($spreadsheetId, $sheetId, $range, $filename) {
    $url = "https://docs.google.com/spreadsheets/d/$spreadsheetId/export?format=pdf&gid=$sheetId&range=$range";

    // Download and save the PDF
    downloadFile($url, "$filename.pdf");
}

function downloadFile($url, $outputFile) {
    $fileData = file_get_contents($url);

    // Save the file to the specified output
    file_put_contents($outputFile, $fileData);

    // Set headers to trigger download
    header('Content-Type: application/pdf');
    header("Content-Disposition: attachment; filename=$outputFile");
    readfile($outputFile);
}
function downloadSheetAsExcel($spreadsheetId, $sheetId, $range, $filename) {
    $url = "https://docs.google.com/spreadsheets/d/$spreadsheetId/export?format=xlsx&gid=$sheetId&range=$range";

    // Download and save the Excel file
    downloadFile($url, "$filename.xlsx");
}
function downloadSheetAsCSV($spreadsheetId, $sheetId, $range, $filename) {
    $url = "https://docs.google.com/spreadsheets/d/$spreadsheetId/export?format=csv&gid=$sheetId&range=$range";

    // Download and save the CSV file
    downloadFile($url, "$filename.csv");
}

$sheetId = 0;
$filename = "Batch";
downloadSheetAsPDF($spreadsheetId,$sheetId,$range, $filename);



$conn->close();
?>