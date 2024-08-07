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
$client->setRedirectUri('http://localhost:8080/');

// Load previously authorized credentials from a file
$tokenPath = './GoogleSheetsReports/token.json';
if (file_exists($tokenPath)) {
    $accessToken = json_decode(file_get_contents($tokenPath), true);
    $client->setAccessToken($accessToken);
}

// If the access token is expired, refresh it
if ($client->isAccessTokenExpired()) {
    if ($client->getRefreshToken()) {
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    } else {
        // Request authorization if no refresh token is available
        if (php_sapi_name() == 'cli') {
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        } else {
            if (!isset($_GET['code'])) {
                $authUrl = $client->createAuthUrl();
                header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
                exit();
            } else {
                $authCode = $_GET['code'];
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Save the token to a file
                if (!file_exists(dirname($tokenPath))) {
                    mkdir(dirname($tokenPath), 0700, true);
                }
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
                echo "Authorization complete. Token saved.";
                exit();
            }
        }
    }

    // Save the token to a file
    if (!file_exists(dirname($tokenPath))) {
        mkdir(dirname($tokenPath), 0700, true);
    }
    file_put_contents($tokenPath, json_encode($client->getAccessToken()));
}

// Initialize the Google Sheets API Service
$service = new Sheets($client);

// Create a database connection
$conn = new mysqli('localhost', 'root', '', 'placementdbce');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "Select * from student;"; // Replace with your table name

$result = $conn->query($sql);

// Prepare data for Google Sheets as an array
$data = [];

// Check if data is retrieved from the database
if ($result->num_rows > 0) {
    // Fetch the headers
    $fields = $result->fetch_fields();
    $headers = [];
    foreach ($fields as $field) {
        $headers[] = $field->name;
    }
    $data[] = $headers;

    // Fetch the rows
    while ($row = $result->fetch_assoc()) {
        $data[] = array_values($row);
    }
} else {
    echo "No data found.";
    exit();
}

// Verify the data structure
echo json_encode($data, JSON_PRETTY_PRINT);

// Specify the spreadsheet ID and range
$spreadsheetId = '1xoeDaDa0fUe0hFDmPlS58Evlk9jv4XFytT7fOCsban8'; // Replace with your spreadsheet ID
$range = 'placement!A16'; // Start from the row number (length of cells)

// Prepare the request
$body = new Sheets\ValueRange([
    'values' => $data
]);
$params = [
    'valueInputOption' => 'RAW' // or 'USER_ENTERED'
];

// Update the sheet with new data
try {
    $response = $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
    printf("%d cells updated.", $response->getUpdatedCells());
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

$conn->close();

// Condition for redirection
$shouldRedirect = true;

if ($shouldRedirect) {
    // Redirect to the original page
    header("Location: /Placement-Portal-DBCE-Fatorda/PlacementCoordinator/analysis-and-report-yearly.php");
    exit();
}
