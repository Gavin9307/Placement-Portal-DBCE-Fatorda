<?php

// Include the Composer autoloader
require __DIR__ . './GoogleSheetsReports/vendor/autoload.php';

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;

// Initialize the Google Client
$client = new Client();
$client->setApplicationName('XAMPP to Google Sheets');
$client->setScopes([Sheets::SPREADSHEETS, Sheets::DRIVE]);
$client->setAuthConfig('D:/STEPHEN/Downloads/client_secret_230758258420-13mvvjsanoatlbc2o97b5p5u8509rjp7.apps.googleusercontent.com.json');
$client->setAccessType('offline');
$client->setPrompt('select_account consent');
$client->setRedirectUri('http://localhost:8080/'); // or your redirect URI

// Load previously authorized credentials from a file.
$tokenPath = './GoogleSheetsReports/token.json';
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

// **Define the spreadsheet ID**
$spreadsheetId = '1-WaAX--E--eWShVlqYrjqdwGs1IGzJCjk7Z8eXQ1OGo'; 

// Create database connection
$conn = new mysqli('localhost', 'root', '', 'placementdbce');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define queries
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
    WHERE
        ja.placed = 1
        AND jp.Job_Post_Date BETWEEN '2024-01-01' AND '2024-12-31'
    GROUP BY
        c.C_Name, c.C_Location, jp.Job_Post_Date, jo.J_Offered_salary, d.Dept_Name
)

SELECT
    ROW_NUMBER() OVER (ORDER BY ap.company_name, ap.interview_date) AS Sr_No,
    ap.company_name AS `Company Name`,
    ap.location AS Location,
    ap.interview_date AS `Interview Date`,
    COALESCE(SUM(CASE WHEN ap.dept_name = 'CIVIL' THEN ap.students_count ELSE 0 END), 0) AS CIVIL,
    COALESCE(SUM(CASE WHEN ap.dept_name = 'MECH' THEN ap.students_count ELSE 0 END), 0) AS MECH,
    COALESCE(SUM(CASE WHEN ap.dept_name = 'ETC' THEN ap.students_count ELSE 0 END), 0) AS ETC,
    COALESCE(SUM(CASE WHEN ap.dept_name = 'COMP' THEN ap.students_count ELSE 0 END), 0) AS COMP,
    COALESCE(SUM(ap.students_count), 0) AS Total,
    ap.offered_salary AS `Salary Package in LPA (Lakhs per annum)`
FROM
    AggregatedPlacements ap
GROUP BY
    ap.company_name, ap.location, ap.interview_date, ap.offered_salary
ORDER BY
    ap.company_name, ap.interview_date;

"


];

// Specify starting rows for each query
$startRows = [9, 10, 11, 12, 18]; // Starting row numbers for each query

foreach ($queries as $index => $sql) {
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = array_values($row);
        }

        // Define the range for each query
        if ($index == 4) { // This is for the new query at index 4
            $range = 'batch2025!A' . $startRows[$index] . ':Z' . $startRows[$index];
        } else {
            $range = 'batch2025!E' . $startRows[$index] . ':H' . $startRows[$index]; // Adjust range as needed
        }
        // Update the Google Sheet with the current query's data
        try {
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
?>
