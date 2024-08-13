<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
// include "../report-utility.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_GET["jid"])) {
    header("Location: ./job-management.php");
    exit();
}

if (isset($_POST["getreport-button"])){
     $sql =  "SELECT s.S_Year_of_Admission + 4 as Batch, s.S_College_Email as College_Email, s.S_Personal_Email as Personal_Email,s.S_Fname as First_Name,s.S_Mname as Middle_Name,s.S_Lname as Last_Name,d.Dept_name as Department FROM student as s
INNER JOIN jobapplication as ja ON s.S_College_Email=ja.S_College_Email
INNER JOIN class as c ON c.Class_id=s.S_Class_id
INNER JOIN department as d ON d.Dept_id=c.Dept_id
INNER JOIN jobplacements as jp ON jp.J_id = ja.J_id
WHERE ja.J_id = ".$_GET["jid"]." AND ja.Interest = 1;";

    $result = $conn->query($sql);

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