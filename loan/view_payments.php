<?php
$conn = new mysqli("localhost", "root", "", "loan_system");
$loan_id = $_GET['loan_id'];

$result = $conn->query("
    SELECT p.*, a.month_no 
    FROM payments p 
    JOIN amortization_schedule a ON p.schedule_id = a.id 
    WHERE p.loan_id = $loan_id 
    ORDER BY a.month_no
");

echo "<h3>Payments for Loan ID: $loan_id</h3>";
echo "<table border='1'>
<tr><th>Period</th><th>Amount</th><th>Date Paid</th><th>Remarks</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['month_no']}</td>
        <td>₱" . number_format($row['amount_paid'], 2) . "</td>
        <td>{$row['date_paid']}</td>
        <td>{$row['remarks']}</td>
    </tr>";
}

echo "</table>";
?>
