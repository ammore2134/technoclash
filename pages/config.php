<?php
// Database Configuration
define("DB_HOST", "localhost");  // Change if needed
define("DB_USER", "root");       // Default user for XAMPP
define("DB_PASS", "");           // Default is empty for XAMPP
define("DB_NAME", "technoclash_db"); // Your database name

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character encoding
$conn->set_charset("utf8");

?>

