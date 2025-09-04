<?php
include 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $membership_id = trim($_POST["Membership_ID"]);

    if (empty($membership_id)) {
        echo "<script>alert('Please enter a Membership ID.'); window.history.back();</script>";
        exit;
    }

    // Check if Membership ID exists
    $query = "SELECT * FROM shared_capital_amount WHERE Membership_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $membership_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        header("Location: coop_members_shared_capitals_contribution.php?error=1&message=" . urlencode("No records found for Membership ID: $membership_id"));
        exit;
    }

    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="shared_capital_distribution_' . $membership_id . '.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Membership ID', 'Name', 'Amount', 'Date Paid']);

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [$row['Membership_ID'], $row['Name'], $row['Amount'], $row['Date_Paid']]);
    }

    fclose($output);

    // Redirect to the main page after download with a success message
    header("Location: coop_members_shared_capitals_contribution.php?success=1&message=" . urlencode("CSV exported successfully."));
    exit;
}
?>
