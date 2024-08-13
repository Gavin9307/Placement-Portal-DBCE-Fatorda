<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
include "./report-utility.php"; // This includes the necessary Google Sheets API setup
global $conn;

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_GET["jid"])) {
    header("Location: ./job-management.php");
    exit();
}

if (isset($_POST["getreport-button"])) {
    $sql =  "SELECT s.S_Year_of_Admission + 4 as Batch, 
       s.S_College_Email as 'College Email', 
       s.S_Personal_Email as 'Personal Email',
       s.S_Fname as 'First Name', 
       s.S_Mname as 'Middle Name', 
       s.S_Lname as 'Last Name', 
       d.Dept_name as 'Department'
FROM student as s
INNER JOIN jobapplication as ja ON s.S_College_Email=ja.S_College_Email
INNER JOIN class as c ON c.Class_id=s.S_Class_id
INNER JOIN department as d ON d.Dept_id=c.Dept_id
INNER JOIN jobplacements as jp ON jp.J_id = ja.J_id
WHERE ja.J_id = ".$_GET["jid"]." AND ja.Interest = 1;
";

    $result = $conn->query($sql);
    $spreadsheetId = '1fGnnbnpsG2Ep1brwKAGLwqVPpWybbwuBBK9j8Sxuc64'; 
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

    // Specify the spreadsheet ID and range
    $spreadsheetId = '1fGnnbnpsG2Ep1brwKAGLwqVPpWybbwuBBK9j8Sxuc64';
    $range = 'Sheet1!A7:Z'; // Adjust range as needed to cover all possible cells

    // Clear the existing content in the range
    try {
        $clearResponse = $service->spreadsheets_values->clear($spreadsheetId, $range, new \Google_Service_Sheets_ClearValuesRequest());
    } catch (Exception $e) {
        echo 'Error clearing sheet: ' . $e->getMessage();
        exit();
    }

    // Prepare the request body to update the sheet
    $body = new \Google_Service_Sheets_ValueRange([
        'values' => $data
    ]);
    $params = [
        'valueInputOption' => 'USER_ENTERED' // or 'RAW' depending on your need
    ];

    // Update the sheet with new data
    try {
        $response = $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
        printf("%d cells updated.", $response->getUpdatedCells());
    } catch (Exception $e) {
        echo 'Error updating sheet: ' . $e->getMessage();
        exit();
    }

    // Download the updated sheet as a PDF or Excel file
    try {
        // Set the export MIME type (application/pdf for PDF, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet for Excel)
        $exportMimeType = 'application/pdf'; // or use 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' for Excel

        $exportedFile = $driveService->files->export($spreadsheetId, $exportMimeType, array('alt' => 'media'));

        // Set the appropriate headers for file download
        header('Content-Type: ' . $exportMimeType);
        header('Content-Disposition: attachment; filename="report.pdf"'); // or 'report.xlsx' for Excel

        // Output the file to the browser
        echo $exportedFile->getBody();
        exit();
    } catch (Exception $e) {
        echo 'Error downloading sheet: ' . $e->getMessage();
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/live-listing-analysis.css">
    <title>Live Listing Analysis</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="<?php echo './job-live-listing-analysis.php?jid='.$_GET["jid"]; ?>"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                        Details</h2>
                    <!-- <div class="company-container">
                        <p>Google</p>
                    </div> -->
                </div>

               
                <h3>Interested Students</h3>
                <div class="sections">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Batch</th>
                            <th>Status</th>
                            <th>Details</th>
                            <th>Remove</th>
                        </tr>

                        <?php getInterestedStudentsAll(); ?>
                        
                       
                    </table>
                </div>
                <form action="" method="post">
                    <button name="getreport-button" class="getreport-button">Get Report</button>
                </form>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>