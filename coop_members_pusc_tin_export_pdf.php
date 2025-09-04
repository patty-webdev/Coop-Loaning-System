<?php
// Start session for error handling
session_start();

// Include the FPDF library
require('fpdf/fpdf.php');

// Database connection
require('config/config.php'); 

// Error handling for database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get filter parameters
$filter_year = isset($_GET['year']) ? intval($_GET['year']) : null;
$filter_month = isset($_GET['month']) ? intval($_GET['month']) : null;
$alphabetical_sort = isset($_GET['alphabetical']) ? $_GET['alphabetical'] === '1' : true;

// Create a new PDF instance with portrait format
$pdf = new FPDF('P', 'mm', 'A4'); // P = Portrait, mm = millimeters, A4 size
$pdf->AddPage();

// Add logo (with error handling)
if (file_exists('logo.png')) {
    $pdf->Image('logo.png', 35, 5, 20); // Position (x=35, y=5), Width=20mm
}

// Add header with better positioning
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(0, 8, 'Hermana Fausta Multi-Purpose Cooperative', 0, 1, 'C'); 
$pdf->SetFont('Times', '', 10);
$pdf->Cell(0, 6, 'List of members with their PUSC and TIN NUMBER', 0, 1, 'C');

// Add filter information
$filter_text = '';
if ($filter_year || $filter_month) {
    $filter_parts = [];
    if ($filter_year) $filter_parts[] = 'Year: ' . $filter_year;
    if ($filter_month) {
        $months = ['', 'January', 'February', 'March', 'April', 'May', 'June', 
                  'July', 'August', 'September', 'October', 'November', 'December'];
        $filter_parts[] = 'Month: ' . $months[$filter_month];
    }
    $filter_text = 'Filtered by: ' . implode(', ', $filter_parts);
    $pdf->SetFont('Times', 'I', 9);
    $pdf->Cell(0, 5, $filter_text, 0, 1, 'C');
}

$pdf->Ln(2);
$pdf->SetFont('Times', '', 8);
$pdf->Cell(0, 4, 'Generated on: ' . date('F d, Y h:i A'), 0, 1, 'C');
if ($alphabetical_sort) {
    $pdf->Cell(0, 4, 'Sorted alphabetically by member name', 0, 1, 'C');
}

// Line break & draw header line
$pdf->Ln(3);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
$pdf->Ln(5);

// Set header font
$pdf->SetFont('Times', 'B', 8);

// Table headers
$headers = ['Membership ID', 'Name of Member', 'TIN', 'Paid-up Shared Capital'];
$widths = [35, 65, 35, 45]; // Improved column widths for better fit

// Print header row
foreach ($headers as $key => $header) {
    $pdf->Cell($widths[$key], 8, $header, 1, 0, 'C');
}
$pdf->Ln(); 

$pdf->SetFont('Times', '', 8); 

// Build SQL query with filters
$sql = "SELECT cm.membership_id, cm.name_of_member, cm.tin, 
               COALESCE(SUM(sca.amount), 0) AS total_contribution
        FROM coop_members cm
        LEFT JOIN shared_capital_amount sca ON cm.membership_id = sca.membership_id
        WHERE (cm.remarks IS NULL OR cm.remarks != 'Deleted')
          AND (sca.remarks IS NULL OR sca.remarks != 'Deleted')";

// Add date filters if specified
if ($filter_year || $filter_month) {
    $date_conditions = [];
    if ($filter_year) {
        $date_conditions[] = "YEAR(sca.Date_Paid) = $filter_year";
    }
    if ($filter_month) {
        $date_conditions[] = "MONTH(sca.Date_Paid) = $filter_month";
    }
    if (!empty($date_conditions)) {
        $sql .= " AND (sca.Date_Paid IS NULL OR (" . implode(' AND ', $date_conditions) . "))";
    }
}

$sql .= " GROUP BY cm.membership_id, cm.name_of_member, cm.tin";

// Add sorting
if ($alphabetical_sort) {
    $sql .= " ORDER BY cm.name_of_member ASC";
} else {
    $sql .= " ORDER BY cm.membership_id ASC";
}

$result = $conn->query($sql);

$totalMembers = 0;
if ($result->num_rows > 0) {
    $totalMembers = $result->num_rows;
    while ($row = $result->fetch_assoc()) {
        // Handle long names by truncating if necessary
        $name = $row['name_of_member'];
        if (strlen($name) > 25) {
            $name = substr($name, 0, 22) . '...';
        }
        
        // Handle empty TIN values
        $tin = !empty($row['tin']) ? $row['tin'] : 'N/A';
        
        $pdf->Cell($widths[0], 7, $row['membership_id'], 1, 0, 'C');
        $pdf->Cell($widths[1], 7, $name, 1, 0, 'L');
        $pdf->Cell($widths[2], 7, $tin, 1, 0, 'C');
        $pdf->Cell($widths[3], 7, 'PHP ' . number_format($row['total_contribution'], 2), 1, 0, 'R');
        $pdf->Ln();
    }
} else {
    $pdf->Cell(array_sum($widths), 7, 'No records found', 1, 1, 'C');
}

$conn->close();

// Add footer with total count
$pdf->Ln(5);
$pdf->SetFont('Times', 'I', 8);
$pdf->Cell(0, 5, 'Total Members: ' . $totalMembers, 0, 1, 'L');

// Generate filename with filter information
$filename_parts = ['HFMPC_Members_PUSC_TIN'];
if ($filter_year) $filename_parts[] = 'Year' . $filter_year;
if ($filter_month) {
    $months = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
              'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $filename_parts[] = $months[$filter_month];
}
if ($alphabetical_sort) $filename_parts[] = 'Alphabetical';
$filename_parts[] = date('Y-m-d');

$filename = implode('_', $filename_parts) . '.pdf';
$pdf->Output('D', $filename); // 'D' forces download
?>