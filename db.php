<?php
// db.php - Central database connection handler
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_management_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
