<?php
// Database connection (include your 'config.php' file)
include_once 'config/config.php';

// Get the search query from the URL parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query to fetch records from coop_members table with enhanced fields
$sql = "SELECT 
            membership_id,
            name,
            type_of_loan,   
            loan_amount,
            term,
            OR_number,
            payment_date,
            date_of_loan,
            insurance_premium,
            co_makers,
            birthday_of_member,
            rate,
            monthly_payment,
            created_at
        FROM coop_member_loans";

if (!empty($search)) {
    $sql .= " WHERE name LIKE '%$search%' OR membership_id LIKE '%$search%'";
}

$result = $conn->query($sql);

// Set headers for CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="Members Loan Reports.csv"');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Output enhanced headers with amortization details
fputcsv($output, array(
    'Membership ID', 
    'Name', 
    'Type of Loan', 
    'Principal Amount', 
    'Term (Months)', 
    'Interest Rate (%)',
    'Monthly Payment',
    'Total Interest',
    'Total Payment',
    'First Payment Date',
    'Last Payment Date',
    'Insurance Premium', 
    'Co-makers',
    'O.R Number',
    'Status',
    'Amortization Link',
    'Created At'
));

// Output data with amortization calculations
while ($row = $result->fetch_assoc()) {
    // Calculate loan details
    $principal = floatval($row['loan_amount']);
    $rate = floatval($row['rate']) / 100 / 12; // Monthly rate
    $term = intval($row['term']);
    
    // Calculate monthly payment using amortization formula
    $monthly_payment = $principal * ($rate * pow(1 + $rate, $term)) / (pow(1 + $rate, $term) - 1);
    $total_payment = $monthly_payment * $term;
    $total_interest = $total_payment - $principal;
    
    // Calculate payment dates
    $first_payment = date('Y-m-d', strtotime($row['payment_date']));
    $last_payment = date('Y-m-d', strtotime($row['payment_date'] . " + " . ($term - 1) . " months"));
    
    // Generate amortization link
    $amortization_link = "loan_amortization.php?loan_id=" . $row['membership_id'];

    fputcsv($output, array(
        $row['membership_id'],
        $row['name'],
        $row['type_of_loan'],
        number_format($principal, 2),
        $term,
        $row['rate'],
        number_format($monthly_payment, 2),
        number_format($total_interest, 2),
        number_format($total_payment, 2),
        $first_payment,
        $last_payment,
        $row['insurance_premium'],
        $row['co_makers'],
        $row['OR_number'],
        'Active', // Default status
        $amortization_link,
        $row['created_at']
    ));
}

// Close connection
$conn->close();
?>
