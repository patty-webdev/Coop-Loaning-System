<?php 
include 'header.php'; 
include 'sidebar.php';

?>

<link rel="stylesheet" href="assets/coop_members_shared_capitals.css">
<link rel="stylesheet" href="assets/message.css">
<script src="assets/script.js"></script>

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
            
            <!-- Filter Controls -->
            <div class="filter-controls" style="display: inline-block; margin: 0 10px;">
              <select id="filter-year" style="padding: 5px; margin-right: 5px;">
                <option value="">All Years</option>
                <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
              </select>
              
              <select id="filter-month" style="padding: 5px; margin-right: 5px;">
                <option value="">All Months</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
              
              <label style="margin-left: 10px;">
                <input type="checkbox" id="alphabetical-sort" checked> Alphabetical Order
              </label>
            </div>
            
            <div class="dropdown">
              <button class="add-btn" onclick="toggleDropdown()">
                  <i class="fas fa-user-plus"></i> Actions
              </button>
              <div id="dropdown-menu" class="dropdown-content">
                <button onclick="exportToPDF()" class="export-pdf-btn">Export to PDF</button>
              </div>
            </div>
        </div>
      </div>

     <?php
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
              <th>TIN</th>
              <th>Amount Paid-up Shared Capital</th>
            </tr>
          </thead>
          <tbody>
            <?php

          

            $sql = "SELECT cm.coop_id, cm.membership_id, cm.name_of_member, cm.tin, 
                           COALESCE(SUM(sca.amount), 0) AS total_contribution
                    FROM coop_members cm
                    LEFT JOIN shared_capital_amount sca ON cm.membership_id = sca.membership_id
                    WHERE cm.remarks IS NULL OR cm.remarks != 'Deleted'
                    GROUP BY cm.membership_id, cm.name_of_member, cm.tin, cm.coop_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td><a href='coop_members_profile.php?id=" . htmlspecialchars($row['membership_id']) . "'>" . htmlspecialchars($row['membership_id']) . "</a></td>";
                  echo "<td>" . htmlspecialchars($row['name_of_member']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['tin']) . "</td>"; 
                  echo "<td>₱" . number_format($row['total_contribution'], 2) . "</td>"; 
                  echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No members found</td></tr>";
            }
            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<script>
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

// Toggle dropdown functionality
function toggleDropdown() {
    const dropdown = document.getElementById("dropdown-menu");
    if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "block";
    }
}

// Export to PDF with filters
function exportToPDF() {
    const year = document.getElementById('filter-year').value;
    const month = document.getElementById('filter-month').value;
    const alphabetical = document.getElementById('alphabetical-sort').checked ? '1' : '0';
    
    let url = 'coop_members_pusc_tin_export_pdf.php?';
    const params = [];
    
    if (year) params.push('year=' + year);
    if (month) params.push('month=' + month);
    params.push('alphabetical=' + alphabetical);
    
    url += params.join('&');
    window.location.href = url;
}

// Close dropdown when clicking outside
window.onclick = function(event) {
    if (!event.target.matches('.add-btn')) {
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.style.display === "block") {
                openDropdown.style.display = "none";
            }
        }
    }
}
</script>
