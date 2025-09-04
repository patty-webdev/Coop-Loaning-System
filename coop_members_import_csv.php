<?php
// Database connection (adjust as per your configuration)
include_once 'config/config.php';
session_start(); // Start session to access user information

// Function to generate a unique membership ID
function generateMembershipID($conn) {
    $prefix = 'HFMPC';
    $numbers = '0123456789';

    do {
        $last_five = '';
        for ($i = 0; $i < 5; $i++) {
            $last_five .= $numbers[rand(0, strlen($numbers) - 1)];
        }

        $membership_id = $prefix . $last_five;

        // Check if the generated ID already exists in the database
        $sql_check = "SELECT COUNT(*) as count FROM coop_members WHERE membership_id = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $membership_id);
        $stmt_check->execute();
        $result = $stmt_check->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] == 0) {
            break; // Unique ID found
        }
    } while (true);

    return $membership_id;
}

// Variables to hold messages
$alert = '';
$errors = [];
$skipped_rows = [];

// Define the regex pattern for the membership ID format
$membership_id_pattern = "/^HFMDC\d{5}$/";

// Check if a CSV file is uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) {
    // Ensure the user is logged in
    if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
        $alert = 'Error: User not logged in.';
        header("Location: coop_members.php?error=1&message=" . urlencode($alert));
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
        $expected_headers = ['Membership ID', 'Name of Member', 'Contact Number', 'TIN', 'Date Accepted', 'BOD Resolution Number', 'Type of Membership', 'Shares Subscribed', 'Amount Subscribed', 'Initial Paid-Up', 'Address', 'Date of Birth', 'Age', 'Gender', 'Civil Status', 'Highest Educational Attainment', 'Occupation', 'Number of Dependents', 'Religious', 'Annual Income'];
        if ($headers !== $expected_headers) {
            fclose($handle);
            $alert = 'Invalid CSV file format.';
            header("Location: coop_members.php?error=1&message=" . urlencode($alert));
            exit;
        }

        // Check for any invalid membership_id format in the CSV
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $membership_id = trim($data[0]);

            // If Membership ID is empty or invalid, stop the process and show an error
            if (empty($membership_id)) {
                $membership_id = generateMembershipID($conn);
            } elseif (!preg_match($membership_id_pattern, $membership_id)) {
                $errors[] = "Invalid Membership ID format: $membership_id";
                break; // Stop the processing if any invalid membership_id is found
            }
        }

        // If there are format errors, stop further processing and show the error
        if (!empty($errors)) {
            fclose($handle);
            $error_message = implode('<br>', $errors);
            header("Location: coop_members.php?error=1&message=" . urlencode($error_message));
            exit;
        }

        // Reopen the file to process valid rows
        rewind($handle);

        // Skip the header row again since we already validated it
        fgetcsv($handle, 1000, ",");

        // Process valid rows
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $membership_id = trim($data[0]);

            // Generate new membership ID if empty
            if (empty($membership_id)) {
                $membership_id = generateMembershipID($conn);
            }

            // Check if Membership ID already exists
            $check_query = "SELECT COUNT(*) as count FROM coop_members WHERE membership_id = ?";
            $stmt = $conn->prepare($check_query);
            $stmt->bind_param("s", $membership_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row['count'] > 0) {
                $skipped_rows[] = $membership_id;
                continue; // Skip this record
            }

            // Map CSV data to database columns
            $name_of_member = $data[1];
            $contact_number = $data[2];
            $tin = $data[3];
            $date_accepted = $data[4];
            $bod_resolution = $data[5];
            $type_of_membership = $data[6];
            $shares_subscribed = $data[7];
            $amount_subscribed = $data[8];
            $initial_paid_up = $data[9];
            $address = $data[10];
            $date_of_birth = $data[11];
            $age = $data[12];
            $gender = $data[13];
            $civil_status = $data[14];
            $educational_attainment = $data[15];
            $occupation = $data[16];
            $number_of_dependents = $data[17];
            $religious = $data[18];
            $annual_income = $data[19];
            $status = 1; // Set status to 1

            // Insert into database
            $sql = "INSERT INTO coop_members (membership_id, name_of_member, contact_number, tin, date_accepted, bod_resolution, type_of_membership, shares_subscribed, amount_subscribed, initial_paid_up, address, date_of_birth, age, gender, civil_status, educational_attainment, occupation, number_of_dependents, religious, annual_income, status)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql);
            $stmt_insert->bind_param("sssssssidissississsis", 
                $membership_id, $name_of_member, $contact_number, $tin, $date_accepted, $bod_resolution, $type_of_membership, $shares_subscribed, $amount_subscribed, $initial_paid_up, $address, $date_of_birth, $age, $gender, $civil_status, $educational_attainment, $occupation, $number_of_dependents, $religious, $annual_income, $status);

            if (!$stmt_insert->execute()) {
                $errors[] = "Error inserting row with Membership ID: $membership_id - " . $stmt_insert->error;
            } else {
                // Also insert into shared capital table
                $date_added = date('Y-m-d');
                $status_shared = 1;
                $sql_shared = "INSERT INTO coop_members_shared_capital (Membership_ID, name_of_member, Date_Added, status) VALUES (?, ?, ?, ?)";
                $stmt_shared = $conn->prepare($sql_shared);
                $stmt_shared->bind_param("sssi", $membership_id, $name_of_member, $date_added, $status_shared);
                $stmt_shared->execute();
            }
        }

        fclose($handle);

        // Log the action
        $action = "Imported CSV file for coop members";
        $details = json_encode([
            'file_name' => $_FILES['csv_file']['name'],
            'total_skipped' => count($skipped_rows),
            'total_errors' => count($errors),
        ]);
        logAction($conn, $userId, $username, $action, $details);

        // Redirect after processing
        if (empty($errors) && empty($skipped_rows)) {
            header("Location: coop_members.php?success=1&message=" . urlencode("CSV file imported successfully."));
        } else {
            $error_message = implode('<br>', $errors);
            if (!empty($skipped_rows)) {
                $error_message .= " Skipped Membership IDs due to duplication: " . implode(", ", $skipped_rows);
            }
            header("Location: coop_members.php?error=1&message=" . urlencode($error_message));
        }
        exit;
    } else {
        $alert = 'Error opening the CSV file.';
        header("Location: coop_members.php?error=1&message=" . urlencode($alert));
        exit;
    }
}
?>
