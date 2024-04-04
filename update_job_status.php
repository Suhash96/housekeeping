<?php
// update_job_status.php

require_once('process/dbh.php'); // Include your database connection code here

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the necessary parameters are present
    if (isset($_POST['job_id']) && isset($_POST['status'])) {
        $job_id = $_POST['job_id'];
        $status = $_POST['status'];

        // Update the job status in the database
        $updateSql = "UPDATE job SET status = '$status' WHERE job_id = '$job_id'";
        $updateResult = mysqli_query($conn, $updateSql);

        if ($updateResult) {
            // Return success if the update was successful
            echo 'success';
        } else {
            // Return an error message if the update failed
            echo 'Error updating job status: ' . mysqli_error($conn);
        }
    } else {
        // Return an error message if parameters are missing
        echo 'Missing parameters';
    }
} else {
    // Return an error message for an invalid request method
    echo 'Invalid request method';
}
?>
