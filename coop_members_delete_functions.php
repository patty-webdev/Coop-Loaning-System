<?php
include 'config/config.php'; // Include your database connection file
session_start(); // Start session to access user information

if (isset($_GET['id'])) {
    $membership_id = $_GET['id'];

    // Ensure the user is logged in
    if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
        $error_message = 'Error: User not logged in.';
        header("Location: coop_members.php?error=1&message=" . urlencode($error_message));
        exit();
    }

    // Get the username and user ID from the session
    $username = $_SESSION['username'];
    $userId = $_SESSION['user_id'];

    // Begin a transaction
    $conn->begin_transaction();

    try {
        // Update remarks in coop_members_shared_capital
        $sql_update_shared_capital = "UPDATE coop_members_shared_capital SET Remarks = 'Deleted' WHERE Membership_ID = ?";
        $stmt_update_shared_capital = $conn->prepare($sql_update_shared_capital);
        $stmt_update_shared_capital->bind_param("s", $membership_id);
        $stmt_update_shared_capital->execute();

        // Update remarks in coop_members
        $sql_update_members = "UPDATE coop_members SET Remarks = 'Deleted' WHERE membership_id = ?";
        $stmt_update_members = $conn->prepare($sql_update_members);
        $stmt_update_members->bind_param("s", $membership_id);
        $stmt_update_members->execute();

        // Commit the transaction
        $conn->commit();

        // Log the deletion action
        $action = "Marked member and associated shared capital data as Deleted";
        $details = json_encode([
            'membership_id' => $membership_id
        ]);
        logAction($conn, $userId, $username, $action, $details);

        echo "<script>alert('Member marked as deleted successfully!'); window.location.href = 'coop_members.php';</script>";
    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();
        echo "<script>alert('Error updating member status. Please try again.'); window.location.href = 'coop_members.php';</script>";
    }

    $stmt_update_shared_capital->close();
    $stmt_update_members->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'coop_members.php';</script>";
}
?>
