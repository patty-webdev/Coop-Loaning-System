<?php
include 'config/config.php'; // Include your database connection file

// Check if the user is logged in
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    echo "<script>alert('Error: User not logged in.'); window.location.href = 'coop_members_shared_capitals_contribution.php';</script>";
    exit();
}

// Fetch the logged-in user's information
$username = $_SESSION['username'];
$userId = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $membership_id = $_GET['id'];

    // Fetch the member's name and amount associated with the membership_id
    $sql_fetch = "SELECT Name, Amount FROM shared_capital_amount WHERE id = ?";
    $stmt_fetch = $conn->prepare($sql_fetch);
    $stmt_fetch->bind_param("s", $membership_id);
    $stmt_fetch->execute();
    $result_fetch = $stmt_fetch->get_result();

    // Check if the membership_id exists
    if ($result_fetch->num_rows > 0) {
        // If the record exists, get the member's name and amount
        $row = $result_fetch->fetch_assoc();
        $name_of_member = $row['Name'];
        $amount = $row['Amount'];
    } else {
        // If no record is found, redirect with an error message
        echo "<script>alert('Error: No contribution found with this ID.'); window.location.href = 'coop_members_shared_capitals_contribution.php';</script>";
        exit();
    }
    
    $stmt_fetch->close();

    // Update the `Remarks` field instead of deleting the record
    $sql_update = "UPDATE shared_capital_amount SET Remarks = 'Deleted' WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("s", $membership_id);

    // Check if the update was successful
    if ($stmt_update->execute()) {
        // Log the update action
        $action = "Marked shared capital entry as Deleted for Membership ID: $membership_id";
        $details = json_encode([
            'membership_id' => $membership_id,
            'name_of_member' => $name_of_member,
            'amount' => $amount,
            'remarks' => 'Deleted'
        ]);
        logAction($conn, $userId, $username, $action, $details);

        // Success message and redirect
        echo "<script>alert('SC Member marked as deleted successfully!'); window.location.href = 'coop_members_shared_capitals_contribution.php';</script>";
    } else {
        // Log failure
        $error_message = "Error updating remarks for Membership ID: $membership_id.";
        logAction($conn, $userId, $username, $error_message, json_encode([
            'membership_id' => $membership_id,
            'error' => $stmt_update->error
        ]));

        // Error message and redirect
        echo "<script>alert('Error updating remarks. Please try again.'); window.location.href = 'coop_members_shared_capitals_contribution.php';</script>";
    }

    // Close the statement
    $stmt_update->close();
    $conn->close();
} else {
    // Invalid request handling
    echo "<script>alert('Invalid request.'); window.location.href = 'coop_members_shared_capitals_contribution.php';</script>";
}
?>
