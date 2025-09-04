<?php
include 'config/config.php'; // Include your database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : 'regular_payment';
    
    if ($action === 'record_amortization_payment') {
        // Handle amortization schedule payment
        $schedule_id = $_POST['schedule_id'];
        $payment_amount = $_POST['payment_amount'];
        $payment_date = date('Y-m-d');
        
        // Check if the user is logged in
        if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
        
        $userId = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        
        // Get schedule details
        $scheduleQuery = "SELECT * FROM coop_loan_amortization_schedule WHERE id = ?";
        $stmt = $conn->prepare($scheduleQuery);
        $stmt->bind_param("i", $schedule_id);
        $stmt->execute();
        $scheduleResult = $stmt->get_result();
        
        if ($scheduleResult->num_rows > 0) {
            $schedule = $scheduleResult->fetch_assoc();
            $loan_id = $schedule['loan_id'];
            $membership_id = $schedule['membership_id'];
            
            // Update the amortization schedule
            $updateScheduleQuery = "UPDATE coop_loan_amortization_schedule SET amount_paid = ?, payment_status = 'paid', payment_date = ? WHERE id = ?";
            $updateStmt = $conn->prepare($updateScheduleQuery);
            $updateStmt->bind_param("dsi", $payment_amount, $payment_date, $schedule_id);
            
            if ($updateStmt->execute()) {
                // Record payment in the payments table
                $insertPaymentQuery = "INSERT INTO coop_member_loan_payments (loan_id, membership_id, payment_amount, OR_number, payment_date, remarks) VALUES (?, ?, ?, ?, ?, ?)";
                $paymentStmt = $conn->prepare($insertPaymentQuery);
                $or_number = 'AMORT-' . $schedule_id . '-' . date('Ymd');
                $remarks = 'Amortization Payment #' . $schedule['payment_number'];
                $paymentStmt->bind_param("isdsss", $loan_id, $membership_id, $payment_amount, $or_number, $payment_date, $remarks);
                $paymentStmt->execute();
                
                // Update loan balance
                $updateLoanQuery = "UPDATE coop_member_loans SET balance_amount = balance_amount - ? WHERE id = ?";
                $loanStmt = $conn->prepare($updateLoanQuery);
                $loanStmt->bind_param("di", $payment_amount, $loan_id);
                $loanStmt->execute();
                
                // Log the action
                $action = "Amortization payment recorded for Schedule ID: $schedule_id";
                $details = json_encode([
                    'schedule_id' => $schedule_id,
                    'loan_id' => $loan_id,
                    'membership_id' => $membership_id,
                    'payment_amount' => $payment_amount,
                    'payment_date' => $payment_date
                ]);
                logAction($conn, $userId, $username, $action, $details);
                
                // Redirect back to amortization calculator
                header("Location: loan/loan_amortization.php?success=1&message=" . urlencode("Payment recorded successfully"));
                exit();
            } else {
                header("Location: loan/loan_amortization.php?error=1&message=" . urlencode("Failed to record payment"));
                exit();
            }
        } else {
            header("Location: loan/loan_amortization.php?error=1&message=" . urlencode("Schedule not found"));
            exit();
        }
    } else {
        // Regular payment processing
        $loan_id = $_POST['loan_id'];
        $payment_amount = $_POST['payment_amount'];
        $OR_number = $_POST['OR_number'];
        $payment_date = $_POST['payment_date'];

    // Check if the user is logged in
    if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
        header("Location: login.php"); // Redirect if not logged in
        exit(); 
    }

    $userId = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    // Validate input
    if (!empty($loan_id) && !empty($payment_amount) && !empty($OR_number) && !empty($payment_date)) {
        // Fetch the membership_id using the loan_id
        $membershipQuery = "SELECT membership_id FROM coop_member_loans WHERE id = '$loan_id'";
        $result = $conn->query($membershipQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $membership_id = $row['membership_id'];

            // Insert payment into the payments table
            $sql = "INSERT INTO coop_member_loan_payments (loan_id, membership_id, payment_amount, OR_number, payment_date) 
                    VALUES ('$loan_id', '$membership_id', '$payment_amount', '$OR_number', '$payment_date')";

            if ($conn->query($sql) === TRUE) {
                // Update the loan's remaining balance
                $updateLoanSql = "UPDATE coop_member_loans 
                                  SET balance_amount = balance_amount - $payment_amount 
                                  WHERE id = '$loan_id'";
                $conn->query($updateLoanSql);

                // Log the action
                $action = "Payment recorded for Loan ID: $loan_id";
                $details = json_encode([
                    'loan_id' => $loan_id,
                    'membership_id' => $membership_id,
                    'payment_amount' => $payment_amount,
                    'OR_number' => $OR_number,
                    'payment_date' => $payment_date
                ]);
                logAction($conn, $userId, $username, $action, $details);

                // Redirect with success message
                header("Location: coop_members_loan.php?success=1&message=" . urlencode("Payment recorded successfully"));
                exit();
            } else {
                // Log the failure
                $action = "Failed to record payment for Loan ID: $loan_id";
                $details = json_encode([
                    'loan_id' => $loan_id,
                    'error' => $conn->error
                ]);
                logAction($conn, $userId, $username, $action, $details);

                // Redirect with error message
                header("Location: coop_members_loan.php?error=1&message=" . urlencode("Failed to record payment"));
                exit();
            }
        } else {
            // Log the failure
            $action = "Loan ID not found: $loan_id";
            $details = json_encode([
                'loan_id' => $loan_id,
                'message' => 'Loan ID not found in the system.'
            ]);
            logAction($conn, $userId, $username, $action, $details);

            // Redirect with error message
            header("Location: coop_members_loan.php?error=1&message=" . urlencode("Loan ID not found"));
            exit();
        }
    } else {
        // Log the failure due to missing fields
        $action = "Failed to record payment due to missing fields";
        $details = json_encode([
            'loan_id' => $loan_id,
            'payment_amount' => $payment_amount,
            'payment_reference' => $payment_reference,
            'payment_date' => $payment_date
        ]);
        logAction($conn, $userId, $username, $action, $details);

        // Redirect with error message
        header("Location: coop_members_loan.php?error=1&message=" . urlencode("All fields are required"));
        exit();
    }

    $conn->close();
    }
}
?>
