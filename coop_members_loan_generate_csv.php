<?php
// Database connection (include your 'config.php' file)
include_once 'config/config.php';

// Get the search query from the URL parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query to fetch records from coop_members table
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

// Output headers
fputcsv($output, array(
    'Membership ID', 
    'Name', 
    'Type of Loan', 
    'Loan Amount', 
    'Term', 
    'O.R Number', 
    'Payment Date', 
    'Date of Loan', 
    'Insurance Premium', 
    'Co-makers', 
    'Birthday of Member', 
    'Rate', 
    'Monthly Payment', 
    'Created At'
));

// Output data
while ($row = $result->fetch_assoc()) {
    fputcsv($output, array(
        $row['membership_id'],
        $row['name'],
        $row['type_of_loan'],
        $row['loan_amount'],
        $row['term'],
        $row['OR_number'],
        $row['payment_date'],
        $row['date_of_loan'],
        $row['insurance_premium'],
        $row['co_makers'],
        $row['birthday_of_member'],
        $row['rate'],
        $row['monthly_payment'],
        $row['created_at']
    ));
}

// Close connection
$conn->close();
?>
