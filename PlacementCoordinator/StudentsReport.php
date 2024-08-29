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



// Create database connection
$conn = new mysqli('localhost', 'root', '', 'placementdbce');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT
    COALESCE(CONCAT_WS(' ',s.S_Fname,s.S_Mname,s.S_Lname), 'NA') AS 'Student Name',
    COALESCE(cl.Class_name, 'NA') AS 'Class',
    COALESCE(d.Dept_name, 'NA') AS 'Department',
    COALESCE(c.C_Name, 'NA') AS 'Company Name',
    COALESCE(jo.J_Offered_salary, 'NA') AS 'Offered Salary',
    COALESCE(jo.J_Due_date, 'NA') AS 'Joining Date'
FROM 
    student AS s
INNER JOIN 
    class AS cl ON s.S_Class_id = cl.Class_id
INNER JOIN 
    department AS d ON cl.Dept_id = d.Dept_id
INNER JOIN 
    jobapplication AS ja ON s.S_College_Email = ja.S_College_Email
INNER JOIN 
    jobplacements AS jo ON ja.J_id = jo.J_id
INNER JOIN 
    jobposting AS jp ON jo.J_id = jp.J_id
INNER JOIN 
    company AS c ON jp.C_id = c.C_id
WHERE 
    ja.placed = 1
ORDER BY 
    cl.Class_name;"; // Replace with your table name
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

$spreadsheetId = '1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0'; 
$range = 'students details!B6:Z'; 

// Specify the folder ID where the sheet should be stored
$folderId = '1tVGQyQh872_UiuXQMqjlHwp_-9bNMQfq'; 

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
    'valueInputOption' => 'USER_ENTERED' //parsing
];

// Updating  the sheet with new data
try {
    $response = $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
    printf("%d cells updated.", $response->getUpdatedCells());
} catch (Exception $e) {
    //echo 'Error: ' . $e->getMessage();
}

$conn->close();

?>
