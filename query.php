<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "transport_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user inputs
$start = $_POST['start_point'];
$end = $_POST['end_point'];
$time_start = $_POST['departure_time_start'];
$time_end = $_POST['departure_time_end'];
$max_price = $_POST['max_price'];

// Base query
$sql = "SELECT r.route_name, s.departure_time, s.arrival_time, f.price 
        FROM routes r
        JOIN schedule s ON r.route_id = s.route_id
        JOIN fares f ON r.route_id = f.route_id
        WHERE r.start_point = '$start' AND r.end_point = '$end'";

// Apply time range filter if provided
if (!empty($time_start) && !empty($time_end)) {
    $sql .= " AND s.departure_time BETWEEN '$time_start' AND '$time_end'";
}

// Apply max price filter if provided
if (!empty($max_price)) {
    $sql .= " AND f.price <= $max_price";
}

// Execute query
$result = $conn->query($sql);

// Display results
if ($result->num_rows > 0) {
    echo "<h2>Available Routes:</h2><ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>Route: " . $row['route_name'] . "<br> 
              Departure: " . $row['departure_time'] . "<br> 
              Arrival: " . $row['arrival_time'] . "<br> 
              Fare: $" . $row['price'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<h2>No routes found for the given criteria.</h2>";
}

$conn->close();
?>

