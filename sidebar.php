<?php
// Assuming you're using PHP and this is in the sidebar.php or similar
$current_page = basename($_SERVER['PHP_SELF']); // Get the current page name

function is_active($page) {
    global $current_page;
    return $current_page == $page ? 'active' : ''; // Add 'active' class if it's the current page
}
?>

<!-- Sidebar -->
<aside class="sidebar">
  <ul>
    <li class="<?= is_active('index.php') ?>"><a href="index.php"><i class="fas fa-tachometer-alt"></i>&nbsp Dashboard</a></li>
    
    <hr>

    <li class="<?= is_active('coop_members.php') ?>"><a href="coop_members.php"><i class="fas fa-users"></i>&nbsp COOP Members</a></li>
    <li class="<?= is_active('coop_members_shared_capitals.php') ?>"><a href="coop_members_shared_capitals.php"><i class="fas fa-cogs"></i>&nbsp SC Members</a></li>
    <li class="<?= is_active('coop_members_shared_capitals_contribution.php') ?>"><a href="coop_members_shared_capitals_contribution.php"><i class="fas fa-chart-line"></i>&nbsp&nbsp SC Contributions</a></li>
    <li class="<?= is_active('coop_members_pusc_tin.php') ?>"><a href="coop_members_pusc_tin.php"><i class="fas fa-receipt"></i>&nbsp&nbsp&nbsp PUSC & TIN &nbsp&nbsp&nbsp&nbsp&nbsp&nbspReport</a></li>
    
    <hr>

    <li class="<?= is_active('coop_members_loan.php') ?>"><a href="coop_members_loan.php"><i class="fas fa-credit-card"></i>&nbsp&nbsp Loans</a></li>
    <li class="<?= is_active('loan_amortization.php') ?>"><a href="loan_amortization.php"><i class="fas fa-calculator"></i> Loan Calculator</a></li>
    <li class="<?= is_active('coop_members_payments.php') ?>"><a href="coop_members_payments.php"><i class="fas fa-hand-holding-usd"></i>&nbsp&nbsp Payments</a></li>
    <li class="<?= is_active('coop_members_transaction_logs.php') ?>"><a href="coop_members_transaction_logs.php"><i class="fas fa-receipt"></i>&nbsp&nbsp&nbsp Transaction Logs</a></li>
    
    <hr>
     
    <li class="<?= is_active('#') ?>"><a href="#"><i class="fas fa-cog"></i>&nbsp&nbsp Settings</a></li>
  </ul>
</aside>

<style>
  /* CSS for active links */
.sidebar .active a {
  color:rgb(255, 208, 0); /* Highlight text */
  
}

/* You can also add hover styles for active elements if desired */
.sidebar .active a:hover {
  background-color: #0056b3; /* Darker background on hover */
}
</style>


<script>
  // JavaScript to toggle dropdown menu with easing on click
document.querySelectorAll('.dropdown-btn').forEach(button => {
  button.addEventListener('click', function(event) {
    const dropdownMenu = this.nextElementSibling;
    
    // Check if dropdown is currently open (max-height is not 0)
    if (dropdownMenu.style.maxHeight && dropdownMenu.style.maxHeight !== '0px') {
      // Close the dropdown (set max-height to 0)
      dropdownMenu.style.maxHeight = '0';
    } else {
      // Open the dropdown (set max-height to a large value)
      dropdownMenu.style.maxHeight = '500px';  // Adjust as necessary based on content size
    }

    event.stopPropagation(); // Prevent event from propagating up the DOM
  });
});

// Close dropdown if clicking outside the sidebar
document.addEventListener('click', function(event) {
  if (!event.target.closest('.sidebar')) {
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
      menu.style.maxHeight = '0';  // Close dropdowns when clicking outside
    });
  }
});

  </script>