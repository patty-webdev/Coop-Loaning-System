<?php 
include 'header.php'; 
include 'sidebar.php'; 

?>

<link rel="stylesheet" href="assets/coop_members_shared_capitals.css">
<link rel="stylesheet" href="assets/message.css">
<link rel="stylesheet" href="assets/loader.css">
<script src="assets/script.js"></script>


<main class="content-member">
  <section class="stats-member">
    <div class="card-member">
      <div class="card-header-member">
        <h2>Shared Capital Members</h2>
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
                <button onclick="openAddMemberModal()">Add SC Members</button>
                <button onclick="window.location.href='export_shared_capitals_pdf.php'" class="export-pdf-btn">Export to PDF</button>
                <a href="coop_members_shared_capitals_generate_csv.php"><button>Export CSV</button></a>   

                <button onclick="openUploadCSVModal()">Upload CSV</button>   
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

    <div id="loader" class="loader-overlay">
      <div class="loader"></div>
    </div>


    </br>

      <div style="overflow-x:auto;">
        <table id="member-table">
          <thead>
            <tr>
              <th>Membership ID</th>
              <th>Name</th>
              <th>Date Added</th>
              <th>Remarks</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
             $search = isset($_GET['search']) ? trim($_GET['search']) : '';

             // Base SQL query
             $sql = "SELECT sc.id, sc.Membership_ID, sc.Date_Added, cm.name_of_member, sc.status, sc.Remarks 
                     FROM coop_members_shared_capital sc
                     LEFT JOIN coop_members cm ON sc.Membership_ID = cm.membership_id
                     WHERE sc.Remarks IS NULL OR sc.Remarks != 'Deleted'";
 
             // Apply search filter
             if (!empty($search)) {
                 $search = $conn->real_escape_string($search);
                 $sql .= " AND (sc.Membership_ID LIKE '%$search%' OR cm.name_of_member LIKE '%$search%')";
             }
            $sql .= " ORDER BY cm.name_of_member ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $status = $row['status'];
                    echo '<tr>';
                    echo '<td hidden>' . htmlspecialchars($row['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['Membership_ID']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['name_of_member']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['Date_Added']) . '</td>';
                    echo '<td>';
                    echo $status == 1 ? '<span class="remark-active">Active</span>' : '<span class="remark-withdrawn">Withdrawn</span>';
                    echo '</td>';
                    echo '<td style="padding-left: 50px;">';
                    echo '<a href="#" onclick="openContributionModal(\'' . $row['Membership_ID'] . '\', \'' . $row['id'] . '\', ' . $row['status'] . ')"><button> <i class="fas fa-plus-circle"></i>Add Contribution</button></a>';
                    echo '<a href="coop_members_shared_capitals_delete_functions.php?id=' . htmlspecialchars($row['Membership_ID']) . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this member?\')"><button><i class="fa-solid fa-trash"></i></button></a>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="6">No records found</td></tr>';
            }

            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<!-- Add SC Member Modal -->
<div id="add-sc-member-modal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeAddMemberModal()">&times;</span>
    <h2>Add Member</h2>
    <form id="add-member-form" onsubmit="saveMember(event)" method="POST" action="coop_members_shared_capitals_process.php"  onsubmit="showLoader(event)">
        <div class="grid-fields">
          <div class="grid-fields-label">
            <label for="Membership_ID">Membership ID:</label>
            <input type="text" id="Membership_ID" name="Membership_ID" required>
          </div>
          <div class="grid-fields-label">
            <label for="Date_Added">Date Added:</label>
            <input type="date" id="Date_Added" name="Date_Added" required>
          </div>
        </div>
        <button type="submit" class="save-btn">Save</button>
    </form>
  </div>
</div>

<!-- Add Contribution Modal -->
<div id="add-sc-contribution-modal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeContributionModal()">&times;</span>
    <h2>Add Contribution</h2>
    <form id="add-contribution-form" method="POST" action="coop_members_shared_capitals_contribution_process.php">
    <input type="text" id="ID" name="id" required hidden>
        <div class="grid-fields">
          <div class="grid-fields-label">
            <label>Amount</label>
            <input type="text" name="Amount" class="form-control" pattern="^\d*\.?\d{0,2}$" placeholder="0.00" required>
          </div>

        <div class="grid-fields-label">
          <label>Particulars</label>
          <input type="text" name="particulars" class="form-control" required>
        </div>
          <div class="grid-fields-label">
            <label>Date Added</label>
            <input type="date" name="Date_Paid" class="form-control" required>
          </div>
        </div>
        <button type="submit" class="save-btn">Save</button>
    </form>
  </div> 
</div>

<div id="upload-csv-modal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeUploadCSVModal()">&times;</span>
    <h2>Upload CSV</h2>
    <form id="upload-csv-form" method="POST" action="coop_members_shared_capitals_import_csv.php" enctype="multipart/form-data">
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

function showLoader(event) {
    event.preventDefault();  // Stop the form from submitting instantly
    document.getElementById("loader").style.display = "flex";  // Show loader

    // Submit the form after a short delay (for the loader to be visible)
    setTimeout(() => {
        event.target.submit();  // Submit the form after delay
    }, 2000);  // Adjust delay (2 seconds) so the loader is visible long enough
}



// Modal functionality
function openAddMemberModal() {
    document.getElementById("add-sc-member-modal").style.display = "flex";
}

function closeAddMemberModal() {
    document.getElementById("add-sc-member-modal").style.display = "none";
}

// Open the Add Contribution Modal
function openContributionModal(Membership_ID, id, status) {
    if (status == 0) {
        alert('This member is withdrawn. Contribution cannot be added.');
        return;
    }
    document.getElementById('ID').value = id;
    document.getElementById('add-sc-contribution-modal').style.display = 'flex';
}

function closeContributionModal() {
    document.getElementById('add-sc-contribution-modal').style.display = 'none';
}

// Close modal if clicked outside
window.onclick = function(event) {
    if (event.target == document.getElementById('add-sc-contribution-modal')) {
        closeContributionModal();
    }
};


// Functions to open and close the upload CSV modal
function openUploadCSVModal() {
  document.getElementById("upload-csv-modal").style.display = "flex";
}

function closeUploadCSVModal() {
  document.getElementById("upload-csv-modal").style.display = "none";
}
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


