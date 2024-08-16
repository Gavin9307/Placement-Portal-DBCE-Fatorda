<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
include "./report-utility.php"; // Includes Google Sheets API setup

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_GET["jid"])) {
    header("Location: ./job-management.php");
    exit();
}

if (isset($_POST["getreport-button"])) {
    $jobId = intval($_GET["jid"]);

    // Fetch the list of questions for the job
    $questionsQuery = "
        SELECT q.Question_ID, q.Question_Text
        FROM jobquestions jq
        INNER JOIN questions q ON jq.Question_ID = q.Question_ID
        WHERE jq.Job_ID = $jobId;
    ";
    
    $questionsResult = $conn->query($questionsQuery);

    if ($questionsResult === FALSE) {
        echo "Error fetching questions: " . $conn->error;
        exit();
    }

    $caseStatements = [];
    $questionTexts = [];
    
    while ($row = $questionsResult->fetch_assoc()) {
        $questionText = $row['Question_Text'];
        $caseStatements[] = "MAX(CASE WHEN q.Question_Text = '$questionText' THEN sr.Response_Text END) AS `$questionText`";
        $questionTexts[] = $questionText;
    }

    $caseStatementList = implode(", ", $caseStatements);

    // Construct the final SQL query
    $sql = "
        SELECT s.S_Year_of_Admission + 4 AS Batch, 
               s.S_College_Email AS 'College Email', 
               s.S_Personal_Email AS 'Personal Email',
               s.S_Fname AS 'First Name', 
               s.S_Mname AS 'Middle Name', 
               s.S_Lname AS 'Last Name', 
               d.Dept_name AS 'Department',
               $caseStatementList
        FROM student AS s
        INNER JOIN jobapplication AS ja ON s.S_College_Email = ja.S_College_Email
        INNER JOIN class AS c ON c.Class_id = s.S_Class_id
        INNER JOIN department AS d ON d.Dept_id = c.Dept_id
        INNER JOIN jobplacements AS jp ON jp.J_id = ja.J_id
        INNER JOIN studentresponses AS sr ON sr.Student_Email = s.S_College_Email 
            AND sr.Job_ID = ja.J_id
        INNER JOIN jobquestions AS jq ON jq.Job_ID = ja.J_id 
            AND jq.Question_ID = sr.Question_ID
        INNER JOIN questions AS q ON q.Question_ID = jq.Question_ID
        WHERE ja.J_id = $jobId AND ja.Interest = 1
        GROUP BY s.S_Year_of_Admission, s.S_College_Email, s.S_Personal_Email, s.S_Fname, s.S_Mname, s.S_Lname, d.Dept_name;
    ";

    $result = $conn->query($sql);
    $spreadsheetId = '1fGnnbnpsG2Ep1brwKAGLwqVPpWybbwuBBK9j8Sxuc64'; 
    // Prepare data for Google Sheets as an array
    $data = [];

    // Check if data is retrieved from the database
    if ($result->num_rows > 0) {
        // Fetch the headers
        $headers = array_merge([
            'Batch', 'College Email', 'Personal Email', 
            'First Name', 'Middle Name', 'Last Name', 
            'Department'
        ], $questionTexts);
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
        $exportMimeType = 'application/pdf'; // or use 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' for Excel

        $exportedFile = $driveService->files->export($spreadsheetId, $exportMimeType, ['alt' => 'media']);

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