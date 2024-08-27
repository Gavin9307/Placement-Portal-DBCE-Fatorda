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
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'CIVIL' THEN s.S_College_Email END) AS CIVIL,
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'MECH' THEN s.S_College_Email END) AS MECH,
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'ETC' THEN s.S_College_Email END) AS ETC,
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'COMP' THEN s.S_College_Email END) AS COMP
FROM 
    student AS s
INNER JOIN 
    class AS cl ON s.S_Class_id = cl.Class_id
INNER JOIN 
    department AS d ON cl.Dept_id = d.Dept_id;",
    
    "SELECT
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'CIVIL' THEN s.S_College_Email END) AS CIVIL,
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'MECH' THEN s.S_College_Email END) AS MECH,
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'ETC' THEN s.S_College_Email END) AS ETC,
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
WHERE
    s.S_Year_of_Admission = '2021' AND ja.Interest = 1 AND jp.J_Due_date < CURDATE();", //dynamic job id ja.J_id required
    
    "SELECT
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'CIVIL' THEN s.S_College_Email END) AS CIVIL,
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'MECH' THEN s.S_College_Email END) AS MECH,
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'ETC' THEN s.S_College_Email END) AS ETC,
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
WHERE
    s.S_Year_of_Admission = '2021' AND ja.Interest = 1 AND jp.J_Due_date > CURDATE();",
    
    "SELECT
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'CIVIL' THEN s.S_College_Email END) AS CIVIL,
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'MECH' THEN s.S_College_Email END) AS MECH,
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'ETC' THEN s.S_College_Email END) AS ETC,
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
WHERE
    s.S_Year_of_Admission = '2021' AND ja.Interest = 0 AND jp.J_Due_date > CURDATE();",

"SELECT
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'CIVIL' THEN s.S_College_Email END) AS CIVIL,
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'MECH' THEN s.S_College_Email END) AS MECH,
        COUNT(DISTINCT CASE WHEN d.Dept_name = 'ETC' THEN s.S_College_Email END) AS ETC,
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
WHERE
    s.S_Year_of_Admission = '2021' AND ja.placed = 1 AND jp.J_Due_date < CURRENT_DATE();;",
    
    "SELECT
        ROW_NUMBER() OVER (ORDER BY jp.Job_Post_Date) AS 'Sr No',
        c.C_Name AS 'Company Name',
        c.C_Location AS Location,
        jp.Job_Post_Date AS 'Interview Date',
        COUNT(CASE WHEN d.Dept_name = 'CIVIL' THEN 1 END) as CIVIL,
        COUNT(CASE WHEN d.Dept_name = 'MECH' THEN 1 END) as MECH,
        COUNT(CASE WHEN d.Dept_name = 'ETC' THEN 1 END) as ETC,
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
    WHERE ja.placed = 1 AND jp.Job_Post_Date BETWEEN '2024-01-01' AND '2024-12-31'"
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
downloadSheetAsCSV($spreadsheetId,$sheetId,$range, $filename);



$conn->close();
?>