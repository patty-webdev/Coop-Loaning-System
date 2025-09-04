<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>


<link rel="stylesheet" href="assets/profile.css">

<?php

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $membership_id = $_GET['id'];

    // Prepare and execute a query to fetch the member's details from the database
    $sql = "SELECT * FROM coop_members WHERE membership_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $membership_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $member = $result->fetch_assoc(); // Fetch member data into $member array
    } else {
        echo "No member found with ID: " . htmlspecialchars($membership_id);
        exit();
    }

    $shared_capitals_sql = "SELECT SUM(Amount) AS TotalSharedCapital FROM shared_capital_amount WHERE Membership_ID = ? AND (remarks IS NULL OR remarks != 'Deleted')";
    $stmt = $conn->prepare($shared_capitals_sql);
    $stmt->bind_param("s", $membership_id);
    $stmt->execute();
    $shared_capitals_result = $stmt->get_result();
    $shared_capitals = $shared_capitals_result->fetch_assoc();
    $total_shared_capital = $shared_capitals['TotalSharedCapital'];

    // Query to fetch shared capital data
    $shared_capitals_sql = "SELECT Date_Paid, Amount, Membership_ID FROM shared_capital_amount WHERE Membership_ID = ?  AND (remarks IS NULL OR remarks != 'Deleted') ";
    $stmt = $conn->prepare($shared_capitals_sql);
    $stmt->bind_param("s", $membership_id);
    $stmt->execute();
    $shared_capitals_result = $stmt->get_result();
    $shared_capitals = $shared_capitals_result->fetch_all(MYSQLI_ASSOC);

    // Query to fetch loan payments data
    $loan_payments_sql = "SELECT loan_id, payment_date, payment_amount FROM coop_member_loan_payments WHERE membership_id = ?";
    $stmt = $conn->prepare($loan_payments_sql);
    $stmt->bind_param("s", $membership_id);
    $stmt->execute();
    $loan_payments_result = $stmt->get_result();
    $loan_payments = $loan_payments_result->fetch_all(MYSQLI_ASSOC);

    // Query to fetch total loan amount
    $total_loans_sql = "SELECT SUM(balance_amount) AS TotalLoanAmount FROM coop_member_loans WHERE membership_id = ?";
    $stmt = $conn->prepare($total_loans_sql);
    $stmt->bind_param("s", $membership_id);
    $stmt->execute();
    $total_loans_result = $stmt->get_result();
    $total_loans = $total_loans_result->fetch_assoc();
    $total_loan_amount = $total_loans['TotalLoanAmount'];

    // Query to fetch shared capital accounts data
    $shared_capital_accounts_sql = "SELECT Membership_ID, Date_Added FROM coop_members_shared_capital WHERE Membership_ID = ?";
    $stmt = $conn->prepare($shared_capital_accounts_sql);
    $stmt->bind_param("s", $membership_id);
    $stmt->execute();
    $shared_capital_accounts_result = $stmt->get_result();
    $shared_capital_accounts = $shared_capital_accounts_result->fetch_all(MYSQLI_ASSOC);

    $conn->close();
} else {
    echo "No membership ID provided.";
    exit();
}
?>

<main class="content-member">
  <section class="stats-member">
    <div class="card-member">
      <div class="card-header-member">
      <div class="profile-card">
                <div class="profile-left">
                    <img src="profile.png" alt="Profile picture">
                    <div class="pinfo">
                        <h2><?php echo htmlspecialchars($member['name_of_member']); ?></h2>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($member['contact_number']); ?></p>
                        <p><strong>Address:</strong> <?php echo htmlspecialchars($member['address']); ?></p>
                        <p><strong>TIN ID:</strong> <?php echo htmlspecialchars($member['tin']); ?></p>
                    </div>
                </div>
                <div class="profile-right">
                    <table>
                        <tr>
                            <td>Membership ID</td>
                            <td><?php echo htmlspecialchars($member['membership_id']); ?></td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td><?php echo htmlspecialchars($member['date_of_birth']); ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><?php echo htmlspecialchars($member['gender']); ?></td>
                        </tr>
                        <tr>
                            <td>Occupation</td>
                            <td><?php echo htmlspecialchars($member['occupation']); ?></td>
                        </tr>
                        <tr>
                            <td>Total Loan Amount</td>
                            <td><?php echo $total_loan_amount ? "₱" . number_format($total_loan_amount, 2) : '<span style="color:red;">No Loans Recorded</span>'; ?></td>
                        </tr>
                        <tr>
                            <td>Total Shared Capital</td>
                            <td><?php echo $total_shared_capital ? "₱" . number_format($total_shared_capital, 2) : '<span style="color:red;">No Updated Contribution</span>'; ?></td>
                        </tr>
                    </table>
                    <div class="button-container">
                        <button class="button active" id="shared-capitals-btn">Shared Capitals</button>
                        <button class="button" id="loan-information-btn">Loan Information</button>
                        
                    </div>
                </div>
            </div>

            
      </div>
    </div>
    <div class="card-member">
      <div class="card-header-member">
            <div class="second-content">
                <div id="shared-capitals-section" class="section active">
                    <h3>Shared Capitals Breakdown</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($shared_capitals)): ?>
                            <?php foreach ($shared_capitals as $capital): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($capital['Membership_ID']); ?></td>
                                    <td><?php echo htmlspecialchars($capital['Date_Paid']); ?></td>
                                    <td style="text-align: right;"><?php echo "₱" . number_format($capital['Amount'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" style="text-align: center; color: red;">No Shared Capitals Contribution Recorded</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div id="loan-information-section" class="section">
                    <h3>Loan Payments</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Loan ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($loan_payments)): ?>
                                <?php foreach ($loan_payments as $payment): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($payment['loan_id']); ?></td>
                                        <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                                        <td style="text-align: right;"><?php echo "₱" . number_format($payment['payment_amount'], 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" style="text-align: center; color: red;">No Loan Payments Recorded</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>



            </div>
      </div>
    </div>
  </section>
</main>


  
    


<script>

document.addEventListener('DOMContentLoaded', function() {
                // Initially show the shared-capitals-section
                document.getElementById('shared-capitals-section').style.display = 'block';
                document.getElementById('shared-capitals-btn').classList.add('active');
                document.getElementById('loan-information-btn').classList.remove('active');
                

                document.getElementById('shared-capitals-btn').addEventListener('click', function() {
                    document.querySelectorAll('.section').forEach(function(section) {
                        section.style.display = 'none';
                    });
                    document.getElementById('shared-capitals-section').style.display = 'block';
                    this.classList.add('active');
                    document.getElementById('loan-information-btn').classList.remove('active');
                    
                });

                document.getElementById('loan-information-btn').addEventListener('click', function() {
                    document.querySelectorAll('.section').forEach(function(section) {
                        section.style.display = 'none';
                    });
                    document.getElementById('loan-information-section').style.display = 'block';
                    this.classList.add('active');
                    document.getElementById('shared-capitals-btn').classList.remove('active');
                    
                });

                
            });

</script>

