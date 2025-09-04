<?php
// Database connection (adjust as per your configuration)
include_once 'config/config.php';
session_start(); // Start session to access user information


// Variables to hold messages
$alert = '';
$errors = [];
$skipped_rows = [];

// Check if a CSV file is uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) {
    // Ensure the user is logged in
    if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
        $alert = 'Error: User not logged in.';
        header("Location: coop_members_shared_capitals.php?error=1&message=" . urlencode($alert));
        exit();
    }

    // Get the username and user ID from the session
    $username = $_SESSION['username'];
    $userId = $_SESSION['user_id'];

    $csv_file = $_FILES['csv_file']['tmp_name'];

    // Validate and process the CSV file
    if (($handle = fopen($csv_file, "r")) !== FALSE) {
        // Assume the first row contains headers
        $headers = fgetcsv($handle, 1000, ",");

        // Validate headers
        $expected_headers = ['Membership ID', 'Name of Member', 'Date Added', 'Status'];
        if ($headers !== $expected_headers) {
            fclose($handle);
            $alert = 'Invalid CSV file format.';
            header("Location: coop_members_shared_capitals.php?error=1&message=" . urlencode($alert));
            exit;
        }

        // Process valid rows
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $membership_id = trim($data[0]);
            $name_of_member = trim($data[1]);
            $date_added = trim($data[2]);
            $status = trim($data[3]);

            // Check if Membership ID is empty
            if (empty($membership_id)) {
                $errors[] = "Membership ID is empty for one or more rows. Data cannot be processed.";
                break; // Stop processing further rows
            }

            // Check if Membership ID already exists
            $check_query = "SELECT COUNT(*) as count FROM coop_members_shared_capital WHERE Membership_ID = ?";
            $stmt = $conn->prepare($check_query);
            $stmt->bind_param("s", $membership_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row['count'] > 0) {
                $skipped_rows[] = $membership_id;
                continue; // Skip this record
            }

            // Insert into database
            $sql = "INSERT INTO coop_members_shared_capital (Membership_ID, name_of_member, Date_Added, status)
                    VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql);
            $stmt_insert->bind_param("sssi", $membership_id, $name_of_member, $date_added, $status);

            if (!$stmt_insert->execute()) {
                $errors[] = "Error inserting row with Membership ID: $membership_id - " . $stmt_insert->error;
            }
        }

        fclose($handle);

        // Log the action
        $action = "Imported CSV file for shared capital";
        $details = json_encode([
            'file_name' => $_FILES['csv_file']['name'],
            'total_skipped' => count($skipped_rows),
            'total_errors' => count($errors),
        ]);
        logAction($conn, $userId, $username, $action, $details);

        // Redirect after processing
        if (empty($errors) && empty($skipped_rows)) {
            header("Location: coop_members_shared_capitals.php?success=1&message=" . urlencode("CSV file imported successfully."));
        } else {
            $error_message = implode('<br>', $errors);
            if (!empty($skipped_rows)) {
                $error_message .= " Skipped Membership IDs due to duplication: " . implode(", ", $skipped_rows);
            }
            header("Location: coop_members_shared_capitals.php?error=1&message=" . urlencode($error_message));
        }
        exit;
    } else {
        $alert = 'Error opening the CSV file.';
        header("Location: coop_members_shared_capitals.php?error=1&message=" . urlencode($alert));
        exit;
    }
}
?>
