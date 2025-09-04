<?php
// Include database connection
include 'config/config.php';
session_start();

// Initialize variables
$error_message = '';
$Name = '';

// Function to fetch member's name based on Membership_ID
function fetchMemberName($Membership_ID, $conn) {
    $sql = "SELECT name_of_member FROM coop_members WHERE Membership_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Membership_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['name_of_member'];
    } else {
        return null;
    }

    $stmt->close();
}

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $id = $_POST['id'];
    $Amount = $_POST['Amount'];
    $Date_Paid = $_POST['Date_Paid'];
    $particulars = $_POST['particulars'];

    // Ensure user is logged in
    if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
        echo "User not logged in!";
        exit();
    }

    // Fetch the logged-in user's username and user ID
    $username = $_SESSION['username'];
    $userId = $_SESSION['user_id'];

    // Validate Amount (check if it is a positive number)
    if (!is_numeric($Amount) || $Amount <= 0) {
        $error_message = "Amount must be a positive number.";

        // Log invalid amount attempt
        $details = json_encode([
            'Invalid_Amount' => $Amount,
            'Reason' => 'Amount must be a positive number.'
        ]);
        logAction($conn, $userId, $username, "Failed to add shared capital due to invalid amount", $details);
    } else {
        // Fetch Membership_ID using the id from coop_members_shared_capital
        $fetch_membership_sql = "SELECT Membership_ID FROM coop_members_shared_capital WHERE id = ?";
        $fetch_stmt = $conn->prepare($fetch_membership_sql);
        $fetch_stmt->bind_param("s", $id);
        $fetch_stmt->execute();
        $fetch_result = $fetch_stmt->get_result();

        if ($fetch_result->num_rows > 0) {
            // If the id exists, fetch the Membership_ID
            $row = $fetch_result->fetch_assoc();
            $Membership_ID = $row['Membership_ID'];

            // Fetch member's name using the Membership_ID
            $Name = fetchMemberName($Membership_ID, $conn);

            // Insert the shared capital amount with the fetched Membership_ID and Name
            $sql = "INSERT INTO shared_capital_amount (Membership_ID, Name, Amount, particulars, Date_Paid) 
                    VALUES (?, ?, ?, ?, ?) 
                    ON DUPLICATE KEY UPDATE Amount = VALUES(Amount), particulars = VALUES(particulars), Date_Paid = VALUES(Date_Paid)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $Membership_ID, $Name, $Amount,$particulars, $Date_Paid);

            // Execute the statement
            if ($stmt->execute()) {
                // Log the successful contribution
                $details = json_encode([
                    'Membership_ID' => $Membership_ID,
                    'Name' => $Name,
                    'Amount' => $Amount,
                    'particulars' => $particulars,
                    'Date_Paid' => $Date_Paid
                ]);
                logAction($conn, $userId, $username, "Contribution added successfully", $details);
                
                // Redirect to view page after successful insertion or update with success message
                header("Location: coop_members_shared_capitals_contribution.php?success=1&message=" . urlencode("Contribution added successfully."));
                exit();
            } else {
                // Handle errors
                $error_message = "Error: " . $stmt->error;

                // Log error during insertion
                $details = json_encode([
                    'Error_Message' => $stmt->error
                ]);
                logAction($conn, $userId, $username, "Failed to add contribution", $details);
            }

            // Close the statement
            $stmt->close();
        } else {
            $error_message = "Error: ID does not exist in COOP MEMBERS SHARED CAPITAL.";

            // Log failed attempt to find Membership ID
            $details = json_encode([
                'Provided_ID' => $id,
                'Error' => 'Membership ID does not exist in the database.'
            ]);
            logAction($conn, $userId, $username, "Failed to find Membership ID", $details);
        }

        // Close the fetch statement
        $fetch_stmt->close();
    }
}

// Close the database connection
$conn->close();
?>
