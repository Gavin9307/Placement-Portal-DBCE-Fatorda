
<?php

// Include the Composer autoloader
require __DIR__ . '/vendor/autoload.php';

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Drive;
use Google\Service\Calendar;

// Initialize the Google Client
$client = new Client();
$client->setApplicationName('XAMPP to Google Sheets');
$client->setScopes([Sheets::SPREADSHEETS, Drive::DRIVE, Calendar::CALENDAR]);
$client->setAuthConfig('C:/xampp/htdocs/graphs/client_secret.json');
$client->setAccessType('offline');
$client->setPrompt('select_account consent');
$client->setRedirectUri('http://localhost:8080/'); // or your redirect URI

// Load previously authorized credentials from a file.
$tokenPath = 'token.json';

// Check if a token file exists
if (file_exists($tokenPath)) {
    $accessToken = json_decode(file_get_contents($tokenPath), true);
    $client->setAccessToken($accessToken);
}

// If there is no previous token or it's expired
if ($client->isAccessTokenExpired()) {
    // Refresh the token if possible, else fetch a new one
    if ($client->getRefreshToken()) {
        $newAccessToken = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        $client->setAccessToken($newAccessToken);
    } else {
        // Check if the script is run from the command line
        if (php_sapi_name() == 'cli') {
            // Request authorization from the user
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error
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

    // Save the new or refreshed token to the token file
    if (!file_exists(dirname($tokenPath))) {
        mkdir(dirname($tokenPath), 0700, true);
    }

    // Merge the new access token with the old one to preserve the refresh token
    $accessToken = array_merge($accessToken, $client->getAccessToken());
    file_put_contents($tokenPath, json_encode($accessToken));
}




$service = new Google\Service\Calendar($client);
$event = new Google\Service\Calendar\Event([
    'summary' => 'Testing the Google Calendar',
    'location' => 'Goa',
    'description' => 'A chance to hear more about Google\'s developer products.',
    'start' => [
        'dateTime' => '2024-08-22T09:00:00-07:00', // Fixed format
        'timeZone' => 'America/Los_Angeles',
    ],
    'end' => [
        'dateTime' => '2024-08-22T17:00:00-07:00', // Ensure end time is after start time
        'timeZone' => 'America/Los_Angeles',
    ],
    'recurrence' => [
        'RRULE:FREQ=DAILY;COUNT=2'
    ],
    'attendees' => [
        ['email' => 'stephenferns2003@gmail.com'],
        ['email' => 'fernandespierson03@gmail.com'],
    ],
    'reminders' => [
        'useDefault' => false,
        'overrides' => [
            ['method' => 'email', 'minutes' => 24 * 60],
            ['method' => 'popup', 'minutes' => 10],
        ],
    ],
]);


$calendarId = 'primary';
$event = $service->events->insert($calendarId, $event);
printf('Event created: %s\n', $event->htmlLink);


?>