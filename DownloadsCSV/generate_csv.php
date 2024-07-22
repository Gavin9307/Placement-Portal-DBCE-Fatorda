<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "classicmodels";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $csv_data = [];

    // Fetch associative array
    while($row = $result->fetch_assoc()) {
        $csv_data[] = $row;
    }

    // Convert to CSV
    $filename = "data.csv";
    $file = fopen($filename, 'w');

    // Add a common heading
    $heading = ['Don Bosco College of engineering Fatorda']; // Replace with your custom heading
    fputcsv($file, $heading);

    // Get the column headers
    $headers = array_keys($csv_data[0]);
    fputcsv($file, $headers);

    // Write data to CSV
    foreach ($csv_data as $row) {
        fputcsv($file, $row);
    }

    fclose($file);

    // Serve the file for download
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    readfile($filename);

    // Delete the file after download
    unlink($filename);
} else {
    echo "No data found";
}
$conn->close();
?>
