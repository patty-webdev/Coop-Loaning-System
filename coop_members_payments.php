<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<link rel="stylesheet" href="assets/coop_members_shared_capitals.css">
<link rel="stylesheet" href="assets/message.css">
<link rel="stylesheet" href="assets/payment.css">

<script src="assets/script.js"></script>

<main class="content-member">
  <section class="stats-member">
    <div class="card-member">
      <div class="card-header-member">
        <h2>Payment List</h2>
        <div class="actions">
           <input type="text" id="search-bar" placeholder="Search loans..." oninput="searchTable()">
            <button class="search-btn" onclick="searchTable()">
                <i class="fas fa-search"></i>
            </button>
        </div>
      </div>

      <table id="payment-table">
        <thead>
          <tr>
            <th>Membership ID</th>
            <th>Payment Amount</th>
            <th>O.R</th>
            <th>Payment Date</th>
            <th>Created At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $sql = "SELECT * FROM coop_member_loan_payments ORDER BY payment_date DESC";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td hidden>" . htmlspecialchars($row['loan_id']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['membership_id']) . "</td>";
                  echo "<td>₱" . number_format($row['payment_amount'], 2) . "</td>";
                  echo "<td>" . htmlspecialchars($row['OR_number'], 2) . "</td>";
                  echo "<td>" . htmlspecialchars($row['payment_date'], 2) . "</td>";
                  echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                  echo '<td><a href=".php?id=' . htmlspecialchars($row['loan_id']) . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this loan payment?\')"><button><i class="fa-solid fa-trash"></i></button></a>';
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='7'>No payments found.</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </section>
</main>




<script>
    // Get the modal
var modal = document.getElementById("paymentModal");

// Get the button that opens the modal
var btn = document.getElementById("openModalBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close-btn")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>


