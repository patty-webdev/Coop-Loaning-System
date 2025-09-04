<?php
// Start session
session_start();
// Database connection for all tables and functions
include 'config/config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login_registration.php");
    exit;
}

// Fetch the previous login user details
$previous_user = null;
$sql_prev = "SELECT id, username, login_time FROM login_activity ORDER BY login_time DESC LIMIT 1 OFFSET 1";
$result_prev = $conn->query($sql_prev);

if ($result_prev->num_rows > 0) {
    $previous_user = $result_prev->fetch_assoc();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COOP SYSTEM</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="assets/styles.css">
  <script src="script.js"></script>
</head>

<body>
  
<header class="header">
  <div class="header-content">
    <div class="dashboard-left">  
      <a href="index.php"><img src="logo.png" alt="Logo" class="dashboard-logo" width="20%"></a>
      <h1> HFMPC-SYSTEM</h1> 
    </div> 
    <div class="admin-info">
      <!-- Display Previous Login (Retain) -->
      <?php if ($previous_user): ?>
        <div class="previous-login-info" style="text-align: right; display: flex; justify-content: space-between;">
          <p>Previous login: <strong><?php echo htmlspecialchars($previous_user['username']); ?></strong></p> &nbsp&nbsp&nbsp&nbsp
          <p>Time: <strong><?php echo htmlspecialchars($previous_user['login_time']); ?></strong></p>&nbsp&nbsp&nbsp
        </div>
      <?php else: ?>
        <p class="previous-login-info">No previous login records found.</p>
      <?php endif; ?>
      <button class="logout-btn" onclick="confirmLogout();">Logout</button>
      <form method="post" action="backup.php" onsubmit="return confirmBackup();">
          <button class="logout-btn" type="submit" name="backup"><i class="fas fa-cloud-download-alt"></i></button>
      </form>
    </div>
  </div>
</header>
<script>
  function confirmLogout() {
    if (confirm('Are you sure you want to logout?')) {
      window.location.href = 'logout.php';
    }
  }

  function confirmBackup() {
    return confirm('Are you sure you want to initiate a backup? Note: You only need to back up after making an update to your system.');
  }
</script>

</body>
</html>
