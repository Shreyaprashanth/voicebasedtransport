<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "transport_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the 'transport' table
$sql = "SELECT * FROM transport";
$result = $conn->query($sql);

// Display the data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Type: " . $row["transport_type"] . 
             ", Destination: " . $row["destination"] . 
             ", Price: $" . $row["price"] . "<br>";
    }
} else {
    echo "No data found in the table.";
}

// Close the connection
$conn->close();
?>
