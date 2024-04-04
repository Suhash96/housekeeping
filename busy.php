<?php
// busy.php

// Assuming you have a database connection established
require_once('dbh.php'); // Include your database connection code here

// Retrieve data from the AJAX request
$workerName = $_POST['worker_name'];
$status = $_POST['status'];
echo "Worker Name: $workerName, Status: $status";

// Perform the database update
// Example query: Update the 'busy' status in the 'userinfo' table
// Adjust this query based on your actual database schema
$query = "UPDATE userinfo SET busy = " . ($status === 'completed' ? 1 : 0) . " WHERE worker_name = '$workerName'";

// Execute the query
$result = mysqli_query($conn, $query); // Assuming $conn is your database connection variable

// Check if the query was successful
if ($result) {
    echo "Status updated successfully";
} else {
    echo "Error updating status: " . mysqli_error($conn);
}
?>