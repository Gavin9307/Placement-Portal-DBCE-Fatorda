<?php

// Include the Composer autoloader
require __DIR__ . '/vendor/autoload.php';

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Drive;

// Initialize the Google Client
$client = new Client();
$client->setApplicationName('XAMPP to Google Sheets');
$client->setScopes([Sheets::SPREADSHEETS, Sheets::DRIVE]);
$client->setAuthConfig('D:/STEPHEN/Downloads/client_secret_230758258420-13mvvjsanoatlbc2o97b5p5u8509rjp7.apps.googleusercontent.com.json');
$client->setAccessType('offline');
$client->setPrompt('select_account consent');
$client->setRedirectUri('http://localhost:8080/'); // or your redirect URI

// Load previously authorized credentials from a file.
$tokenPath = 'token.json';
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

// Create database connection
$conn = new mysqli('localhost', 'root', '', 'placementdbce');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT CONCAT_WS(' ',s.S_Fname,s.S_Mname,s.S_Lname) as Name,c.Class_name as Class,d.Dept_name as Department,com.C_Name as Company,jp.J_Offered_salary as Offered_Salary,jo.Job_Post_Date as Joining_Date
FROM student as s
INNER JOIN class as c on s.S_Class_id=c.Class_id
INNER JOIN department as d on d.Dept_id=c.Dept_id
INNER JOIN jobapplication as ja ON ja.S_College_Email = s.S_College_Email 
INNER JOIN jobposting as jo ON jo.J_id = ja.J_id
INNER JOIN jobplacements as jp on jp.J_id = ja.J_id
INNER JOIN company as com on com.C_id = jo.C_id

WHERE ja.placed = 1;"; // Replace with your table name
$result = $conn->query($sql);

// Prepare data for Google Sheets as array
$data = [];


// Fetch the headers
if ($result->num_rows > 0) {
    $fields = $result->fetch_fields();
    $headers = [];
    foreach ($fields as $field) {
        $headers[] = $field->name;
    }
    $data[] = $headers; 
}

// Fetch the rows
while ($row = $result->fetch_assoc()) {
    $data[] = array_values($row); 
}

$spreadsheetId = '1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0'; // Replace with your spreadsheet ID
$range = 'Students details!A6'; // Start from the row no.(length of cells)

// Clear the sheet contents






// Prepare the request
$body = new Sheets\ValueRange([
    'values' => $data
]);
$params = [
    'valueInputOption' => 'RAW' //parsing
];

// Updating  the sheet with new data
try {
    $response = $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
    printf("%d cells updated.", $response->getUpdatedCells());
} catch (Exception $e) {
    //echo 'Error: ' . $e->getMessage();
}

$conn->close();





// Your PHP code logic here

// Condition for redirection
$shouldRedirect = true;

if ($shouldRedirect) {
   header("Location: /Placement-Portal-DBCE-Fatorda/PlacementCoordinator/analysis-and-report-yearly.php");

    exit();
}
?>
