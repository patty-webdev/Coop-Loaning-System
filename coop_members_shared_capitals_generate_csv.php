<?php
// Database connection (include your 'config.php' file)
include_once 'config/config.php';

// Get the search query from the URL parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query to fetch records from coop_members table
$sql = "SELECT 
            Membership_ID,
            name_of_member,
            Date_Added,
            status
        FROM coop_members_shared_capital";

if (!empty($search)) {
    $sql .= " WHERE name_of_member LIKE '%$search%' OR Membership_ID LIKE '%$search%'";
}

$result = $conn->query($sql);

// Set headers for CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="Shared Capital Reports.csv"');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Output headers
fputcsv($output, array(
    'Membership ID', 
    'Name of Member', 
    'Date Added', 
    'Status'
));

// Output data
while ($row = $result->fetch_assoc()) {
    fputcsv($output, array(
        $row['Membership_ID'],
        $row['name_of_member'],
        $row['Date_Added'],
        $row['status']
    ));
}

// Close connection
$conn->close();
?>
