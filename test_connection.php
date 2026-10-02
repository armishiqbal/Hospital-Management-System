<?php
// test_connection.php - Database connectivity test
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_management_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<div style='font-family:sans-serif;padding:30px;color:#721c24;background:#f8d7da;border:1px solid #f5c6cb;border-radius:8px;max-width:600px;margin:50px auto;'>
            <h2>Database Connection Failed</h2>
            <p>Error: " . htmlspecialchars($conn->connect_error) . "</p>
            <p>Make sure Apache and MySQL are running in XAMPP, and import <code>database.sql</code> into phpMyAdmin.</p>
         </div>");
}

echo "<div style='font-family:sans-serif;padding:30px;color:#155724;background:#d4edda;border:1px solid #c3e6cb;border-radius:8px;max-width:600px;margin:50px auto;text-align:center;'>
        <h2>Database Connected Successfully!</h2>
        <p>Host: <strong>{$servername}</strong> | Database: <strong>{$dbname}</strong></p>
        <p><a href='index.html' style='display:inline-block;padding:10px 20px;background:#28a745;color:white;text-decoration:none;border-radius:5px;'>Go to Hospital Management Dashboard</a></p>
      </div>";

$conn->close();
?>
