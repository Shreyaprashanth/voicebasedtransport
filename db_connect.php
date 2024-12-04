<?php
// Database connection details
$host = 'localhost'; // Use 'localhost' for local server
$username = 'root';  // Default username for XAMPP/WAMP
$password = '';      // Default password for XAMPP/WAMP is empty
$dbname = 'transport_db'; // Name of the database you created

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
?>
