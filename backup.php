<?php
include('config/config.php');

if (isset($_POST['backup'])) {
    // Set the backup directory
    $backupDir = __DIR__ . '/backup'; // Folder named 'backup'

    // Create the backup folder if it doesn't exist
    if (!is_dir($backupDir)) {
        mkdir($backupDir, 0777, true); // Create the directory with permissions
    }

    // Define the backup file path
    $backupFile = $backupDir . '/backup_' . date('Y-m-d_H-i-s') . '.sql';
    $sqlContent = "";

    // Get all tables in the database
    $tables = $conn->query("SHOW TABLES");
    while ($row = $tables->fetch_row()) {
        $table = $row[0];

        // Get CREATE TABLE statement
        $createTable = $conn->query("SHOW CREATE TABLE $table")->fetch_row();
        $sqlContent .= $createTable[1] . ";\n\n";

        // Get INSERT statements for each table
        $rows = $conn->query("SELECT * FROM $table");
        while ($row = $rows->fetch_assoc()) {
            $values = array_map([$conn, 'real_escape_string'], array_values($row));
            $sqlContent .= "INSERT INTO $table VALUES ('" . implode("','", $values) . "');\n";
        }
        $sqlContent .= "\n";
    }

    // Save the SQL content to the backup file
    if (file_put_contents($backupFile, $sqlContent)) {
        // Redirect with success
        header("Location: index.php?success=1&message=Backup successful! File saved to the backup folder.");
        exit;
    } else {
        // Redirect with error
        header("Location: index.php?error=1&message=Backup failed. Please try again.");
        exit;
    }
}
?>
