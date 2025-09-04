<?php
// view_loans.php - View All Borrowers and Their Amortization Summary (With Payment Status)

$conn = new mysqli("localhost", "root", "", "loan_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Loaners & Amortization Overview</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 30px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: center; }
        h2 { margin-top: 40px; }
        .btn { padding: 5px 10px; background: #2e6da4; color: white; border: none; cursor: pointer; }
        .btn[disabled] { background: gray; cursor: not-allowed; }
    </style>
</head>
<body>
<h1>Loaners and Their Amortization Summary</h1>

<?php
$result = $conn->query("SELECT * FROM loans ORDER BY created_at DESC");
if ($result->num_rows > 0):
    while ($loan = $result->fetch_assoc()):
        $loan_id = $loan['id'];
        $borrower = $loan['borrower_name'];
        $loan_amount = $loan['loan_amount'];
        $term = $loan['term_months'];
        $rate = $loan['interest_rate'];

        echo "<h2>$borrower</h2>";
        echo "<p>Loan Amount: ₱" . number_format($loan_amount, 2) . " | Term: $term months | Rate: $rate%</p>";

        $schedule = $conn->query("SELECT * FROM amortization_schedule WHERE loan_id = $loan_id ORDER BY month_no ASC");

        if ($schedule->num_rows > 0):
            echo "<table>
                    <tr>
                        <th>Period</th>
                        <th>Amortization</th>
                        <th>Interest</th>
                        <th>Principal</th>
                        <th>Balance</th>
                        <th>Cumulative Interest</th>
                        <th>Status</th>
                    </tr>";
            while ($row = $schedule->fetch_assoc()) {
                $schedule_id = $row['id'];
                $amortization = (float) $row['amortization'];

                // Get total payments made
                $paymentSumResult = $conn->query("SELECT SUM(amount_paid) AS total_paid FROM payments WHERE schedule_id = $schedule_id");
                $paymentRow = $paymentSumResult->fetch_assoc();
                $totalPaid = (float) $paymentRow['total_paid'];

                echo "<tr>
                        <td>{$row['month_no']}</td>
                        <td>" . number_format($amortization, 2) . "</td>
                        <td>" . number_format($row['interest'], 2) . "</td>
                        <td>" . number_format($row['principal'], 2) . "</td>
                        <td>" . number_format($row['balance'], 2) . "</td>
                        <td>" . number_format($row['cumulative_interest'], 2) . "</td>
                        <td>";

                if ($totalPaid >= $amortization) {
                    echo "<button class='btn' disabled>Paid</button>";
                } elseif ($totalPaid > 0) {
                    echo "<form action='add_partial_payment.php' method='POST'>
                            <input type='hidden' name='loan_id' value='$loan_id'>
                            <input type='hidden' name='schedule_id' value='$schedule_id'>
                            <input type='submit' class='btn' style='background: orange;' value='Partial (₱" . number_format($totalPaid, 2) . ")'>
                          </form>";
                } else {
                    echo "<form action='admin_add_payment.php' method='POST' target='_blank'>
                            <input type='hidden' name='loan_id' value='$loan_id'>
                            <input type='hidden' name='schedule_id' value='$schedule_id'>
                            <input type='submit' class='btn' value='Add Payment'>
                          </form>";
                }

                echo "</td></tr>";
            }
            echo "</table>";
        else:
            echo "<p>No amortization records found.</p>";
        endif;
    endwhile;
else:
    echo "<p>No loan records found.</p>";
endif;
?>
</body>
</html>
