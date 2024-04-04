
<?php
session_start();

$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root";
$password = "";
$dbname = "housekeeping";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected worker's firstName from the POST request
if (isset($_POST['selected_worker'])) {
    $selectedWorkerFirstName = $_POST['selected_worker'];

    // Insert the selected worker's firstName into the job table
    $sql = "INSERT INTO job (worker_name) VALUES ('$selectedWorkerFirstName')";

    if ($conn->query($sql) === TRUE) {
        echo "Job scheduled successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
