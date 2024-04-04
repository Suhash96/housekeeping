<?php
// Database connection parameters
$servername = "localhost"; // Change to your server name
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "housekeeping";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buildingid = $_POST["building_id"];
    $buildingname = $_POST["buildingname"];
    $floorno = $_POST["floor_no"];
    $roomno = $_POST["room_no"];
    $roomtype= $_POST["room_type"];
   
    // Prepare and execute the SQL query to insert data into the 'user_info' table
    $sql = "INSERT INTO building (building_id, buildingname, floor_no, room_no, room_type)
            VALUES ('$buildingid', '$buildingname', '$floorno', '$roomno', '$roomtype')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
