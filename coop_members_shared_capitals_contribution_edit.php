<?php
include('config/config.php');
session_start(); // Start session to access user information

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['Amount']) && isset($_POST['particulars']) && isset($_POST['Date_Paid'])) {
        // Get the form data
        $id = $_POST['id'];
        $amount = $_POST['Amount'];
        $particulars = $_POST['particulars'];
        $datePaid = $_POST['Date_Paid'];

        // Ensure user is logged in
        if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
            echo "User not logged in!";
            exit();
        }

        // Fetch the logged-in user's username and user ID
        $username = $_SESSION['username'];
        $userId = $_SESSION['user_id'];

        // SQL query to update the contribution
        $sql = "UPDATE shared_capital_amount SET Amount = ?, particulars = ?, Date_Paid = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("dssi", $amount, $particulars, $datePaid, $id);

        if ($stmt->execute()) {
            // Log the successful update
            $details = json_encode([
                'Contribution_ID' => $id,
                'Amount' => $amount,
                'Particulars' => $particulars,
                'Date_Paid' => $datePaid
            ]);
            logAction($conn, $userId, $username, "Contribution updated successfully", $details);

            // Redirect with success message
            header("Location: coop_members_shared_capitals_contribution.php?success=1&message=" . urlencode("Contribution update successfully."));
        } else {
            // Log the failed update attempt
            $details = json_encode([
                'Error_Message' => $stmt->error
            ]);
            logAction($conn, $userId, $username, "Failed to update contribution", $details);

            // Redirect with error message
            header("Location: coop_members_shared_capitals_contribution.php?error=1&message=" . urlencode("Failed to update contribution"));
        }

        $stmt->close();
    }
}
?>
