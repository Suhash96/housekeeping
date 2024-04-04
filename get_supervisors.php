<?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "housekeeping";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch supervisors from the userinfo table where designation is Supervisor
$sql = "SELECT * FROM userinfo WHERE designation = 'Supervisor'";
$result = $conn->query($sql);

$supervisors = array();

if ($result->num_rows > 0) {
    // Fetch data and store it in an array
    while($row = $result->fetch_assoc()) {
        $supervisor = array(
            'bio_id' => $row['bio_id'],
            'firstName' => $row['firstName']
            // Add other properties as needed
        );
        $supervisors[] = $supervisor;
    }
}

// Close the database connection
$conn->close();

// Output the supervisors array as JSON
header('Content-Type: application/json');
echo json_encode($supervisors);
?>
