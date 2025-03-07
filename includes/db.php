<?php
// Database configuration
$host = 'localhost'; // Database host (usually localhost)
$db_name = 'technoclash'; // Database name
$username = 'root'; // Database username (replace with your actual username if different)
$password = ''; // Database password (replace with your actual password if set)

// Create a connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8
$conn->set_charset("utf8");

// Optional: Enable error reporting for debugging (remove in production)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// You can also define a function to close the connection
function closeConnection($conn) {
    $conn->close();
}

// Example usage: Uncomment the line below to close the connection when done
// closeConnection($conn);
?>