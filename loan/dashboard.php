<?php
// dashboard.php - Central Dashboard for Loan Management System

$conn = new mysqli("localhost", "root", "", "loan_system");
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Get summary statistics
$totalLoansResult = $conn->query("SELECT COUNT(*) as total_loans, SUM(loan_amount) as total_amount FROM loans");
$totalLoans = $totalLoansResult->fetch_assoc();

$totalPaymentsResult = $conn->query("SELECT COUNT(*) as total_payments, SUM(amount_paid) as total_paid FROM payments");
$totalPayments = $totalPaymentsResult->fetch_assoc();

$pendingPaymentsResult = $conn->query("
    SELECT COUNT(*) as pending_count 
    FROM amortization_schedule a 
    LEFT JOIN (
        SELECT schedule_id, SUM(amount_paid) as total_paid 
        FROM payments 
        GROUP BY schedule_id
    ) p ON a.id = p.schedule_id 
    WHERE COALESCE(p.total_paid, 0) < a.amortization
");
$pendingPayments = $pendingPaymentsResult->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Loan Management Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .header p {
            font-size: 1.1em;
            opacity: 0.9;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 30px;
            background: #f8f9fa;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            border-left: 5px solid #3498db;
        }
        
        .stat-card h3 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 1.1em;
        }
        
        .stat-card .number {
            font-size: 2em;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 5px;
        }
        
        .stat-card .label {
            color: #7f8c8d;
            font-size: 0.9em;
        }
        
        .navigation {
            padding: 30px;
        }
        
        .nav-title {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
            font-size: 1.8em;
        }
        
        .nav-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .nav-card {
            background: white;
            border: 2px solid #ecf0f1;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .nav-card:hover {
            border-color: #3498db;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(52, 152, 219, 0.2);
        }
        
        .nav-card .icon {
            font-size: 3em;
            margin-bottom: 15px;
        }
        
        .nav-card h3 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 1.3em;
        }
        
        .nav-card p {
            color: #7f8c8d;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        
        .nav-card .btn {
            background: #3498db;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .nav-card .btn:hover {
            background: #2980b9;
        }
        
        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 0.9em;
        }
        
        @media (max-width: 768px) {
            .stats-grid, .nav-grid {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏦 Loan Management System</h1>
            <p>Central Dashboard for Managing Loans and Payments</p>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Loans</h3>
                <div class="number"><?= $totalLoans['total_loans'] ?? 0 ?></div>
                <div class="label">Active Loan Accounts</div>
            </div>
            
            <div class="stat-card">
                <h3>Total Loan Amount</h3>
                <div class="number">₱<?= number_format($totalLoans['total_amount'] ?? 0, 0) ?></div>
                <div class="label">Outstanding Principal</div>
            </div>
            
            <div class="stat-card">
                <h3>Total Payments</h3>
                <div class="number"><?= $totalPayments['total_payments'] ?? 0 ?></div>
                <div class="label">Payment Transactions</div>
            </div>
            
            <div class="stat-card">
                <h3>Amount Collected</h3>
                <div class="number">₱<?= number_format($totalPayments['total_paid'] ?? 0, 0) ?></div>
                <div class="label">Total Payments Received</div>
            </div>
            
            <div class="stat-card">
                <h3>Pending Payments</h3>
                <div class="number"><?= $pendingPayments['pending_count'] ?? 0 ?></div>
                <div class="label">Outstanding Installments</div>
            </div>
        </div>
        
        <div class="navigation">
            <h2 class="nav-title">System Navigation</h2>
            
            <div class="nav-grid">
                <div class="nav-card" onclick="window.location.href='index.php'">
                    <div class="icon">🧮</div>
                    <h3>Loan Calculator</h3>
                    <p>Create new loans and generate amortization schedules with flat interest calculation</p>
                    <a href="index.php" class="btn">Calculate Loan</a>
                </div>
                
                <div class="nav-card" onclick="window.location.href='view_loans.php'">
                    <div class="icon">📋</div>
                    <h3>View All Loans</h3>
                    <p>Browse all borrowers and their complete amortization schedules with payment status</p>
                    <a href="view_loans.php" class="btn">View Loans</a>
                </div>
                
                <div class="nav-card" onclick="window.location.href='admin_add_payment.php'">
                    <div class="icon">💰</div>
                    <h3>Add Payment</h3>
                    <p>Record new payments for loan installments with date and remarks</p>
                    <a href="#" class="btn" onclick="alert('Please select a loan from View Loans page to add payment'); return false;">Add Payment</a>
                </div>
                
                <div class="nav-card">
                    <div class="icon">📊</div>
                    <h3>Payment Reports</h3>
                    <p>View detailed payment history and generate reports for specific loans</p>
                    <a href="#" class="btn" onclick="alert('Please select a loan from View Loans page to view payments'); return false;">View Reports</a>
                </div>
                
                <div class="nav-card">
                    <div class="icon">⚙️</div>
                    <h3>System Settings</h3>
                    <p>Configure system parameters, interest rates, and payment modes</p>
                    <a href="#" class="btn" onclick="alert('Settings feature coming soon!'); return false;">Settings</a>
                </div>
                
                <div class="nav-card">
                    <div class="icon">📈</div>
                    <h3>Analytics</h3>
                    <p>View loan performance metrics, collection rates, and financial summaries</p>
                    <a href="#" class="btn" onclick="alert('Analytics feature coming soon!'); return false;">View Analytics</a>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; 2024 Loan Management System | Developed for efficient loan administration</p>
        </div>
    </div>
    
    <script>
        // Add some interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stat cards on load
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    card.style.transition = 'all 0.5s ease';
                    
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 100);
                }, index * 100);
            });
            
            // Add click handlers for nav cards
            const navCards = document.querySelectorAll('.nav-card');
            navCards.forEach(card => {
                card.addEventListener('click', function(e) {
                    if (e.target.tagName !== 'A') {
                        const link = this.querySelector('a');
                        if (link && link.href && !link.href.includes('#')) {
                            window.location.href = link.href;
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>