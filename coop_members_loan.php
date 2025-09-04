<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<link rel="stylesheet" href="assets/coop_members_shared_capitals.css">
<link rel="stylesheet" href="assets/message.css">
<script src="assets/script.js"></script>

<style>
  .modal {
  display: none;
  position: fixed;
  z-index: 10;
  left: 0; top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4);
}

.modal-content {
  background: #fff;
  margin: 4% auto;
  padding: 20px 30px;
  border-radius: 10px;
  width: 80%;
  max-width: 900px;
  position: relative;
  box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.close-btn {
  position: absolute;
  right: 20px;
  top: 15px;
  font-size: 28px;
  cursor: pointer;
  color: #999;
}

.modal-title {
  text-align: center;
  margin-bottom: 20px;
  font-size: 26px;
}

.form-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  margin-bottom: 20px;
}

.form-grid label {
  flex: 1 1 30%;
  display: flex;
  flex-direction: column;
  font-size: 14px;
}

.form-grid input,
.form-grid select {
  padding: 8px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.form-actions {
  text-align: center;
  margin-top: 20px;
}

.form-actions button {
  padding: 10px 20px;
  margin: 0 10px;
  border: none;
  background-color: #2e86de;
  color: #fff;
  font-size: 14px;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.form-actions button:hover {
  background-color: #1e60a1;
}
</style>

<main class="content-member">
  <section class="stats-member">
    <div class="card-member">
      <div class="card-header-member">
        <h2>Loan List</h2>
        <div class="actions">
           <input type="text" id="search-bar" placeholder="Search loans..." oninput="searchTable()">
            <button class="search-btn" onclick="searchTable()">
                <i class="fas fa-search"></i>
            </button>
            <!-- Dropdown Button for Add Loan, Import and Export -->
            <div class="dropdown">
              <button class="add-btn" onclick="toggleDropdown()">
                  <i class="fas fa-user-plus"></i> Actions
              </button>
              <div id="dropdown-menu" class="dropdown-content">
                <button onclick="openAddLoanModal()">Add Loan</button>
                <button onclick="window.location.href='coop_members_loan_export_pdf.php'" class="export-pdf-btn">Export to PDF</button>
                <a href="coop_members_loan_generate_csv.php"><button>Export CSV</button></a>
                <button onclick="openUploadloanModal()">Upload CSV</button> <!-- New button for uploading CSV -->

              </div>
            </div>
        </div>
      </div>

      <?php
      // Handle error or success messages
      if (isset($_GET['error'])) {
          echo '<div class="message error-message">' . htmlspecialchars($_GET['message']) . '</div>';
      }
      if (isset($_GET['success'])) {
          echo '<div class="message success-message">' . htmlspecialchars($_GET['message']) . '</div>';
      }
      ?>

    </br>

      <div style="overflow-x:auto;">
        <table id="loan-table">
          <thead>
            <tr>
              <th>Membership ID</th>
              <th>Name</th>
              <th>Type of Loan</th>
              <th>Loan Amount</th>
              <th>Balance Amount</th>
              <th>Term</th>
              <th>Reference Number</th>
              <th>Payment Date</th>
              <th>Date of Loan</th>
              <th>Insurance Premium</th>
              <th>Co-makers</th>
              <th>Birthday of Member</th>
              <th>Rate</th>
              <th>Monthly Payment</th>
              <th>Created At</th>

              <th class="th-class">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php

            // SQL query to fetch loan data
            $sql = "SELECT id, membership_id, name, type_of_loan, loan_amount,balance_amount, term, OR_number, payment_date, date_of_loan, insurance_premium, co_makers, birthday_of_member, rate, monthly_payment, created_at FROM coop_member_loans WHERE remarks IS NULL OR Remarks != 'Deleted'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td hidden>" . htmlspecialchars($row['id']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['membership_id']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['type_of_loan']) . "</td>";
                  echo "<td> ₱" . htmlspecialchars($row['loan_amount']) . "</td>";
                  echo "<td> ₱" . htmlspecialchars($row['balance_amount']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['term']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['OR_number']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['payment_date']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['date_of_loan']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['insurance_premium']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['co_makers']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['birthday_of_member']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['rate']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['monthly_payment']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";

                  // Add Payment Button in Actions Column
                  echo "<td style='display: flex; justify-content: space-between; align-items: center; border'>";
                  echo "<button class='edit-btn'><i class='fa-solid fa-pen-to-square'></i></button>";
                  echo '<a href="coop_members_loan_delete_functions.php?id=' . htmlspecialchars($row['id']) . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this loan? all data will be deleted?\')"><button><i class="fa-solid fa-trash"></i></button></a>';
                  echo "<button class='payment-btn' title='payment' onclick='openPaymentModal(" . htmlspecialchars($row['id']) . ")'><i class='fa-solid fa-money-bill-wave'></i></button>";
                  echo "</td>";

                  echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='16'>No loans found</td></tr>";
            }

            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<style>
  .grid{
    display: flex;
    justify-content: space-between;
  }
  .th-class{
    width: 100px;

  }
</style>

<!-- Modal for adding loans -->

<div id="add-loan-modal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeAddLoanModal()"> 
      <i class="fas fa-times-circle"></i>
    </span>

    <h2 class="modal-title">Add Loan</h2>

    <form id="add-loan-form" onsubmit="saveLoan(event)" method="POST" action="coop_members_loan_process.php">
      
      <!-- Step 1: Loan Info -->
      <div class="form-step" id="step-1">
        <div class="form-grid">
          <label>
            Membership ID:
            <input type="text" id="membership_id" name="membership_id" placeholder="Enter Membership ID" required>
          </label>
          <label>
            Loan Amount:
            <input type="number" id="loan_amount" name="loan_amount" placeholder="Enter loan amount" required>
          </label>
          <label>
            Type of Loan:
            <select id="type_of_loan" name="type_of_loan" required>
              <option value="" selected disabled>-- select one --</option>
              <option value="Provident Loan">Provident Loan</option>
              <option value="Productive Loan">Productive Loan</option>
              <option value="Education Loan">Education Loan</option>
              <option value="Travel Loan">Travel Loan</option>
              <option value="Gadget Loan">Gadget Loan</option>
              <option value="Appliance Loan">Appliance Loan</option>
              <option value="Christmas Loan">Christmas Loan</option>
            </select>
          </label>
        </div>

        <div class="form-grid">
          <label>
            Term:
            <input type="number" id="term" name="term" placeholder="Enter loan term" required>
          </label>
          <label>
            Date of Loan:
            <input type="date" id="date_of_loan" name="date_of_loan" required>
          </label>
          <label>
            Payment Date:
            <input type="date" id="payment_date" name="payment_date" required>
          </label>
        </div>

        <div class="form-actions">
          <button type="button" onclick="nextStep(1)">Next</button>
        </div>
      </div>

      <!-- Step 2: Additional Loan Info -->
      <div class="form-step" id="step-2" style="display:none;">
        <div class="form-grid">
          <label>
            Insurance Premium:
            <input type="number" id="insurance_premium" name="insurance_premium" placeholder="Enter insurance premium" required>
          </label>
          <label>
            Co-makers:
            <input type="text" id="co_makers" name="co_makers" placeholder="Enter co-makers" required>
          </label>
          <label>
            Birthday of Member:
            <input type="date" id="birthday_of_member" name="birthday_of_member" required>
          </label>
        </div>

        <div class="form-grid">
          <label>
            Rate:
            <input type="number" id="rate" name="rate" placeholder="Enter rate" required>
          </label>
          <label>
            Monthly Payment:
            <input type="number" id="monthly_payment" name="monthly_payment" placeholder="Enter monthly payment" required>
          </label>
          <label>
            Reference Number:
            <input type="number" id="OR_number" name="OR_number" placeholder="Enter O.R number" required>
          </label>
        </div>

        <div class="form-actions">
          <button type="button" onclick="prevStep(2)">Previous</button>
          <button type="submit">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal for editing loans -->
<div id="edit-loan-modal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeEditLoanModal()">&times;</span>
    <h2>Edit Loan</h2>

    <form id="edit-loan-form" method="POST" action="coop_members_loan_update.php">
      <input type="hidden" id="edit_loan_id" name="loan_id"> <!-- Hidden loan ID field -->

      <div class="grid-fields">
        <div class="grid-fields-label">
          <label for="edit_membership_id">Membership ID:</label>
          <input type="text" id="edit_membership_id" name="membership_id" required>
        </div>
        <div class="grid-fields-label">
          <label for="edit_loan_amount">Loan Amount:</label>
          <input type="number" id="edit_loan_amount" name="loan_amount" required>
        </div>
      </div>

      <div class="grid-fields">
        <div class="grid-fields-label">
          <label for="edit_type_of_loan">Type of Loan:</label>
          <select id="edit_type_of_loan" name="type_of_loan" required>
            <option value="">-- select one --</option>
            <option value="Provident Loan">Provident Loan</option>
            <option value="Productive Loan">Productive Loan</option>
            <option value="Education Loan">Education Loan</option>
            <option value="Travel Loan">Travel Loan</option>
            <option value="Gadget Loan">Gadget Loan</option>
            <option value="Appliance Loan">Appliance Loan</option>
            <option value="Christmas Loan">Christmas Loan</option>
          </select>
        </div>
        <div class="grid-fields-label">
          <label for="edit_term">Term:</label>
          <input type="number" id="edit_term" name="term" required>
        </div>
        <div class="grid-fields-label">
          <label for="edit_date_of_loan">Date of Loan:</label>
          <input type="date" id="edit_date_of_loan" name="date_of_loan" required>
        </div>
      </div>

      <div class="grid-fields">
        <div class="grid-fields-label">
          <label for="edit_payment_date">Payment Date:</label>
          <input type="date" id="edit_payment_date" name="payment_date" required>
        </div>
        <div class="grid-fields-label">
          <label for="edit_insurance_premium">Insurance Premium:</label>
          <input type="number" id="edit_insurance_premium" name="insurance_premium" required>
        </div>
        <div class="grid-fields-label">
          <label for="edit_co_makers">Co-makers:</label>
          <input type="text" id="edit_co_makers" name="co_makers" required>
        </div>
      </div>

      <div class="grid-fields">
        <div class="grid-fields-label">
          <label for="edit_birthday_of_member">Birthday of Member:</label>
          <input type="date" id="edit_birthday_of_member" name="birthday_of_member" required>
        </div>
        <div class="grid-fields-label">
          <label for="edit_rate">Rate:</label>
          <input type="number" id="edit_rate" name="rate" required>
        </div>
        <div class="grid-fields-label">
          <label for="edit_monthly_payment">Monthly Payment:</label>
          <input type="number" id="edit_monthly_payment" name="monthly_payment" required>
        </div>
      </div>

      <div class="grid-fields">
        <div class="grid-fields-label">
          <label for="edit_OR_number">Reference Number:</label>
          <input type="number" id="edit_OR_number" name="OR_number" required>
        </div>
        <div class="grid-fields-label">
          <label for="edit_status">Status:</label>
          <select id="edit_status" name="status" required>
            <option value="">-- select one --</option>
            <option value="1">Active</option>
            <option value="0">Withdrawn</option>
          </select>
        </div>
      </div>

      <button type="submit" class="save-btn">Save Changes</button>
    </form>
  </div>
</div>




<div id="upload-loan-modal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeUploadloanModal()">&times;</span>
    <h2>Upload CSV</h2>
    <form id="upload-loan-form" method="POST" action="coop_members_loan_import_csv.php" enctype="multipart/form-data">
      <div class="grid-fields">
        <div class="grid-fields-label">
          <label for="csv-file">Choose CSV File:</label>
          <input type="file" id="csv-file" name="csv_file" accept=".csv" required>
        </div>
      </div>
      <button type="submit" class="save-btn">Upload</button>
    </form>
  </div>
</div>

<div id="payment-modal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closePaymentModal()">X</span>
    <h2>Record Payment</h2>
    <form id="payment-form" method="POST" action="coop_members_payments_process.php">
      <input type="hidden" id="loan_id" name="loan_id">
      <div class="grid-fields">
        <div class="grid-fields-label">
          <label for="payment_amount">Payment Amount:</label>
          <input type="number" id="payment_amount" name="payment_amount" placeholder="Enter payment amount" required>
        </div>
        <div class="grid-fields-label">
          <label for="OR_number">O.R Number:</label>
          <input type="text" id="OR_number" name="OR_number" placeholder="Enter O.R number" required>
        </div>
        <div class="grid-fields-label">
          <label for="payment_date">Payment Date:</label>
          <input type="date" id="payment_date" name="payment_date" required>
        </div>
      </div>
      <button type="submit" class="save-btn">Submit Payment</button>
    </form>
  </div>
</div>


<style> 
  .content-member{
    background-color: gray;
  }
</style>

<script>

// Function to open the payment modal
function openPaymentModal(loanId) {
    document.getElementById("loan_id").value = loanId;
    document.getElementById("payment-modal").style.display = "flex";
}

// Function to close the payment modal
function closePaymentModal() {
    document.getElementById("payment-modal").style.display = "none";
}

// Function to open the add loan modal
function openAddLoanModal() {
    document.getElementById("add-loan-modal").style.display = "flex";
}

// Function to close the add loan modal
function closeAddLoanModal() {
    document.getElementById("add-loan-modal").style.display = "none";
}

// Function to open the upload CSV modal
function openUploadloanModal() {
    document.getElementById("upload-loan-modal").style.display = "flex";
}

// Function to close the upload CSV modal
function closeUploadloanModal() {
    document.getElementById("upload-loan-modal").style.display = "none";
}

// Close modals when clicking outside the modal content
window.onclick = function(event) {
    const paymentModal = document.getElementById("payment-modal");
    const addLoanModal = document.getElementById("add-loan-modal");
    const uploadLoanModal = document.getElementById("upload-loan-modal");

    if (event.target === paymentModal) {
        paymentModal.style.display = "none";
    }
    if (event.target === addLoanModal) {
        addLoanModal.style.display = "none";
    }
    if (event.target === uploadLoanModal) {
        uploadLoanModal.style.display = "none";
    }
};

// Modal steps functionality
let currentStep = 1;

function nextStep(step) {
    document.getElementById("step-" + step).style.display = "none";
    currentStep = step + 1;
    document.getElementById("step-" + currentStep).style.display = "block";
}

function prevStep(step) {
    document.getElementById("step-" + step).style.display = "none";
    currentStep = step - 1;
    document.getElementById("step-" + currentStep).style.display = "block";
}

// Initially show the first step
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("step-1").style.display = "block";
});
  // Your existing modal open/close functions here...

  function closeEditLoanModal() {
    document.getElementById('edit-loan-modal').style.display = 'none';
  }

  function openEditLoanModal(
    loanId, membershipId, loanAmount, typeOfLoan, term, dateOfLoan, paymentDate, 
    insurancePremium, coMakers, birthdayOfMember, rate, monthlyPayment, ORNumber
  ) {
    document.getElementById('edit_loan_id').value = loanId;
    document.getElementById('edit_membership_id').value = membershipId;
    document.getElementById('edit_loan_amount').value = parseFloat(loanAmount).toFixed(2);
    document.getElementById('edit_type_of_loan').value = typeOfLoan;
    document.getElementById('edit_term').value = term;
    document.getElementById('edit_date_of_loan').value = dateOfLoan;
    document.getElementById('edit_payment_date').value = paymentDate;
    document.getElementById('edit_insurance_premium').value = parseFloat(insurancePremium).toFixed(2);
    document.getElementById('edit_co_makers').value = coMakers;
    document.getElementById('edit_birthday_of_member').value = birthdayOfMember;
    document.getElementById('edit_rate').value = parseFloat(rate).toFixed(2);
    document.getElementById('edit_monthly_payment').value = parseFloat(monthlyPayment).toFixed(2);
    document.getElementById('edit_OR_number').value = ORNumber;

    document.getElementById('edit-loan-modal').style.display = 'flex';
  }



// Search functionality
function searchTable() {
    const query = document.getElementById("search-bar").value.toLowerCase();
    const table = document.getElementById("loan-table");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        let rowContainsQuery = false;

        for (let j = 0; j < cells.length; j++) {
            if (cells[j].textContent.toLowerCase().includes(query)) {
                rowContainsQuery = true;
                break;
            }
        }

        if (rowContainsQuery) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}




</script>


