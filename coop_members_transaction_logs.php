<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<link rel="stylesheet" href="assets/coop_members_shared_capitals.css">
<link rel="stylesheet" href="assets/message.css">
<script src="assets/script.js"></script>

<main class="content-member">
  <section class="stats-member">
    <div class="card-member">
      <div class="card-header-member">
        <h2>Transaction Logs</h2>
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

      <div style="overflow-x:auto;">
        <table id="logs-table">
          <thead>
            <tr>
              <th width="5%">ID</th>
              <th width="5%">User ID</th>
              <th width="10%">Username</th>
              <th>Action</th>
              <th>Details</th>
              <th>Timestamp</th>
            </tr>
          </thead>
          <tbody>
            <?php

            // SQL query to fetch transaction logs
            $sql = "SELECT id, user_id, username, action, details, timestamp FROM system_logs ORDER BY timestamp DESC";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['action']) . "</td>";

                  // Decode the JSON and remove curly braces for objects
                  $decodedDetails = json_decode($row['details'], true);
                  // Convert it back to a formatted JSON string without curly braces
                  $formattedDetails = json_encode($decodedDetails, JSON_PRETTY_PRINT);
                  $formattedDetails = preg_replace('/\{|\}/', '', $formattedDetails); // Remove curly braces
                  echo '<td>';
                  echo '<pre class="json-content">' . htmlspecialchars($formattedDetails) . '</pre>';
                  echo '</td>';
                  echo "<td>" . htmlspecialchars($row['timestamp']) . "</td>";
                  echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No logs found</td></tr>";
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
  .content-member{
    background-color: gray;
  }
</style>

</body>
</html>
