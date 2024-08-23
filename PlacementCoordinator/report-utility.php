<?php

// Include the Composer autoloader
require __DIR__ . '/GoogleSheetsReports/vendor/autoload.php';

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Drive;
use Google\Service\Calendar;

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
