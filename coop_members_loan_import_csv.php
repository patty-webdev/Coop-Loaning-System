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
        header("Location: coop_members_loan.php?error=1&message=" . urlencode($alert));
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
        $expected_headers = ['Membership ID', 'Name', 'Type of Loan', 'Loan Amount', 'Term', 'Reference Number', 'Payment Date', 'Date of Loan', 'Insurance Premium', 'Co-makers', 'Birthday of Member', 'Rate', 'Monthly Payment', 'Created At'];
        if ($headers !== $expected_headers) {
            fclose($handle);
            $alert = 'Invalid CSV file format.';
            header("Location: coop_members_loan.php?error=1&message=" . urlencode($alert));
            exit;
        }

        // Process valid rows
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Extract values from the CSV columns
            $membership_id = trim($data[0]);
            $name = trim($data[1]);
            $type_of_loan = trim($data[2]);
            $loan_amount = trim($data[3]);
            $term = trim($data[4]);
            $reference_number = trim($data[5]);
            $payment_date = trim($data[6]);
            $date_of_loan = trim($data[7]);
            $insurance_premium = trim($data[8]);
            $co_makers = trim($data[9]);
            $birthday_of_member = trim($data[10]);
            $rate = trim($data[11]);
            $monthly_payment = trim($data[12]);
            $created_at = trim($data[13]);

            // Check if Membership ID is empty
            if (empty($membership_id)) {
                $errors[] = "Membership ID is empty for one or more rows. Data cannot be processed.";
                break; // Stop processing further rows
            }

            // Insert into database
            $sql = "INSERT INTO coop_member_loans (membership_id, name, type_of_loan, loan_amount, term, reference_number, payment_date, date_of_loan, insurance_premium, co_makers, birthday_of_member, rate, monthly_payment, created_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql);
            $stmt_insert->bind_param("ssssssssssssss", $membership_id, $name, $type_of_loan, $loan_amount, $term, $reference_number, $payment_date, $date_of_loan, $insurance_premium, $co_makers, $birthday_of_member, $rate, $monthly_payment, $created_at);

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
            header("Location: coop_members_loan.php?success=1&message=" . urlencode("CSV file imported successfully."));
        } else {
            $error_message = implode('<br>', $errors);
            if (!empty($skipped_rows)) {
                $error_message .= " Skipped Membership IDs due to duplication: " . implode(", ", $skipped_rows);
            }
            header("Location: coop_members_loan.php?error=1&message=" . urlencode($error_message));
        }
        exit;
    } else {
        $alert = 'Error opening the CSV file.';
        header("Location: coop_members_loan.php?error=1&message=" . urlencode($alert));
        exit;
    }
}
?>
