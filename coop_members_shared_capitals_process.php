<?php
// Database connection
include 'config/config.php';
session_start(); // Start the session to access session variables

// Initialize variables
$Membership_ID = '';
$Date_Added = '';
$error_message = '';
$success_message = '';

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $Membership_ID = $_POST['Membership_ID'];
    $Date_Added = $_POST['Date_Added'];

    // Ensure the user is logged in and retrieve their username and user ID
    if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
        $error_message = "Error: User not logged in.";
    } else {
        $username = $_SESSION['username'];
        $userId = $_SESSION['user_id'];

        // Check if the provided Membership ID exists in coop_members table
        $sql_check_membership = "SELECT name_of_member, status FROM coop_members WHERE Membership_ID = ?";
        if ($stmt_check_membership = $conn->prepare($sql_check_membership)) {
            $stmt_check_membership->bind_param("s", $Membership_ID);
            $stmt_check_membership->execute();
            $result_membership = $stmt_check_membership->get_result();
            $row_membership = $result_membership->fetch_assoc();

            if (!$row_membership) {
                $error_message = "Error: Invalid Membership ID. Please enter a valid Membership ID.";
            } elseif ($row_membership['status'] != 1) {
                $error_message = "Error: The member's status is not active. Only active members can be added to the shared capital.";
            } else {
                $name_of_member = $row_membership['name_of_member'];

                // Check for duplicate Membership ID in coop_members_shared_capital
                $sql_check_duplicate = "SELECT * FROM coop_members_shared_capital WHERE Membership_ID = ?";
                if ($stmt_check_duplicate = $conn->prepare($sql_check_duplicate)) {
                    $stmt_check_duplicate->bind_param("s", $Membership_ID);
                    $stmt_check_duplicate->execute();
                    $result_duplicate = $stmt_check_duplicate->get_result();

                    if ($result_duplicate->num_rows > 0) {
                        $error_message = "Error: Membership ID already exists in the shared capital records.";
                    } else {
                        // Insert record into coop_members_shared_capital
                        $sql = "INSERT INTO coop_members_shared_capital (Membership_ID, name_of_member, Date_Added, status) VALUES (?, ?, ?, 1)";
                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->bind_param("sss", $Membership_ID, $name_of_member, $Date_Added);
                            if ($stmt->execute()) {
                                $success_message = "The shared capital member has been successfully added.";

                                // Log the action to system_logs
                                $action = "Added a member to shared capital";
                                $details = json_encode([
                                    'Membership_ID' => $Membership_ID,
                                    'name_of_member' => $name_of_member,
                                    'Date_Added' => $Date_Added
                                ]);
                                logAction($conn, $userId, $username, $action, $details);
                            } else {
                                $error_message = "Error: " . $conn->error;
                            }
                            $stmt->close();
                        }
                    }
                    $stmt_check_duplicate->close();
                }
            }

            $stmt_check_membership->close();
        }
    }

    // Close database connection
    $conn->close();

    // Redirect with messages
    if ($error_message) {
        header("Location: coop_members_shared_capitals.php?error=1&message=" . urlencode($error_message));
        exit();
    } elseif ($success_message) {
        header("Location: coop_members_shared_capitals.php?success=1&message=" . urlencode($success_message));
        exit();
    }
}
?>
