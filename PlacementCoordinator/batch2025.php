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



// Create database connection
$conn = new mysqli('localhost', 'root', '', 'placementdbce');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT 
    COUNT(CASE WHEN d.Dept_name = 'CIVIL' THEN 1 END) as CIVIL,
    COUNT(CASE WHEN d.Dept_name = 'MECH' THEN 1 END) as MECH,
    COUNT(CASE WHEN d.Dept_name = 'ETC' THEN 1 END) as ETC,
    COUNT(CASE WHEN d.Dept_name = 'COMP' THEN 1 END) as COMP
FROM 
    student as s
INNER JOIN 
    class as c ON c.Class_id = s.S_Class_id
INNER JOIN 
    department as d ON c.Dept_id = d.Dept_id
WHERE 
    s.S_Year_of_Admission = '2021';"; // Replace with your table name
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

$spreadsheetId = '1-WaAX--E--eWShVlqYrjqdwGs1IGzJCjk7Z8eXQ1OGo'; 
$range = 'batch2025!A6:Z'; 

// Specify the folder ID where the sheet should be stored
$folderId = '1vHugh2jrY3yvGv9kef93RHx1aVMcnP3g'; 

// Move the spreadsheet to the specified folder
$file = new DriveFile();
$driveService->files->update($spreadsheetId, $file, [
    'addParents' => $folderId,
    'removeParents' => 'root', 
    'fields' => 'id, parents'
]);


// Clear the data
try {
    $requestBody = new Sheets\ClearValuesRequest();
    $response = $service->spreadsheets_values->clear($spreadsheetId, $range, $requestBody);
    echo "Data cleared successfully.";
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}





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




// Condition for redirection
$shouldRedirect = true;

if ($shouldRedirect) {
    //returning to orignal page
   //header("Location: /Placement-Portal-DBCE-Fatorda/PlacementCoordinator/analysis-and-report-yearly.php");

    //exit();
}
?>
