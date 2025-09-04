<?php
// Include the database connection
include 'config/config.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated values from the form
    $data = [
        $_POST['name_of_member'],
        $_POST['contact_number'],
        $_POST['tin'],
        $_POST['date_accepted'],
        $_POST['bod_resolution'],
        $_POST['civil_status'],
        $_POST['occupation'],
        $_POST['number_of_dependents'],
        $_POST['type_of_membership'],
        $_POST['shares_subscribed'],
        $_POST['amount_subscribed'],
        $_POST['initial_paid_up'],
        $_POST['address'],
        $_POST['date_of_birth'],
        $_POST['age'],
        $_POST['gender'],
        $_POST['religious'],
        $_POST['annual_income'],
        $_POST['coop_id']
    ];

    // Define the types for bind_param
    $types = 'sssssssssssssssssdi';

    // Check if user is logged in
    if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
        header("Location: login.php"); // Redirect if not logged in
        exit();
    }

    $userId = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    // Prepare the SQL query to update the member data
    $sql = "UPDATE coop_members 
            SET name_of_member = ?, contact_number = ?, tin = ?, date_accepted = ?, bod_resolution = ?, civil_status = ?, occupation = ?, number_of_dependents = ?, type_of_membership = ?, shares_subscribed = ?, amount_subscribed = ?, initial_paid_up = ?, address = ?, date_of_birth = ?, age = ?, gender = ?, religious = ?, annual_income = ? 
            WHERE coop_id = ?";

    // Prepare the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        // Dynamically bind parameters
        $stmt->bind_param($types, ...$data);

        // Execute the query
        if ($stmt->execute()) {
            // Log the successful update
            $action = "Updated member details for Coop ID: " . $_POST['coop_id'];
            $details = json_encode([
                'coop_id' => $_POST['coop_id'],
                'updated_data' => [
                    'name_of_member' => $_POST['name_of_member'],
                    'contact_number' => $_POST['contact_number'],
                    'address' => $_POST['address']
                    // You can add other fields here as needed
                ]
            ]);
            logAction($conn, $userId, $username, $action, $details);

            // Success message and redirection
            header("Location: coop_members.php?success=1&message=Member updated successfully.");
        } else {
            // Log the error (failed update)
            $action = "Failed to update member details for Coop ID: " . $_POST['coop_id'];
            $details = json_encode([
                'coop_id' => $_POST['coop_id'],
                'error' => $stmt->error
            ]);
            logAction($conn, $userId, $username, $action, $details);

            // Error message and redirection
            header("Location: coop_members.php?error=1&message=Failed to update member.");
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Log the database error
        $action = "Database error when trying to update member details for Coop ID: " . $_POST['coop_id'];
        $details = json_encode([
            'coop_id' => $_POST['coop_id'],
            'error' => $conn->error
        ]);
        logAction($conn, $userId, $username, $action, $details);

        // Error message and redirection
        header("Location: coop_members.php?error=1&message=Database error.");
    }

    // Close the database connection
    $conn->close();
}
?>
