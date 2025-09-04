<!DOCTYPE html>
<html>
<head>
    <title>Loan Amortization Calculator - COOP System</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link rel="stylesheet" href="assets/coop_members_shared_capitals.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .form-container { 
            background: #ecf0f1; 
            padding: 20px; 
            border-radius: 8px; 
            margin-bottom: 20px;
            box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.322);
        }
        .form-grid { 
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }
        .form-group { 
            flex: 1 1 30%;
            display: flex;
            flex-direction: column;
            font-size: 14px;
        }
        .form-group label { 
            font-weight: bold; 
            margin-bottom: 5px; 
            color: #34495e;
        }
        .form-group input, .form-group select { 
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn-primary { 
            background: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover { 
            background: #2980b9;
        }
        .schedule-table { 
            background: #ecf0f1;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.322);
        }
        .schedule-table table { 
            width: 100%;
            border-collapse: collapse;
            font-family: arial, sans-serif;
            font-size: 70%;
        }
        .schedule-table th { 
            background-color: #2c3e50;
            color: white;
            padding: 8px;
            text-align: left;
            border: 1px solid #dddddd;
        }
        .schedule-table td { 
            padding: 8px;
            text-align: left;
            border: 1px solid #dddddd;
            word-wrap: break-word;
            white-space: normal;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .schedule-table tr:nth-child(even) {
            background-color: #dddddd;
        }
        .status-paid { 
            background: #d4edda;
            color: #155724;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        .status-partial { 
            background: #fff3cd;
            color: #856404;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        .status-unpaid { 
            background: #f8d7da;
            color: #721c24;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        .summary-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }
        .summary-item {
            flex: 1 1 30%;
            min-width: 200px;
        }

    </style>
</head>
<body>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<?php
// loan_amortization.php - Flat Interest Loan Amortization integrated with COOP system
// Session and authentication are handled by header.php
$userId = $_SESSION['user_id'];
$username = $_SESSION['username'];
?>

<main class="content-member">
    <section class="stats-member">
        <div class="card-member">
        <div class="form-container">
            <h2><i class="fas fa-calculator"></i> Loan Amortization Calculator (Flat Interest Method)</h2>
            <form method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="membership_id">Membership ID:</label>
                        <select name="membership_id" id="membership_id" required>
                            <option value="">Select Member</option>
                            <?php
                            $member_query = "SELECT membership_id, name_of_member FROM coop_members WHERE remarks = 'active' ORDER BY name_of_member";
                            $member_result = $conn->query($member_query);
                            while ($member = $member_result->fetch_assoc()) {
                                echo "<option value='" . $member['membership_id'] . "'>" . $member['membership_id'] . " - " . $member['name_of_member'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="loan_amount">Loan Amount:</label>
                        <input type="number" name="loan_amount" id="loan_amount" required step="0.01" min="1">
                    </div>
                    <div class="form-group">
                        <label for="term">Loan Term (months):</label>
                        <input type="number" name="term" id="term" required min="1" max="60">
                    </div>
                    <div class="form-group">
                        <label for="rate">Monthly Interest Rate (%):</label>
                        <input type="number" name="rate" id="rate" required step="0.01" min="0.1" max="10">
                    </div>
                    <div class="form-group">
                        <label for="payment_mode">Payment Mode:</label>
                        <select name="payment_mode" id="payment_mode" required>
                            <option value="monthly">Monthly</option>
                            <option value="semi-monthly">Semi-Monthly</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" name="start_date" id="start_date" required value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-calculator"></i> Generate Amortization Schedule
                </button>
            </form>
        </div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $membership_id = $_POST['membership_id'];
    $loanAmount = (float)$_POST['loan_amount'];
    $term = (int)$_POST['term'];
    $rateInput = (float)$_POST['rate'];
    $rate = $rateInput / 100;
    $paymentMode = $_POST['payment_mode'];
    $start_date = $_POST['start_date'];

    // Get member information
    $member_query = "SELECT name_of_member FROM coop_members WHERE membership_id = ?";
    $member_stmt = $conn->prepare($member_query);
    $member_stmt->bind_param("s", $membership_id);
    $member_stmt->execute();
    $member_result = $member_stmt->get_result();
    $member = $member_result->fetch_assoc();
    $borrower_name = $member['name_of_member'];

    // Calculate payments per year
    $payments_per_year = ($paymentMode == 'monthly') ? 12 : 24;
    $total_payments = $term * ($payments_per_year / 12);

    // Flat Interest Calculation
    $total_interest = $loanAmount * $rate * $term;
    $total_amount = $loanAmount + $total_interest;
    $payment_amount = $total_amount / $total_payments;

    // Create loan record in coop_member_loans table
    $loan_stmt = $conn->prepare("INSERT INTO coop_member_loans (membership_id, loan_amount, interest_rate, loan_term, monthly_payment, total_amount, loan_status, date_applied) VALUES (?, ?, ?, ?, ?, ?, 'approved', ?)");
    $loan_stmt->bind_param("sddidds", $membership_id, $loanAmount, $rateInput, $term, $payment_amount, $total_amount, $start_date);
    $loan_stmt->execute();
    $loan_id = $conn->insert_id;

    echo "<div class='form-container'>";
    echo "<h3><i class='fas fa-info-circle'></i> Loan Summary</h3>";
    echo "<div class='summary-grid'>";
    echo "<div class='summary-item'><strong>Borrower:</strong> $borrower_name</div>";
    echo "<div class='summary-item'><strong>Membership ID:</strong> $membership_id</div>";
    echo "<div class='summary-item'><strong>Loan Amount:</strong> ₱" . number_format($loanAmount, 2) . "</div>";
    echo "<div class='summary-item'><strong>Term:</strong> $term months</div>";
    echo "<div class='summary-item'><strong>Interest Rate:</strong> " . $rateInput . "% per month</div>";
    echo "<div class='summary-item'><strong>Payment Mode:</strong> " . ucfirst($paymentMode) . "</div>";
    echo "<div class='summary-item'><strong>Total Interest:</strong> ₱" . number_format($total_interest, 2) . "</div>";
    echo "<div class='summary-item'><strong>Total Amount:</strong> ₱" . number_format($total_amount, 2) . "</div>";
    echo "<div class='summary-item'><strong>Payment Amount:</strong> ₱" . number_format($payment_amount, 2) . "</div>";
    echo "</div>";
    echo "</div>";

    echo "<div class='schedule-table'>";
    echo "<h3><i class='fas fa-calendar-alt'></i> Amortization Schedule</h3>";
    echo "<div style='overflow-x:auto;'>";
    echo "<table>";
    echo "<thead><tr><th>Payment #</th><th>Due Date</th><th>Payment Amount</th><th>Principal</th><th>Interest</th><th>Balance</th><th>Status</th><th>Action</th></tr></thead><tbody>";

    $balance = $loanAmount;
    $principal_per_payment = $loanAmount / $total_payments;
    $interest_per_payment = $total_interest / $total_payments;

    for ($i = 1; $i <= $total_payments; $i++) {
        // Calculate due date based on start date
        $interval_days = ($paymentMode == 'monthly') ? 30 : 15;
        $due_date = date('Y-m-d', strtotime($start_date . " +" . ($i * $interval_days) . " days"));

        $balance -= $principal_per_payment;
        if ($balance < 0) $balance = 0; // Prevent negative balance

        // Save amortization schedule to new table
        $schedule_stmt = $conn->prepare("INSERT INTO coop_loan_amortization_schedule (loan_id, membership_id, payment_number, due_date, payment_amount, principal_amount, interest_amount, remaining_balance, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'unpaid')");
        $schedule_stmt->bind_param("isisdddd", $loan_id, $membership_id, $i, $due_date, $payment_amount, $principal_per_payment, $interest_per_payment, $balance);
        $schedule_stmt->execute();
        $schedule_id = $conn->insert_id;

        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$due_date</td>";
        echo "<td>₱" . number_format($payment_amount, 2) . "</td>";
        echo "<td>₱" . number_format($principal_per_payment, 2) . "</td>";
        echo "<td>₱" . number_format($interest_per_payment, 2) . "</td>";
        echo "<td>₱" . number_format($balance, 2) . "</td>";
        echo "<td><span class='status-unpaid'>Unpaid</span></td>";
        echo "<td><button type='button' class='btn-primary' style='padding: 5px 10px; font-size: 12px;' onclick='recordPayment($schedule_id, $payment_amount)'><i class='fas fa-money-bill'></i> Pay</button></td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
    echo "</div>";
    echo "</div>";
}
?>
        </div>
    </section>
</main>

<script>
function recordPayment(scheduleId, paymentAmount) {
    if (confirm('Record payment of ₱' + paymentAmount.toFixed(2) + '?')) {
        // Create a form and submit to payment processing
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'coop_members_payments_process.php';
        
        const scheduleInput = document.createElement('input');
        scheduleInput.type = 'hidden';
        scheduleInput.name = 'schedule_id';
        scheduleInput.value = scheduleId;
        
        const amountInput = document.createElement('input');
        amountInput.type = 'hidden';
        amountInput.name = 'payment_amount';
        amountInput.value = paymentAmount;
        
        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = 'record_amortization_payment';
        
        form.appendChild(scheduleInput);
        form.appendChild(amountInput);
        form.appendChild(actionInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

</body>
</html>
