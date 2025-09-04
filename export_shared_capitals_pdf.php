<?php

// Include the library (change the path if necessary)
require('fpdf/fpdf.php');

// connect.php - Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coop_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create a new PDF instance with portrait orientation
$pdf = new FPDF('P', 'mm', 'A4'); // P = Portrait, mm = millimeters, A4 size
$pdf->AddPage();

// Add logo (adjust path, position, and size as needed)
$pdf->Image('logo.png', 40, 5, 20); // Logo at (95mm, 5mm) with 20mm width

// Add header text
$pdf->SetFont('Times', 'B', 12); // Font for header
$pdf->Cell(0, 10, 'Hermana Fausta Multi-Purpose Cooperative', 0, 1, 'C'); // Center-aligned header
$pdf->SetFont('Times', '', 10); // Smaller font for subtext (optional)
$pdf->Cell(0, 5, 'Shared Capitals List', 0, 1, 'C'); // Center-aligned tagline

// Draw a line below the header
$pdf->Ln(5); // Line break
$pdf->Line(10, 30, 200, 30); // Horizontal line from (10mm, 30mm) to (200mm, 30mm)

// Move below the header
$pdf->Ln(10);

// Set font for the table headers
$pdf->SetFont('Times', 'B', 6);

// Add table headers
$headers = ['ID', 'Membership ID', 'Name of Member', 'Date Added', 'Status'];
$widths = [10, 40, 70, 40, 30]; // Define column widths

// Add header cells
foreach ($headers as $key => $header) {
    $pdf->Cell($widths[$key], 6, $header, 1, 0, 'C'); // Height 6 for headers
}
$pdf->Ln(); // New line after headers

$pdf->SetFont('Times', '', 6); // Smaller font for data rows

// Fetch member data
$sql = "SELECT * FROM coop_members_shared_capital ORDER BY name_of_member ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell($widths[0], 5, $row['id'], 1);
        $pdf->Cell($widths[1], 5, $row['Membership_ID'], 1);
        $pdf->Cell($widths[2], 5, $row['name_of_member'], 1);
        $pdf->Cell($widths[3], 5, $row['Date_Added'], 1);
        $pdf->Cell($widths[4], 5, $row['status'], 1);
        $pdf->Ln(); // New line for next row
    }
} else {
    $pdf->Cell(0, 5, 'No members found', 1, 1, 'C');
}

$conn->close();

// Output the PDF
$pdf->Output('D', 'members_summary.pdf');
?>
