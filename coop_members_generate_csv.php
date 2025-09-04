<?php
// Database connection (include your 'config.php' file)
include_once 'config/config.php';

// Get the search query from the URL parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query to fetch records from coop_members table
$sql = "SELECT 
            membership_id,
            name_of_member,
            contact_number,
            tin,
            date_accepted,
            bod_resolution,
            type_of_membership,
            shares_subscribed,
            amount_subscribed,
            initial_paid_up,
            address,
            date_of_birth,
            age,
            gender,
            civil_status,
            educational_attainment,
            occupation,
            number_of_dependents,
            religious,
            annual_income
        FROM coop_members";

if (!empty($search)) {
    $sql .= " WHERE name_of_member LIKE '%$search%' OR membership_id LIKE '%$search%'";
}

$sql .= " ORDER BY name_of_member ASC";

$result = $conn->query($sql);

// Set headers for CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="membership_information.csv"');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Output headers
fputcsv($output, array(
    'Membership ID', 
    'Name of Member', 
    'Contact Number', 
    'TIN', 
    'Date Accepted', 
    'BOD Resolution Number', 
    'Type of Membership', 
    'Shares Subscribed', 
    'Amount Subscribed', 
    'Initial Paid-Up', 
    'Address', 
    'Date of Birth', 
    'Age', 
    'Gender', 
    'Civil Status', 
    'Highest Educational Attainment', 
    'Occupation', 
    'Number of Dependents', 
    'Religious', 
    'Annual Income'
));

// Output data
$record_count = 0;
while ($row = $result->fetch_assoc()) {
    fputcsv($output, array(
        $row['membership_id'],
        $row['name_of_member'],
        $row['contact_number'],
        $row['tin'],
        $row['date_accepted'],
        $row['bod_resolution'],
        $row['type_of_membership'],
        $row['shares_subscribed'],
        $row['amount_subscribed'],
        $row['initial_paid_up'],
        $row['address'],
        $row['date_of_birth'],
        $row['age'],
        $row['gender'],
        $row['civil_status'],
        $row['educational_attainment'],
        $row['occupation'],
        $row['number_of_dependents'],
        $row['religious'],
        $row['annual_income']
    ));
    $record_count++;
}

// Log the export action
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Unknown User'; // Get user ID from session
$action = "Export CSV"; // Define action type
$action_details = "Exported CSV file for membership information. Search query: '$search'. Records found: $record_count.";
logAction($conn, $user_id, $action, $action_details); // Call the logAction function with the correct arguments

// Close connection
$conn->close();
?>
