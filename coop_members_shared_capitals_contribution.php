<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<link rel="stylesheet" href="assets/coop_members_shared_capitals.css">
<link rel="stylesheet" href="assets/message.css">
<script src="assets/script.js"></script>

<main class="content-member">
  <section class="stats-member">
    <div class="card-member">
      <div class="card-header-member">
        <h2>Shared Capital Amounts</h2>
        <div class="actions">
           <input type="text" id="search-bar" placeholder="Search shared capital..." oninput="searchTable()">
            <button class="search-btn" onclick="searchTable()">
                <i class="fas fa-search"></i>
            </button>
            <div class="dropdown">
              <button class="add-btn" onclick="toggleDropdown()">
                  <i class="fas fa-user-plus"></i> Actions
              </button>
              <div id="dropdown-menu" class="dropdown-content">
              <button onclick="openExportModal()">Export Searched SC</button>   
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
        <table id="shared-capital-table">
          <thead>
            <tr>
              <th>Membership ID</th>
              <th>Name</th>
              <th>Amount</th>
              <th>O.R</th>
              <th>Date Paid</th>
              <th class="th-class">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php

            // SQL query to fetch shared capital data
            $sql = "SELECT id, Membership_ID ,Name, Amount, particulars, Date_Paid FROM shared_capital_amount WHERE remarks IS NULL OR remarks != 'Deleted' ORDER BY Date_Paid ";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td hidden>" . htmlspecialchars($row['id']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['Membership_ID']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                  echo "<td style='text-align: right;'> ₱". number_format($row['Amount'], 2) . "</td>";
                  echo "<td>" . htmlspecialchars($row['particulars']) . "</td>";

                  echo "<td>" . htmlspecialchars($row['Date_Paid']) . "</td>";
                  echo "<td style='display: flex; justify-content: space-between; align-items: center;'>";
                  echo "<button class='edit-btn' onclick='populateEditModal(" . htmlspecialchars($row['id']) . ", `" . htmlspecialchars($row['Amount']) . "`, `" . htmlspecialchars($row['particulars']) . "`, `" . htmlspecialchars($row['Date_Paid']) . "`)'><i class='fa-solid fa-pen-to-square'></i> Edit</button>";
                  echo '<a href="coop_members_shared_capitals_contribution_delete_functions.php?id=' . htmlspecialchars($row['id']) . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this contribution?\')"><button><i class="fa-solid fa-trash"></i></button></a>';
                  echo "</td>";
                  echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No shared capital records found</td></tr>";
            }

            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<!-- Edit Contribution Modal -->
<div id="edit-sc-contribution-modal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeEditModal()">&times;</span>
    <h2>Edit Contribution</h2>
    <form id="edit-contribution-form" method="POST" action="coop_members_shared_capitals_contribution_edit.php">

      <input type="text" id="edit-ID" name="id" required hidden>

      <div class="grid-fields">
        <div class="grid-fields-label">
          <label>Amount</label>
            <input type="text" id="edit-Amount" name="Amount" class="form-control" pattern="^\d*\.?\d{0,2}$" placeholder="0.00" required>
        </div>
        <div class="grid-fields-label">
          <label>O.R. Number</label>
          <input type="text" id="edit-Particulars" name="particulars" class="form-control" placeholder="Enter O.R. Number" required>
        </div>
        <div class="grid-fields-label">
          <label>Date Added</label>
          <input type="date" id="edit-Date_Paid" name="Date_Paid" class="form-control" required>
        </div>
      </div>
      <button type="submit" class="save-btn">Save Changes</button>
    </form>
  </div>
</div>

<!-- Export SC Modal -->
<div id="export-sc-modal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeExportSCModal()">&times;</span>
    <h2>Export Shared Capital Data</h2>
    <form id="export-sc-form" method="POST" action="coop_members_shared_capitals_contribution_export.php">
      <div class="grid-fields">
        <div class="grid-fields-label">
          <label for="export-membership-id">Membership ID:</label>
          <input type="text" id="export-membership-id" name="Membership_ID" required>
        </div>
      </div>
      <button type="submit" class="save-btn">Export</button>
    </form>
  </div>
</div>


<style> 
  .grid{
    display: flex;
    justify-content: space-between;
  }
  .th-class{
    width: 100px;
  }

  .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    border-radius: 5px;
    width: 40%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.close-btn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close-btn:hover {
    color: #000;
}

.grid-fields {
    display: flex;
    gap: 10px;
}

.grid-fields-label {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.save-btn {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 3px;
}

.save-btn:hover {
    background-color: #218838;
}


  .content-member{
    background-color: gray;
  }


</style>

<script>

// Function to open the edit modal and pre-fill the fields with the existing values
function populateEditModal(id, amount, particulars, datePaid) {
    // Set the ID (hidden input value)
    document.getElementById("edit-ID").value = id;

    // Set the amount, particulars, and date in the input fields
    document.getElementById("edit-Amount").value = amount;
    document.getElementById("edit-Particulars").value = particulars;
    document.getElementById("edit-Date_Paid").value = datePaid;

    // Open the modal
    openEditModal();
}

// Function to open the edit modal
function openEditModal() {
    const modal = document.getElementById("edit-sc-contribution-modal");
    modal.style.display = "block";
}

// Function to close the edit modal
function closeEditModal() {
    const modal = document.getElementById("edit-sc-contribution-modal");
    modal.style.display = "none";
}

// Event listener to close modal when clicking outside of it
window.onclick = function(event) {
    const modal = document.getElementById("edit-sc-contribution-modal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
};







// for search function
function searchTable() {
    // Get the search query from the input field
    const query = document.getElementById("search-bar").value.toLowerCase();

    // Get the table and all rows
    const table = document.getElementById("shared-capital-table");
    const rows = table.getElementsByTagName("tr");

    // Loop through all rows, excluding the table header
    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        let rowContainsQuery = false;

        // Check if any cell in the row contains the query
        for (let j = 0; j < cells.length; j++) {
            if (cells[j].innerText.toLowerCase().includes(query)) {
                rowContainsQuery = true;
                break;
            }
        }

        // Show or hide the row based on the query match
        rows[i].style.display = rowContainsQuery ? "" : "none";
    }
}

  // Function to hide success and error messages after 5 seconds
  function hideMessage() {
    setTimeout(function() {
      const messages = document.querySelectorAll('.message');
      messages.forEach(message => {
        message.style.display = 'none';
      });
    }, 5000);
  }

  function openExportSCModal() {
  document.getElementById("export-sc-modal").style.display = "flex";
}

function closeExportSCModal() {
  document.getElementById("export-sc-modal").style.display = "none";
}

// Unified event listener to close modals when clicking outside
window.onclick = function(event) {
    if (event.target == document.getElementById("edit-sc-contribution-modal")) {
        closeEditModal();
    }
    if (event.target == document.getElementById("export-sc-modal")) {
        closeExportSCModal();
    }
};

// Ensure "Export Searched SC" button opens modal
document.querySelector(".dropdown-content button").addEventListener("click", openExportSCModal);
</script>

</body>
</html>
