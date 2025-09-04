<?php 
include 'header.php'; 
include 'sidebar.php'; 

// Database connection
include_once 'config/config.php';

// Function to fetch the total number of records for a specific table
function getTotalCount($conn, $table) {
    $sql = "SELECT COUNT(*) as total FROM $table"; // Use the table name passed as argument
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Fetch total members, shared capitals, and loans
$total_members = getTotalCount($conn, 'coop_members');
$total_shared_capitals = getTotalCount($conn, 'coop_members_shared_capital');
$total_loans = getTotalCount($conn, 'coop_member_loans');
?>




<!-- Main Content -->
<main class="content">
  <div class="welcome">
    <h1>Welcome to Dashboard</h1>
  </div>
  
  <section class="stats">
    <!-- Card for Total Members -->
    <a href="coop_members.php" class="card">
      <h2>Total Members</h2>
      <p id="total-users"><?php echo $total_members; ?></p>
    </a>

    <!-- Card for Total Shared Capitals -->
    <a href="coop_members_shared_capitals.php" class="card">
      <h2>Total Shared Capitals</h2>
      <p id="total-shared_capitals"><?php echo $total_shared_capitals; ?></p>
    </a>

    <!-- Card for Total Loans -->
    <a href="coop_members_loan.php" class="card">
      <h2>Total Loans</h2>
      <p id="total-loans"><?php echo $total_loans; ?></p>
    </a>
  </section>
      <?php
    // Handle error or success messages
    if (isset($_GET['error'])) {
        echo '<div id="message-box" class="message error-message">' . htmlspecialchars($_GET['message']) . '</div>';
    }
    if (isset($_GET['success'])) {
        echo '<div id="message-box" class="message success-message">' . htmlspecialchars($_GET['message']) . '</div>';
    }
    ?>
</main>

<style>
  body{
  
    background-color: gray;
  
  }
.stats a{
  text-decoration: none;
}
.message {
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
}

.error-message {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.success-message {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}
#message-box {
    transition: opacity 0.5s ease-out; /* Smooth fade-out effect */
}
</style>

<script>
  // Automatically hide the message box after 5 seconds
  setTimeout(function() {
    const messageBox = document.getElementById('message-box');
    if (messageBox) {
      messageBox.style.opacity = '0'; // Fade out
      setTimeout(() => messageBox.remove(), 500); // Fully remove after fade-out
    }
  }, 5000); // 5000ms = 5 seconds
</script>

</body>
</html>
