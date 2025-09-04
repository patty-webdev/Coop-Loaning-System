<?php

// Include the library (change the path if necessary)
require('fpdf/fpdf.php');

// connect.php - Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coop";

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
$pdf->Cell(0, 5, 'Address or Tagline Here', 0, 1, 'C'); // Center-aligned tagline

// Draw a line below the header
$pdf->Ln(5); // Line break
$pdf->Line(10, 30, 320, 30); // Horizontal line from (10mm, 30mm) to (320mm, 30mm)

// Move below the header
$pdf->Ln(10);

// Set font for the table headers
$pdf->SetFont('Times', 'B', 4);

// Add table headers
$headers = [
    'Membership ID', 'Name', 'Type of Loan', 'Loan Amount', 'Term', 'OR Number',
    'Payment Date', 'Date of Loan', 'Insurance Premium', 'Co-Makers', 'Birthday of Member',
    'Rate', 'Monthly Payment', 'Created At'
];

// Define extremely compact column widths
$widths = [15, 25, 20, 20, 15, 25, 25, 25, 25, 30, 25, 15, 20, 20];

// Add header cells
foreach ($headers as $key => $header) {
    $pdf->Cell($widths[$key], 4, $header, 1, 0, 'C'); // Very small height for headers
}
$pdf->Ln(); // New line after headers

$pdf->SetFont('Times', '', 4); // Extremely small font for data rows

// Fetch loan data
$sql = "SELECT membership_id, name, type_of_loan, loan_amount, term, OR_number, payment_date, date_of_loan, insurance_premium, 
co_makers, birthday_of_member, rate, monthly_payment, created_at FROM coop_member_loans order by name";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell($widths[0], 3, $row['membership_id'], 1);
        $pdf->Cell($widths[1], 3, $row['name'], 1);
        $pdf->Cell($widths[2], 3, $row['type_of_loan'], 1);
        $pdf->Cell($widths[3], 3, $row['loan_amount'], 1);
        $pdf->Cell($widths[4], 3, $row['term'], 1);
        $pdf->Cell($widths[5], 3, $row['OR_number'], 1);
        $pdf->Cell($widths[6], 3, $row['payment_date'], 1);
        $pdf->Cell($widths[7], 3, $row['date_of_loan'], 1);
        $pdf->Cell($widths[8], 3, $row['insurance_premium'], 1);
        $pdf->Cell($widths[9], 3, $row['co_makers'], 1);
        $pdf->Cell($widths[10], 3, $row['birthday_of_member'], 1);
        $pdf->Cell($widths[11], 3, $row['rate'], 1);
        $pdf->Cell($widths[12], 3, $row['monthly_payment'], 1);
        $pdf->Cell($widths[13], 3, $row['created_at'], 1);
        $pdf->Ln(); // New line for next row
    }
} else {
    $pdf->Cell(0, 3, 'No loan records found', 1, 1, 'C');
}

$conn->close();

// Output the PDF
$pdf->Output('D', 'loan_records.pdf');
?>
