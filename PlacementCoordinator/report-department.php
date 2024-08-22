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

$service = new \Google_Service_Sheets($client);
$driveService = new \Google_Service_Drive($client);

// Define the spreadsheet ID
$spreadsheetId = '14JpN-LH6GPsayqTPGeQkttiHLibREf_AnbUKu_it0NU'; 

// Create database connection
$conn = new mysqli('localhost', 'root', '', 'placementdbce');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define queries
$queries = [
    // First query for department-wise counts
    "SELECT
    COUNT(CASE WHEN d.Dept_name = 'CIVIL' THEN s.S_College_Email END) AS CIVIL,
    COUNT(CASE WHEN d.Dept_name = 'COMP' THEN s.S_College_Email END) AS COMP,
    COUNT(CASE WHEN d.Dept_name = 'MECH' THEN s.S_College_Email END) AS MECH,
    COUNT(CASE WHEN d.Dept_name = 'ECS' THEN s.S_College_Email END) AS ECS
FROM student s
JOIN class c ON s.S_Class_id = c.Class_id
JOIN department d ON c.Dept_id = d.Dept_id;",
    
    // Second query for student placement details
    "SELECT 
        CONCAT(s.S_Fname, ' ', s.S_Mname, ' ', s.S_Lname) AS 'Student Name',
        c.C_Name AS 'Company Name',
        d.Dept_name AS 'Department',
        c.C_Location AS 'Location',
        jp.J_Offered_salary AS 'Salary',
        ja.J_apply_date AS 'Placed Date'
    FROM 
        student s
    JOIN 
        jobapplication ja ON s.S_College_Email = ja.S_College_Email
    JOIN 
        jobplacements jp ON ja.J_id = jp.J_id
    JOIN 
        jobposting jpo ON jp.J_id = jpo.J_id
    JOIN 
        company c ON jpo.C_id = c.C_id
    JOIN
        class cl ON cl.Class_id=s.S_Class_id
    JOIN 
        department d ON cl.Dept_id = d.Dept_id
    WHERE 
        ja.PLACED = 1;"
];

// Specify starting rows for each query
$startRows = [19, 5]; // Starting row numbers for each query

try {
    $clearRangeAtoG = 'all!A5:G';
    $clearResponse = $service->spreadsheets_values->clear($spreadsheetId, $clearRangeAtoG, new \Google_Service_Sheets_ClearValuesRequest());
    echo "Cleared range A5:G500.\n";
} catch (Exception $e) {
    echo 'Error clearing range A5:G500: ' . $e->getMessage();
}

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
        $endRow = $startRows[$index] + $numRows - 1;

        // Define the range dynamically based on the query index
        $range = $index == 1 
            ? 'all!B' . $startRows[$index] . ':G' . $endRow  // 2nd query range
            : 'all!K' . $startRows[$index] . ':N' . $endRow; // 1st query range

        try {
            // Clear only the specific range that will be updated
            $clearRange = $range;
            
            $clearResponse = $service->spreadsheets_values->clear($spreadsheetId, $clearRange, new \Google_Service_Sheets_ClearValuesRequest());

            // Update the sheet with the data from the query
            $body = new \Google_Service_Sheets_ValueRange([
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
?>
