<?php
// Database connection
include 'config/config.php';
session_start();

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data (sanitize inputs if necessary)
    $membership_id = $_POST['membership_id'];
    $type_of_loan = $_POST['type_of_loan'];
    $loan_amount = $_POST['loan_amount'];
    $balance_amount = $_POST['loan_amount'];
    $term = $_POST['term'];
    $OR_number = $_POST['OR_number'];
    $payment_date = $_POST['payment_date'];
    $date_of_loan = $_POST['date_of_loan'];
    $insurance_premium = $_POST['insurance_premium'];
    $co_makers = $_POST['co_makers'];
    $birthday_of_member = $_POST['birthday_of_member'];
    $rate = $_POST['rate'];
    $monthly_payment = $_POST['monthly_payment'];
    $created_at = date("Y-m-d H:i:s"); // current timestamp for created_at

    // Check if user is logged in
    if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
        header("Location: login.php"); // Redirect if not logged in
        exit();
    }

    $userId = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    // Fetch the name based on membership_id
    $sql_fetch_name = "SELECT name_of_member FROM coop_members WHERE membership_id = ?";
    $stmt_fetch = $conn->prepare($sql_fetch_name);
    $stmt_fetch->bind_param("s", $membership_id);
    $stmt_fetch->execute();
    $result = $stmt_fetch->get_result();

    if ($result->num_rows > 0) {
        // Fetch the name
        $row = $result->fetch_assoc();
        $name = $row['name_of_member'];
    } else {
        // Membership ID not found

        // Log failure
        $action = "Failed to create loan record - Membership ID not found.";
        $details = json_encode([
            'membership_id' => $membership_id,
            'message' => 'Membership ID not found in the system.'
        ]);
        logAction($conn, $userId, $username, $action, $details);

        // Redirect with error message
        header("Location: coop_members_loan.php?error=1&message=" . urlencode("Membership ID not found in the system. Please check and try again."));
        exit();
    }

    $stmt_fetch->close();

    // Prepare SQL insert statement
    $sql_insert = "INSERT INTO coop_member_loans (membership_id, name, type_of_loan, loan_amount, balance_amount, term, OR_number, payment_date, date_of_loan, insurance_premium, co_makers, birthday_of_member, rate, monthly_payment, created_at) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("sssssssssssssss",
        $membership_id,
        $name,
        $type_of_loan,
        $loan_amount,
        $balance_amount,
        $term,
        $OR_number,
        $payment_date,
        $date_of_loan,
        $insurance_premium,
        $co_makers,
        $birthday_of_member,
        $rate,
        $monthly_payment,
        $created_at
    );

    // Execute the statement
    if ($stmt_insert->execute()) {
        // Log the successful loan record creation
        $action = "Created loan record successfully for Membership ID: $membership_id";
        $details = json_encode([
            'membership_id' => $membership_id,
            'name' => $name,
            'loan_amount' => $loan_amount,
            'payment_date' => $payment_date
        ]);
        logAction($conn, $userId, $username, $action, $details);

        // Success message and redirection
        header("Location: coop_members_loan.php?success=1&message=" . urlencode("Loan record created successfully"));
        exit();
    } else {
        // Log failure
        $error_message = "Error: " . $stmt_insert->error;
        $action = "Failed to create loan record for Membership ID: $membership_id.";
        $details = json_encode([
            'membership_id' => $membership_id,
            'error' => $stmt_insert->error
        ]);
        logAction($conn, $userId, $username, $action, $details);

        // Error message if insertion fails
        header("Location: coop_members_loan.php?error=1&message=" . urlencode($error_message));
        exit();
    }

    // Close the statement and connection
    $stmt_insert->close();
    $conn->close();
}
?>
