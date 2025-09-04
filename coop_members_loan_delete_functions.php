<?php
include 'config/config.php'; // Include your database connection file
session_start(); // Start session to access session variables

// Check if the `id` parameter is set in the URL
if (isset($_GET['id'])) {
    $loan_id = $_GET['id'];

    // Ensure the user is logged in
    if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
        echo "<script>alert('Error: User not logged in.'); window.location.href = 'coop_members_loans.php';</script>";
        exit();
    }

    // Get the username and user ID from the session
    $username = $_SESSION['username'];
    $userId = $_SESSION['user_id'];

    // Fetch loan details before updating for logging
    $sql_fetch = "SELECT * FROM coop_member_loans WHERE id = ?";
    $stmt_fetch = $conn->prepare($sql_fetch);
    $stmt_fetch->bind_param("i", $loan_id);
    $stmt_fetch->execute();
    $result = $stmt_fetch->get_result();
    $loan = $result->fetch_assoc();
    $stmt_fetch->close();

    if (!$loan) {
        echo "<script>alert('Error: Loan ID not found.'); window.location.href = 'coop_members_loans.php';</script>";
        exit();
    }

    // Update the `Remarks` field instead of deleting
    $sql_update = "UPDATE coop_member_loans SET remarks = 'Deleted' WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("i", $loan_id);

    if ($stmt_update->execute()) {
        // Log the action
        $action = "Marked a loan record as Deleted";
        $details = json_encode([
            'loan_id' => $loan_id,
            'membership_id' => $loan['membership_id'],
            'name' => $loan['name'],
            'loan_amount' => $loan['loan_amount'],
            'date_of_loan' => $loan['date_of_loan'],
            'remarks' => 'Deleted'
        ]);
        logAction($conn, $userId, $username, $action, $details);

        echo "<script>alert('Loan marked as deleted successfully!'); window.location.href = 'coop_members_loan.php';</script>";
    } else {
        echo "<script>alert('Error updating loan remarks. Please try again.'); window.location.href = 'coop_members_loan.php';</script>";
    }

    $stmt_update->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'coop_members_loan.php';</script>";
}
?>
