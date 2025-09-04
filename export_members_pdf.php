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

// Create a new PDF instance with custom page size
$pdf = new FPDF('L', 'mm', array(216, 330)); // L = Landscape, mm = millimeters, custom size (8.5 x 13 inches)
$pdf->AddPage();

// Add logo (adjust path, position, and size as needed)
$pdf->Image('logo.png', 100, 5, 20); // Logo at (10mm, 10mm) with 20mm width

// Add header text
$pdf->SetFont('Times', 'B', 12); // Font for header
$pdf->Cell(0, 10, 'Hermana Fausta Multi-Purpose Cooperative', 0, 1, 'C'); // Center-aligned header
$pdf->SetFont('Times', '', 10); // Smaller font for subtext (optional)
$pdf->Cell(0, 5, 'Members Information List', 0, 1, 'C'); // Center-aligned tagline

// Draw a line below the header
$pdf->Ln(5); // Line break
$pdf->Line(10, 30, 320, 30); // Horizontal line from (10mm, 30mm) to (320mm, 30mm)

// Move below the header
$pdf->Ln(10);

// Set font for the table headers
$pdf->SetFont('Times', 'B', 4);

// Add table headers
$headers = [
    'Membership ID', 'Name of Member', 'Contact Number', 'TIN', 'Date Accepted',
    'Type of Membership', 'Shares Subscribed', 'Amount Subscribed', 'Initial Paid Up',
    'Address', 'Date of Birth', 'Age', 'Gender', 'Civil Status', 'Occupation',
    'Number of Dependents', 'Religious', 'Annual Income', 'Highest Education',
    'BOD Resolution'
];

// Define extremely compact column widths
$widths = [15, 25, 15, 12, 15, 20, 15, 15, 15, 20, 15, 8, 8, 10, 20, 12, 15, 15, 20, 15];

// Add header cells
foreach ($headers as $key => $header) {
    $pdf->Cell($widths[$key], 4, $header, 1, 0, 'C'); // Very small height for headers
}
$pdf->Ln(); // New line after headers

$pdf->SetFont('Times', '', 4); // Extremely small font for data rows

// Fetch member data
$sql = "SELECT * FROM coop_members ORDER BY name_of_member ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell($widths[0], 3, $row['membership_id'], 1);
        $pdf->Cell($widths[1], 3, $row['name_of_member'], 1);
        $pdf->Cell($widths[2], 3, $row['contact_number'], 1);
        $pdf->Cell($widths[3], 3, $row['tin'], 1);
        $pdf->Cell($widths[4], 3, $row['date_accepted'], 1);
        $pdf->Cell($widths[5], 3, $row['type_of_membership'], 1);
        $pdf->Cell($widths[6], 3, $row['shares_subscribed'], 1);
        $pdf->Cell($widths[7], 3, $row['amount_subscribed'], 1);
        $pdf->Cell($widths[8], 3, $row['initial_paid_up'], 1);
        $pdf->Cell($widths[9], 3, $row['address'], 1);
        $pdf->Cell($widths[10], 3, $row['date_of_birth'], 1);
        $pdf->Cell($widths[11], 3, $row['age'], 1);
        $pdf->Cell($widths[12], 3, $row['gender'], 1);
        $pdf->Cell($widths[13], 3, $row['civil_status'], 1);
        $pdf->Cell($widths[14], 3, $row['occupation'], 1);
        $pdf->Cell($widths[15], 3, $row['number_of_dependents'], 1);
        $pdf->Cell($widths[16], 3, $row['religious'], 1);
        $pdf->Cell($widths[17], 3, $row['annual_income'], 1);
        $pdf->Cell($widths[18], 3, $row['educational_attainment'], 1);
        $pdf->Cell($widths[19], 3, $row['bod_resolution'], 1);
        $pdf->Ln(); // New line for next row
    }
} else {
    $pdf->Cell(0, 3, 'No members found', 1, 1, 'C');
}

$conn->close();

// Output the PDF
$pdf->Output('D', 'members_list.pdf');
?>
