<?php
session_start();
require_once('process/dbh.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $floor_no = $_POST['floor_no'];
    $selectedClassroom = $_POST['selected_classroom'];

    // Insert the selected classroom into the scheduled_job table
    $sql = "INSERT INTO scheduled_job (floor_no, classroom) VALUES ('$floor_no', '$selectedClassroom')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Classroom '$selectedClassroom' has been assigned.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
