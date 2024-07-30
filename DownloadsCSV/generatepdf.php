<?php
require('fpdf/fpdf.php');

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

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Add a common heading
$pdf->Cell(0, 10, 'Don Bosco College Of Engineering Fatorda', 0, 1, 'C');
$pdf->Ln(10);

if ($result->num_rows > 0) {
    // Get the column headers
    $headers = array_keys($result->fetch_assoc());
    $result->data_seek(0); // Reset the result pointer

    // Set header font
    $pdf->SetFont('Arial', 'B', 10);
    foreach ($headers as $col) {
        $pdf->Cell(40, 10, $col, 1);
    }
    $pdf->Ln();

    // Set data font
    $pdf->SetFont('Arial', '', 10);
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $col) {
            $pdf->Cell(40, 10, $col, 1);
        }
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No data found', 0, 1);
}

$conn->close();

// Output the PDF
$pdf->Output('D', 'orders.pdf');
?>
