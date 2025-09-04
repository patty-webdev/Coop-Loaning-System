<?php
// Include database configuration
include_once 'config/config.php';

// Check if an ID is provided
if (isset($_GET['coop_id'])) {
    $membership_id = $_GET['coop_id'];

    // Fetch current status of the member
    $sql = "SELECT status FROM coop_members WHERE membership_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $membership_id);
    $stmt->execute();   
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {    
        $row = $result->fetch_assoc();
        $current_status = $row['status'];

        // Toggle status
        $new_status = ($current_status == 0) ? 1 : 0;

        // Update the status in the coop_members table
        $update_sql = "UPDATE coop_members SET status = ? WHERE membership_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("is", $new_status, $membership_id);
        $update_stmt->execute();

        // Update the status in the coop_members_shared_capital table
        $update_shared_sql = "UPDATE coop_members_shared_capital SET status = ? WHERE Membership_ID = ?";
        $update_shared_stmt = $conn->prepare($update_shared_sql);
        $update_shared_stmt->bind_param("is", $new_status, $membership_id);
        $update_shared_stmt->execute();

        // Redirect back to the members list with a success message
        header("Location: coop_members.php?status_updated=true");
    } else {
        echo "Member not found.";
    }
} else {
    echo "Invalid request.";
}
?>
