<?php
// add_partial_payment.php
$conn = new mysqli("localhost", "root", "", "loan_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $schedule_id = (int) ($_POST['schedule_id'] ?? 0);
    $loan_id = (int) ($_POST['loan_id'] ?? 0);

    // Get amortization info
    $schedule = $conn->query("SELECT * FROM amortization_schedule WHERE id = $schedule_id");
    $row = $schedule->fetch_assoc();
    $dueAmount = (float) $row['amortization'];

    // Get total paid so far
    $paidQuery = $conn->query("SELECT SUM(amount_paid) as total_paid FROM payments WHERE schedule_id = $schedule_id");
    $paidData = $paidQuery->fetch_assoc();
    $totalPaid = (float) $paidData['total_paid'];

    $remaining = $dueAmount - $totalPaid;

    // Handle new payment
    if (isset($_POST['amount_paid'], $_POST['date_paid'])) {
        $amount_paid = (float) $_POST['amount_paid'];
        $date_paid = $_POST['date_paid'];
        $remarks = $_POST['remarks'] ?? '';

        if ($amount_paid <= 0) {
            echo "<p style='color:red;'>❌ Invalid payment amount.</p>";
        } elseif ($amount_paid > $remaining) {
            echo "<p style='color:red;'>❌ Payment exceeds remaining balance (₱" . number_format($remaining, 2) . ").</p>";
        } else {
            $stmt = $conn->prepare("INSERT INTO payments (loan_id, schedule_id, amount_paid, date_paid, remarks) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iidds", $loan_id, $schedule_id, $amount_paid, $date_paid, $remarks);
            $stmt->execute();

            echo "<p style='color:green;'>✅ Payment of ₱" . number_format($amount_paid, 2) . " added successfully.</p>";
            $totalPaid += $amount_paid;
            $remaining = $dueAmount - $totalPaid;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Partial Payment</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 6px; text-align: center; }
        .form-group { margin-bottom: 10px; }
    </style>
</head>
<body>
<h2>Add Partial Payment</h2>
<p><strong>Schedule ID:</strong> <?= $schedule_id ?> | <strong>Loan ID:</strong> <?= $loan_id ?></p>
<p><strong>Total Due:</strong> ₱<?= number_format($dueAmount, 2) ?> | <strong>Total Paid:</strong> ₱<?= number_format($totalPaid, 2) ?> | <strong>Remaining:</strong> ₱<?= number_format($remaining, 2) ?></p>

<h3>Payment History</h3>
<table>
    <tr><th>Amount</th><th>Date Paid</th><th>Remarks</th></tr>
    <?php
    $history = $conn->query("SELECT amount_paid, date_paid, remarks FROM payments WHERE schedule_id = $schedule_id ORDER BY date_paid ASC");
    while ($p = $history->fetch_assoc()): ?>
        <tr>
            <td>₱<?= number_format($p['amount_paid'], 2) ?></td>
            <td><?= $p['date_paid'] ?></td>
            <td><?= htmlspecialchars($p['remarks']) ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<?php if ($totalPaid < $dueAmount): ?>
    <h3>Add Payment</h3>
    <form method="POST">
        <div class="form-group">
            <label>Amount to Pay: <input type="number" name="amount_paid" step="0.01" max="<?= $remaining ?>" required></label>
        </div>
        <div class="form-group">
            <label>Date Paid: <input type="date" name="date_paid" required></label>
        </div>
        <div class="form-group">
            <label>Remarks: <input type="text" name="remarks"></label>
        </div>
        <input type="hidden" name="schedule_id" value="<?= $schedule_id ?>">
        <input type="hidden" name="loan_id" value="<?= $loan_id ?>">
        <button type="submit">Submit Payment</button>
    </form>
<?php else: ?>
    <p style="color: green; font-weight: bold;">✅ Payment fully completed.</p>
<?php endif; ?>
</body>
</html>
