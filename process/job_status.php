<?php
require_once('dbh.php'); // Include your database connection file.

// Check if the job_id parameter is set in the URL
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

    // Retrieve job details from the database for the given job ID
    $selectJobSql = "SELECT * FROM job WHERE id = $job_id";
    $result = mysqli_query($conn, $selectJobSql);

    if ($result && mysqli_num_rows($result) > 0) {
        $jobDetails = mysqli_fetch_assoc($result);

        // Display job status details
        echo "Job ID: " . $jobDetails['id'] . "<br>";
        echo "From Date: " . $jobDetails['from_date'] . "<br>";
        echo "To Date: " . $jobDetails['to_date'] . "<br>";
        echo "Floor Number: " . $jobDetails['floor_no'] . "<br>";
        echo "Supervisor: " . $jobDetails['supervisor'] . "<br>";

        // You can add more job status details as needed.

    } else {
        echo "Job not found.";
    }
} else {
    echo "Job ID parameter is missing.";
}

mysqli_close($conn);
?>
