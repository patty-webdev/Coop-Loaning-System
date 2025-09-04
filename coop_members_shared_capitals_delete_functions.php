<?php
include 'config/config.php'; // Include your database connection file
session_start(); // Start session to access session variables

// Check if the `id` parameter is set in the URL
if (isset($_GET['id'])) {
    $membership_id = $_GET['id'];

    // Ensure the user is logged in
    if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
        echo "<script>alert('Error: User not logged in.'); window.location.href = 'view_members.php';</script>";
        exit();
    }

    // Get the username and user ID from the session
    $username = $_SESSION['username'];
    $userId = $_SESSION['user_id'];

    // Fetch the member details before updating for logging
    $sql_fetch = "SELECT * FROM coop_members_shared_capital WHERE membership_id = ?";
    $stmt_fetch = $conn->prepare($sql_fetch);
    $stmt_fetch->bind_param("s", $membership_id);
    $stmt_fetch->execute();
    $result = $stmt_fetch->get_result();
    $member = $result->fetch_assoc();
    $stmt_fetch->close();

    if (!$member) {
        echo "<script>alert('Error: Membership ID not found.'); window.location.href = 'coop_members_shared_capitals.php';</script>";
        exit();
    }

    // Update the `Remarks` field instead of deleting
    $sql_update = "UPDATE coop_members_shared_capital SET remarks = 'Deleted' WHERE membership_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("s", $membership_id);

    if ($stmt_update->execute()) {
        // Log the action
        $action = "Marked a shared capital member as Deleted";
        $details = json_encode([
            'membership_id' => $membership_id,
            'name_of_member' => $member['name_of_member'],
            'date_added' => $member['Date_Added'],
            'remarks' => 'Deleted'
        ]);
        logAction($conn, $userId, $username, $action, $details);

        echo "<script>alert('SC Member marked as deleted successfully!'); window.location.href = 'coop_members_shared_capitals.php';</script>";
    } else {
        echo "<script>alert('Error updating member remarks. Please try again.'); window.location.href = 'coop_members_shared_capitals.php';</script>";
    }

    $stmt_update->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'view_members.php';</script>";
}
?>
