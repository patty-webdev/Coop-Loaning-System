<?php
// index.php - Flat Interest Loan Amortization (with DB Save & Payment Integration)

// Connect to DB
$conn = new mysqli("localhost", "root", "", "loan_system");
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Loan Amortization Calculator</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: center; }
        .btn { background: #2e6da4; color: white; padding: 5px 10px; border: none; cursor: pointer; }
        .btn[disabled] { background: gray; cursor: not-allowed; }
    </style>
</head>
<body>
<h2>Loan Amortization Calculator (Flat Interest Method)</h2>
<form method="post">
    <label>Borrower's Name: <input type="text" name="borrower" required></label><br><br>
    <label>Loan Amount: <input type="number" name="loan_amount" required step="0.01"></label><br><br>
    <label>Loan Term (months): <input type="number" name="term" required></label><br><br>
    <label>Monthly Interest Rate (%): <input type="number" name="rate" required step="0.01"></label><br><br>
    <label>Payment Mode:
        <select name="payment_mode" required>
            <option value="monthly">Monthly</option>
            <option value="semi-monthly">Semi-Monthly</option>
        </select>
    </label><br><br>
    <input type="submit" value="Calculate">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $borrower = $_POST['borrower'];
    $loanAmount = (float)$_POST['loan_amount'];
    $term = (int)$_POST['term'];
    $rateInput = (float)$_POST['rate'];
    $rate = $rateInput / 100;
    $paymentMode = $_POST['payment_mode'];

    $periods = $paymentMode === 'semi-monthly' ? $term * 2 : $term;
    $monthlyPrincipal = $loanAmount / $periods;
    $totalInterest = $loanAmount * $rate * $term;
    $interestPerPeriod = $totalInterest / $periods;
    $monthlyAmortization = $monthlyPrincipal + $interestPerPeriod;

    $stmt = $conn->prepare("INSERT INTO loans (borrower_name, loan_amount, term_months, interest_rate, monthly_principal) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) die("Loan Prepare failed: " . $conn->error);
    $stmt->bind_param("sdddd", $borrower, $loanAmount, $term, $rateInput, $monthlyPrincipal);
    if (!$stmt->execute()) die("Loan Insert Error: " . $stmt->error);
    $loan_id = $stmt->insert_id;

    $balance = $loanAmount;
    $cumulativeInterest = 0;
    $totalAmortization = 0;
    $totalPrincipal = 0;

    echo "<h3>Amortization Schedule for $borrower ($paymentMode)</h3>";
    echo "<table>
            <tr>
                <th>Period</th>
                <th>Amortization</th>
                <th>Interest</th>
                <th>Principal</th>
                <th>Outstanding Balance</th>
                <th>Cumulative Interest</th>
                <th>Action</th>
            </tr>";

    echo "<tr><td>0</td><td>-</td><td>-</td><td>-</td><td>" . number_format($loanAmount, 2) . "</td><td>-</td><td>-</td></tr>";

    for ($i = 1; $i <= $periods; $i++) {
        $cumulativeInterest += $interestPerPeriod;
        $balance -= $monthlyPrincipal;
        $totalAmortization += $monthlyAmortization;
        $totalPrincipal += $monthlyPrincipal;

        $stmt2 = $conn->prepare("INSERT INTO amortization_schedule (loan_id, month_no, amortization, interest, principal, balance, cumulative_interest) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt2) die("Amort Prepare failed: " . $conn->error);
        $stmt2->bind_param("idddddd", $loan_id, $i, $monthlyAmortization, $interestPerPeriod, $monthlyPrincipal, $balance, $cumulativeInterest);
        if (!$stmt2->execute()) die("Amort Insert Error (Period $i): " . $stmt2->error);
        $schedule_id = $stmt2->insert_id;

        // Get total payments made
        $paymentSumResult = $conn->query("SELECT SUM(amount_paid) AS total_paid FROM payments WHERE schedule_id = $schedule_id");
        $paymentRow = $paymentSumResult->fetch_assoc();
        $totalPaid = (float) $paymentRow['total_paid'];

        echo "<tr>
                <td>$i</td>
                <td>" . number_format($monthlyAmortization, 2) . "</td>
                <td>" . number_format($interestPerPeriod, 2) . "</td>
                <td>" . number_format($monthlyPrincipal, 2) . "</td>
                <td>" . number_format(max($balance, 0), 2) . "</td>
                <td>" . number_format($cumulativeInterest, 2) . "</td>
                <td>";

        if ($totalPaid >= $monthlyAmortization) {
            echo "<button class='btn' disabled>Paid</button>";
        } elseif ($totalPaid > 0) {
            echo "<button class='btn' disabled style='background: orange;'>Partial (₱" . number_format($totalPaid, 2) . ")</button>";
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
    echo "<h4>Total Amortization: ₱" . number_format($totalAmortization, 2) . "</h4>";
    echo "<h4>Total Principal: ₱" . number_format($totalPrincipal, 2) . "</h4>";
    echo "<h4>Total Interest: ₱" . number_format($totalInterest, 2) . "</h4>";
}
?>
</body>
</html>
