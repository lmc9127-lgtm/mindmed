<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "mindmend_db";

try {
    
    $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
    $conn = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

} catch (PDOException $e) {
    // Detailed error output for debugging your post creation issue
    echo "<div style='background: #ffebee; color: #c62828; padding: 15px; margin: 15px; border-radius: 5px; font-family: monospace;'>";
    echo "<strong>Database Error:</strong> " . htmlspecialchars($e->getMessage());
    echo "</div>";
    exit();
}

?>