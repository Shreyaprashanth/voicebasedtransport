<!DOCTYPE html>
<html>
<head>
    <title>Search Transport</title>
</head>
<body>
    <h1>Search Transport Options</h1>
    <form method="POST" action="">
        <label for="destination">Enter Destination:</label>
        <input type="text" id="destination" name="destination" required>
        <button type="submit">Search</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
        $conn = new mysqli("localhost", "root", "", "transport_db");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the user input
        $destination = $conn->real_escape_string($_POST["destination"]);

        // Search the database
        $sql = "SELECT * FROM transport WHERE destination LIKE '%$destination%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Search Results:</h2>";
            while ($row = $result->fetch_assoc()) {
                echo "Type: " . $row["transport_type"] . 
                     ", Destination: " . $row["destination"] . 
                     ", Price: $" . $row["price"] . "<br>";
            }
        } else {
            echo "No results found for '$destination'.";
        }

        // Close the connection
        $conn->close();
    }
    ?>
</body>
</html>
