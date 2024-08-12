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


}