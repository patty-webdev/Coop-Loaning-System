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
        <h2>Members List</h2>
        <div class="actions">
           <input type="text" id="search-bar" placeholder="Search members..." oninput="searchTable()">
            <button class="search-btn" onclick="searchTable()">
                <i class="fas fa-search"></i>
            </button>
            <!-- Dropdown Button for Add Member, Import and Export -->
            <div class="dropdown">
              <button class="add-btn" onclick="toggleDropdown()">
                  <i class="fas fa-user-plus"></i> Actions
              </button>
              <div id="dropdown-menu" class="dropdown-content">
                <button onclick="openAddMemberModal()">Add Member</button>
                <button onclick="window.location.href='export_members_pdf.php'" class="export-pdf-btn">Export to PDF</button>
                
                <a href="coop_members_generate_csv.php"><button>Export CSV</button></a>
                <button onclick="openUploadCSVModal()">Upload CSV</button> <!-- New button for uploading CSV -->
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
        <table id="member-table">
          <thead>
            <tr>
              <th>Membership ID</th>
              <th>Name of Member</th>
              <th>Contact Number</th>
              <th>TIN</th>
              <th>Date Accepted</th>
              <th>Type of Membership</th>
              <th>Shares Subscribed</th>
              <th>Amount Subscribed</th>
              <th>Initial Paid Up</th>
              <th>Address</th>
              <th>Date of Birth</th>
              <th>Age</th>
              <th>Gender</th>
              <th>Civil Status</th>
              <th>Occupation</th>
              <th>Number of Dependents</th>
              <th>Religious</th>
              <th>Annual Income</th>
              <th>Highest Education</th>
              <th>BOD Resolution</th>
              <th>Status</th>
              <th class="th-class">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php

            // SQL query to fetch members
            $sql = "SELECT coop_id, membership_id, name_of_member, contact_number, tin, date_accepted, type_of_membership, shares_subscribed, amount_subscribed, initial_paid_up, address, date_of_birth, age, gender, civil_status, occupation, number_of_dependents, religious, annual_income, educational_attainment, bod_resolution, status FROM coop_members WHERE remarks IS NULL OR Remarks != 'Deleted'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td hidden>" . htmlspecialchars($row['coop_id']) . "</td>";
                  echo '<td><a href="coop_members_profile.php?id=' . htmlspecialchars($row['membership_id']) . '">' . htmlspecialchars($row['membership_id']) . '</a></td>';
                  echo "<td>" . htmlspecialchars($row['name_of_member']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['contact_number']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['tin']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['date_accepted']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['type_of_membership']) . "</td>";
                  echo "<td style='text-align: right;'> ₱". number_format($row['shares_subscribed'], 2) . "</td>";
                  echo "<td style='text-align: right;'> ₱". number_format($row['amount_subscribed'], 2) . "</td>";
                  echo "<td style='text-align: right;'> ₱". number_format($row['initial_paid_up'], 2) . "</td>";
                  echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['date_of_birth']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['civil_status']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['occupation']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['number_of_dependents']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['religious']) . "</td>";
                  echo "<td style='text-align: right;'> ₱". number_format($row['annual_income'], 2) . "</td>";
                  echo "<td>" . htmlspecialchars($row['educational_attainment']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['bod_resolution']) . "</td>";
                  $statusText = ($row['status'] == 1) ? 'Active' : (($row['status'] == 0) ? 'Withdrawn' : 'Unknown');
                  echo "<td>" . htmlspecialchars($statusText) . "</td>";
                  echo "<td style='display: flex; justify-content: space-between; align-items: center; border'>";
                  echo "<button class='edit-btn' onclick='openEditMemberModal(" . htmlspecialchars($row['coop_id']) . ", \"" . htmlspecialchars($row['name_of_member']) . "\", \"" . htmlspecialchars($row['contact_number']) . "\", \"" . htmlspecialchars($row['tin']) . "\", \"" . htmlspecialchars($row['date_accepted']) . "\", \"" . htmlspecialchars($row['bod_resolution']) . "\", \"" . htmlspecialchars($row['civil_status']) . "\", \"" . htmlspecialchars($row['occupation']) . "\", \"" . htmlspecialchars($row['number_of_dependents']) . "\", \"" . htmlspecialchars($row['type_of_membership']) . "\", \"" . htmlspecialchars($row['shares_subscribed']) . "\", \"" . htmlspecialchars($row['amount_subscribed']) . "\", \"" . htmlspecialchars($row['initial_paid_up']) . "\", \"" . htmlspecialchars($row['address']) . "\", \"" . htmlspecialchars($row['date_of_birth']) . "\", \"" . htmlspecialchars($row['age']) . "\", \"" . htmlspecialchars($row['gender']) . "\", \"" . htmlspecialchars($row['religious']) . "\", \"" . htmlspecialchars($row['annual_income']) . "\")'><i class='fa-solid fa-pen-to-square'></i></button>";
                  echo '<a class="update-btn" href="coop_update_status.php?coop_id=' . $row['membership_id'] . '&status=' . ($row['status'] == 0 ? 1 : 0) . '" onclick="return confirm(\'Are you sure you want to ' . ($row['status'] == 0 ? 'activate' : 'deactivate') . ' this member?\')">';
                      echo ($row['status'] == 0 ? '<button><i class="fas fa-check-circle"></i></button>' : '<button><i class="fas fa-times-circle"></i></button>');
                      echo '</a>';
                      echo '<a href="coop_members_delete_functions.php?id=' . htmlspecialchars($row['membership_id']) . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this member? all data such as Shared Capital Records will be deleted?\')"><button><i class="fa-solid fa-trash"></i></button></a>';
                  echo "</td>";
                  echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='21'>No members found</td></tr>";
            }

            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>




<!-- Modal for adding members -->
<div id="add-member-modal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeAddMemberModal()">&times;</span>
    <h2 class="modal-title">Add Member</h2>

    <form id="add-member-form" onsubmit="saveMember(event)" method="POST" action="coop_members_process.php">
      
      <!-- Step 1 -->
      <div class="form-step" id="step-1">
        <div class="form-grid">
          <label>
            Name of Member
            <input type="text" name="name_of_member" placeholder="Dela Cruz, Juan A." required>
          </label>
          <label>
            Contact Number
            <input type="text" name="contact_number" id="contact_number" maxlength="13" placeholder="0912-345-6789">
          </label>
          <label>
            Educational Attainment
            <select name="educational_attainment">
              <option disabled selected>-- select one --</option>
              <option value="No formal education">No formal education</option>
              <option value="Primary education">Primary education</option>
              <option value="Secondary education">Secondary education or high school</option>
              <option value="GED">GED</option>
              <option value="Vocational qualification">Vocational qualification</option>
              <option value="Bachelor's degree">Bachelor's degree</option>
              <option value="Master's degree">Master's degree</option>
              <option value="Doctorate or higher">Doctorate or higher</option>
            </select>
          </label>
        </div>

        <div class="form-grid">
          <label>
            TIN
            <input type="text" name="tin" id="tin" maxlength="11" placeholder="123-456-789">
          </label>
          <label>
            Date Accepted
            <input type="date" name="date_accepted">
          </label>
          <label>
            BOD Resolution Number
            <input type="text" name="bod_resolution" >
          </label>
        </div>

        <div class="form-grid">
          <label>
            Civil Status
            <select name="civil_status" >
              <option disabled selected>-- select one --</option>
              <option>Single</option>
              <option>Married</option>
              <option>Widowed</option>
              <option>Separated</option>
              <option>Divorced</option>
            </select>
          </label>
          <label>
            Occupation
            <input type="text" name="occupation">
          </label>
          <label>
            Number of Dependents
            <input type="number" name="number_of_dependents">
          </label>
        </div>

        <div class="form-actions">
          <button type="button" class="next-btn" onclick="nextStep(1)">Next ➡️</button>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="form-step" id="step-2" style="display:none;">
        <div class="form-grid">
          <label>
            Type of Membership
            <input type="text" name="type_of_membership" >
          </label>
          <label>
            Shares Subscribed
            <input type="text" name="shares_subscribed" pattern="^\d*\.?\d{0,2}$" placeholder="0.00" >
          </label>
          <label>
            Amount Subscribed
            <input type="text" name="amount_subscribed" pattern="^\d*\.?\d{0,2}$" placeholder="0.00" >
          </label>
          <label>
            Initial Paid Up
            <input type="text" name="initial_paid_up" pattern="^\d*\.?\d{0,2}$" placeholder="0.00" >
          </label>
        </div>

        <div class="form-grid">
          <label>
            Address
            <input type="text" name="address" >
          </label>
          <label>
            Date of Birth
            <input type="date" name="date_of_birth" >
          </label>
          <label>
            Age
            <input type="number" name="age" >
          </label>
          <label>
            Gender
            <select name="gender" >
              <option disabled selected>-- select one --</option>
              <option>Male</option>
              <option>Female</option>
              <option>Non-Binary</option>
              <option>Transgender</option>
              <option>Genderqueer</option>
              <option>Agender</option>
              <option>Bigender</option>
              <option>Genderfluid</option>
              <option>Two-Spirit</option>
              <option>Prefer not to say</option>
              <option>Other</option>
              <option>I prefer to self-describe</option>
            </select>
          </label>
        </div>

        <div class="form-grid">
          <label>
            Religious Affiliation
            <input type="text" name="religious" >
          </label>
          <label>
            Annual Income
            <input type="text" name="annual_income" pattern="^\d*\.?\d{0,2}$" placeholder="0.00" >
          </label>
        </div>

        <div class="form-actions">
          <button type="button" class="prev-btn" onclick="prevStep(2)">⬅️ Previous</button>
          <button type="submit" class="save-btn">💾 Save</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Edit Member Modal -->
<div id="edit-member-modal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeEditMemberModal()">&times;</span>
    <h2>Edit Member</h2>
    <form id="edit-member-form" method="POST" action="coop_members_update.php">
      <input type="hidden" id="edit_coop_id" name="coop_id"> <!-- Hidden ID field -->
      
      <div class="grid-fields">
        <div class="grid-fields-label">
          <label for="edit_name_of_member">Name of Member:</label>
          <input type="text" id="edit_name_of_member" name="name_of_member" >
        </div>
        <div class="grid-fields-label">
          <label for="edit_contact_number">Contact Number:</label>
          <input type="text" name="contact_number" id="edit_contact_number" maxlength="13" placeholder="0912-345-6789">
        </div>
      </div>
      
      <div class="grid-fields">
        <div class="grid-fields-label">
          <label for="edit_tin">TIN:</label>
          <input type="text" id="edit_tin" name="tin" maxlength="11" placeholder="123-456-789">
        </div>
        <div class="grid-fields-label">
          <label for="edit_date_accepted">Date Accepted:</label>
          <input type="date" id="edit_date_accepted" name="date_accepted" >
        </div>
        <div class="grid-fields-label">
          <label for="edit_bod_resolution">BOD Resolution Number:</label>
          <input type="text" id="edit_bod_resolution" name="bod_resolution" >
        </div>
      </div>
      
      <div class="grid-fields">
        <div class="grid-fields-label">
          <label for="edit_civil_status">Civil Status:</label>
          <select id="edit_civil_status" name="civil_status" >
            <option value="">-- select one --</option>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Widowed">Widowed</option>
            <option value="Separated">Separated</option>
            <option value="Divorced">Divorced</option>
          </select>
        </div>
        <div class="grid-fields-label">
          <label for="edit_occupation">Occupation:</label>
          <input type="text" id="edit_occupation" name="occupation" >
        </div>
        <div class="grid-fields-label">
          <label for="edit_number_of_dependents">Number of Dependents:</label>
          <input type="number" id="edit_number_of_dependents" name="number_of_dependents" >
        </div>
      </div>
      
      <div class="grid-fields">
        <div class="grid-fields-label">
          <label for="edit_type_of_membership">Type of Membership:</label>
          <input type="text" id="edit_type_of_membership" name="type_of_membership" >
        </div>
        <div class="grid-fields-label">
          <label for="edit_shares_subscribed">Shares Subscribed:</label>
          <input type="text" id="edit_shares_subscribed" name="shares_subscribed" pattern="^\d*\.?\d{0,2}$" placeholder="0.00" >
        </div>
        <div class="grid-fields-label">
          <label for="edit_amount_subscribed">Amount Subscribed:</label>
          <input type="text" id="edit_amount_subscribed" name="amount_subscribed" pattern="^\d*\.?\d{0,2}$" placeholder="0.00" >
        </div>
        <div class="grid-fields-label">
          <label for="edit_initial_paid_up">Initial Paid Up:</label>
          <input type="text" id="edit_initial_paid_up" name="initial_paid_up" pattern="^\d*\.?\d{0,2}$" placeholder="0.00" >
        </div>
      </div>
      
      <div class="grid-fields">
        <div class="grid-fields-label">
          <label for="edit_address">Address:</label>
          <input type="text" id="edit_address" name="address" >
        </div>
        <div class="grid-fields-label">
          <label for="edit_date_of_birth">Date of Birth:</label>
          <input type="date" id="edit_date_of_birth" name="date_of_birth" >
        </div>
        <div class="grid-fields-label">
          <label for="edit_age">Age:</label>
          <input type="number" id="edit_age" name="age" >
        </div>
        <div class="grid-fields-label">
          <label for="edit_gender">Gender:</label>
          <select id="edit_gender" name="gender" >
            <option value="">-- select one --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Non-Binary">Non-Binary</option>
            <option value="Prefer not to say">Prefer not to say</option>
          </select>
        </div>
      </div>
      
      <div class="grid-fields">
        <div class="grid-fields-label">
          <label for="edit_religious">Religious:</label>
          <input type="text" id="edit_religious" name="religious" >
        </div>
        <div class="grid-fields-label">
          <label for="edit_annual_income">Annual Income:</label>
          <input type="text" id="edit_annual_income" name="annual_income" step="0.01" pattern="^\d*\.?\d{0,2}$" placeholder="0.00" >
        </div>
      </div>
      
      <button type="submit" class="save-btn">Save Changes</button>
    </form>
  </div>
</div>

<div id="upload-csv-modal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeUploadCSVModal()">&times;</span>
    <h2>Upload CSV</h2>
    <form id="upload-csv-form" method="POST" action="coop_members_import_csv.php" enctype="multipart/form-data">
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

<style>
  .content-member{
    background-color: gray;
  }
</style>



<script>


function openEditMemberModal(coopId, name, contactNumber, tin, dateAccepted, bodResolution, civilStatus, occupation, dependents, membershipType, shares, amount, initialPaid, address, dob, age, gender, religious, income) {
    // Set the modal fields with the passed values
    document.getElementById("edit_coop_id").value = coopId;
    document.getElementById("edit_name_of_member").value = name;
    document.getElementById("edit_contact_number").value = contactNumber;
    document.getElementById("edit_tin").value = tin;
    document.getElementById("edit_date_accepted").value = dateAccepted;
    document.getElementById("edit_bod_resolution").value = bodResolution;
    document.getElementById("edit_civil_status").value = civilStatus;
    document.getElementById("edit_occupation").value = occupation;
    document.getElementById("edit_number_of_dependents").value = dependents;
    document.getElementById("edit_type_of_membership").value = membershipType;
    document.getElementById("edit_shares_subscribed").value = parseFloat(shares).toFixed(2);
    document.getElementById("edit_amount_subscribed").value = parseFloat(amount).toFixed(2);
    document.getElementById("edit_initial_paid_up").value = parseFloat(initialPaid).toFixed(2);
    document.getElementById("edit_annual_income").value = parseFloat(income).toFixed(2);
    document.getElementById("edit_initial_paid_up").value = initialPaid;
    document.getElementById("edit_address").value = address;
    document.getElementById("edit_date_of_birth").value = dob;
    document.getElementById("edit_age").value = age;
    document.getElementById("edit_gender").value = gender;
    document.getElementById("edit_religious").value = religious;
    

    // Display the modal
    document.getElementById("edit-member-modal").style.display = "flex";
}
// Close modal for Upload CSV
function closeEditMemberModal() {
    document.getElementById("edit-member-modal").style.display = "none";
}


// Open modal for Add Member
function openAddMemberModal() {
    document.getElementById("add-member-modal").style.display = "flex";
}

// Close modal for Add Member
function closeAddMemberModal() {
    document.getElementById("add-member-modal").style.display = "none";
}

// Open modal for Upload CSV
function openUploadCSVModal() {
    document.getElementById("upload-csv-modal").style.display = "flex";
}

// Close modal for Upload CSV
function closeUploadCSVModal() {
    document.getElementById("upload-csv-modal").style.display = "none";
}

// Update the window.onclick function to include edit modal
window.onclick = function(event) {
    // Check if the clicked target is the modal itself (outside the content area)
    if (event.target == document.getElementById('add-member-modal')) {
        closeAddMemberModal();
    }
    if (event.target == document.getElementById('upload-csv-modal')) {
        closeUploadCSVModal();
    }
    if (event.target == document.getElementById('edit-member-modal')) {
      closeEditMemberModal();
    }
    
}

// Form step navigation
let currentStep = 1;

function nextStep(step) {
    // Hide current step
    document.getElementById("step-" + step).style.display = "none";
    
    // Show next step
    currentStep = step + 1;
    document.getElementById("step-" + currentStep).style.display = "block";
}

function prevStep(step) {
    // Hide current step
    document.getElementById("step-" + step).style.display = "none";
    
    // Show previous step
    currentStep = step - 1;
    document.getElementById("step-" + currentStep).style.display = "block";
}

// Initially show the first step
document.getElementById("step-1").style.display = "block";

// Search functionality
function searchTable() {
    const query = document.getElementById("search-bar").value.toLowerCase();
    const table = document.getElementById("member-table");
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

// <---- script for tin number format ---->

document.getElementById('tin').addEventListener('input', function (e) {
  let value = e.target.value.replace(/\D/g, ''); // Remove all non-digit characters
  if (value.length > 9) value = value.slice(0, 9); // Limit to 9 digits

  // Format as 123-456-789
  let formatted = '';
  if (value.length > 0) formatted = value.slice(0, 3);
  if (value.length > 3) formatted += '-' + value.slice(3, 6);
  if (value.length > 6) formatted += '-' + value.slice(6, 9);

  e.target.value = formatted;
});

document.getElementById('edit_tin').addEventListener('input', function (e) {
  let value = e.target.value.replace(/\D/g, ''); // Remove all non-digit characters
  if (value.length > 9) value = value.slice(0, 9); // Limit to 9 digits

  // Format as 123-456-789
  let formatted = '';
  if (value.length > 0) formatted = value.slice(0, 3);
  if (value.length > 3) formatted += '-' + value.slice(3, 6);
  if (value.length > 6) formatted += '-' + value.slice(6, 9);

  e.target.value = formatted;
});

//<--- script for contact number format ---->
document.getElementById('contact_number').addEventListener('input', function (e) {
  let value = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
  if (value.length > 11) value = value.slice(0, 11); // Max 11 digits for PH mobile number

  let formatted = '';
  if (value.length > 0) formatted = value.slice(0, 4);
  if (value.length > 4) formatted += '-' + value.slice(4, 7);
  if (value.length > 7) formatted += '-' + value.slice(7, 11);

  e.target.value = formatted;
});

//<--- script for contact number format ---->
document.getElementById('edit_contact_number').addEventListener('input', function (e) {
  let value = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
  if (value.length > 11) value = value.slice(0, 11); // Max 11 digits for PH mobile number

  let formatted = '';
  if (value.length > 0) formatted = value.slice(0, 4);
  if (value.length > 4) formatted += '-' + value.slice(4, 7);
  if (value.length > 7) formatted += '-' + value.slice(7, 11);

  e.target.value = formatted;
});

// Add this script to handle decimal number formatting
document.addEventListener('DOMContentLoaded', function() {
    const decimalInputs = document.querySelectorAll('input[type="number"][step="0.01"]');
    
    decimalInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            let value = e.target.value;
            
            // Remove any non-numeric characters except decimal point
            value = value.replace(/[^0-9.]/g, '');
            
            // Ensure only one decimal point
            const parts = value.split('.');
            if (parts.length > 2) {
                value = parts[0] + '.' + parts.slice(1).join('');
            }
            
            // Limit to 2 decimal places
            if (parts[1] && parts[1].length > 2) {
                value = parseFloat(value).toFixed(2);
            }
            
            e.target.value = value;
        });
    });
});

// Add this to your existing script section
function validateDecimalInput(e) {
    let input = e.target;
    let value = input.value;
    
    // Allow backspace and delete
    if (e.key === 'Backspace' || e.key === 'Delete') return true;
    
    // Only allow one decimal point
    if (e.key === '.' && value.includes('.')) {
        e.preventDefault();
        return false;
    }
    
    // Only allow numbers and decimal point
    if (!/^\d*\.?\d*$/.test(value + e.key)) {
        e.preventDefault();
        return false;
    }
    
    // Limit to 2 decimal places
    if (value.includes('.') && value.split('.')[1].length >= 2) {
        e.preventDefault();
        return false;
    }
}

// Add event listeners to all decimal inputs
document.querySelectorAll('input[pattern="^\\d*\\.?\\d{0,2}$"]').forEach(input => {
    input.addEventListener('keydown', validateDecimalInput);
});

</script>



</body>
</html>
