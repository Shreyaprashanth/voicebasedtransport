<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";

// Connect to MySQL server
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

// Step 1: Create Database
$sql = "CREATE DATABASE IF NOT EXISTS transport_db";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the newly created database
$conn->select_db("transport_db");

// Step 2: Create Table
$sql = "CREATE TABLE IF NOT EXISTS transport (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transport_type VARCHAR(50) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Step 3: Insert Data
$sql = "INSERT INTO transport (transport_type, destination, price) VALUES
    ('Bus', 'new york', 25.00),
    ('Bus', 'Boston', 50.00),
    ('Bus', 'Los Angeles', 200.00)";
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully<br>";
} else {
    echo "Error inserting data: " . $conn->error . "<br>";
}

// Close the connection
$conn->close();
?>
