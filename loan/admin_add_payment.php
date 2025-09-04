<?php
$conn = new mysqli("localhost", "root", "", "loan_system");
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['amount_paid'])) {
    // This block runs AFTER payment form is submitted
    $loanId = $_POST['loan_id'];
    $scheduleId = $_POST['schedule_id'];
    $amount = $_POST['amount_paid'];
    $date = $_POST['date_paid'];
    $remarks = $_POST['remarks'];

    $stmt = $conn->prepare("INSERT INTO payments (loan_id, schedule_id, amount_paid, date_paid, remarks) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $loanId, $scheduleId, $amount, $date, $remarks);
    
    if ($stmt->execute()) {
        echo "<p>✅ Payment recorded successfully!</p>";
    } else {
        echo "<p>❌ Error saving payment: " . $stmt->error . "</p>";
    }

    echo "<a href='javascript:history.back()'>← Back</a>";
    exit;
}

// Show the payment form
$loanId = $_POST['loan_id'] ?? null;
$scheduleId = $_POST['schedule_id'] ?? null;

if (!$loanId || !$scheduleId) {
    echo "<p>❌ Missing loan or schedule ID.</p>";
    exit;
}
?>

<h3>Add Payment</h3>
<form method="POST">
    <input type="hidden" name="loan_id" value="<?= $loanId ?>">
    <input type="hidden" name="schedule_id" value="<?= $scheduleId ?>">

    <label>Amount Paid: <input type="number" name="amount_paid" step="0.01" required></label><br><br>
    <label>Date Paid: <input type="date" name="date_paid" required></label><br><br>
    <label>Remarks: <textarea name="remarks"></textarea></label><br><br>

    <input type="submit" value="Save Payment">
</form>
