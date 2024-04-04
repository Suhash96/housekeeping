<?php
session_start();
require_once('process/dbh.php');

if (isset($_POST['job_id'])) {
    $job_id = $_POST['job_id'];

    // Assuming you have a 'status' column in your job table
    $sql = "UPDATE job SET status = 'completed' WHERE job_id = '$job_id'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error updating status: " . mysqli_error($conn));
    }

    if (mysqli_affected_rows($conn) > 0) {
        echo "Status updated successfully.";

        // Check if the status is 'completed' and update worker busy status
        if (isset($_POST['status']) && $_POST['status'] == 'completed') {
            // Retrieve assigned workers from columns
            $columns = ['assigned_classroom', 'assigned_classroom2', 'assigned_classroom3', 'assigned_classroom4', 'assigned_classroom5', 'assigned_classroom6', 'assigned_classroom7', 'assigned_classroom8', 'assigned_classroom9'];

            foreach ($columns as $column) {
                $select_assigned_sql = "SELECT $column FROM job WHERE job_id = '$job_id'";
                $select_assigned_result = mysqli_query($conn, $select_assigned_sql);

                if ($select_assigned_result) {
                    $row = mysqli_fetch_assoc($select_assigned_result);
                    $assignedWorkers = explode(", ", $row[$column]);

                    echo "Assigned Workers: " . implode(", ", $assignedWorkers) . "<br>";

                    // Update busy status for each assigned worker
                    foreach ($assignedWorkers as $workerName) {
                        $update_busy_sql = "UPDATE userinfo SET busy = 0 WHERE firstName = '$workerName'";
                        $update_busy_result = mysqli_query($conn, $update_busy_sql);

                        if (!$update_busy_result) {
                            die("Error updating busy status for $workerName: " . mysqli_error($conn));
                        } else {
                            echo "Busy status updated for $workerName<br>";
                        }
                    }
                } else {
                    die("Error selecting assigned workers: " . mysqli_error($conn));
                }
            }

            // Delete the job
            $delete_sql = "DELETE FROM job WHERE job_id = '$job_id'";
            $delete_result = mysqli_query($conn, $delete_sql);
            if ($delete_result) {
                echo "Job deleted successfully.";
            } else {
                die("Error deleting job: " . mysqli_error($conn));
            }
        }
    } else {
        die("No rows were updated.");
    }
} else {
    die("Job ID not provided.");
}
?>