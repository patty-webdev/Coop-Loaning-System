<?php
// connect.php - Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coop_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    // Display an error message if connection fails
    die("<h1>No connection</h1><p>Please start the XAMPP server.</p>");
}

if (!function_exists('logAction')) {
    function logAction($conn, $userId, $username, $action, $details = null) {
        $sql = "INSERT INTO system_logs (user_id, username, action, details) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $userId, $username, $action, $details);
        $stmt->execute();
        $stmt->close();
    }
}
?>