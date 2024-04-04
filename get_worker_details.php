<?php
session_start();
require_once('process/dbh.php');

// Check if the job_id parameter is set in the POST data
if (isset($_POST['job_id'])) {
    $job_id = $_POST['job_id'];

    // SQL query to retrieve worker details based on job_id
    $sql = "SELECT worker_details FROM workers WHERE job_id = '$job_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $worker_details = mysqli_fetch_assoc($result)['worker_details'];
        echo $worker_details;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Job ID not provided.";
}
?>
