<?php
// Retrieve first names based on job_id
if (isset($_POST['job_id'])) {
    $job_id = $_POST['job_id'];

    // Replace 'your_username', 'your_password', and 'your_database' with your actual MySQL credentials
    $conn = mysqli_connect("localhost", "your_username", "your_password", "your_database");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT assigned_classroom, assigned_classroom2, assigned_classroom3, assigned_classroom4, assigned_classroom5, assigned_classroom6, assigned_classroom7, assigned_classroom8, assigned_classroom9 FROM your_table WHERE job_id = '$job_id'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }

    $firstNames = array();
    while ($row = mysqli_fetch_assoc($result)) {
        // Adjust the keys based on your database columns
        $firstNames[] = $row['assigned_classroom'];
        $firstNames[] = $row['assigned_classroom2'];
        $firstNames[] = $row['assigned_classroom3'];
        $firstNames[] = $row['assigned_classroom4'];
        $firstNames[] = $row['assigned_classroom5'];
        $firstNames[] = $row['assigned_classroom6'];
        $firstNames[] = $row['assigned_classroom7'];
        $firstNames[] = $row['assigned_classroom8'];
        $firstNames[] = $row['assigned_classroom9'];
    }

    echo json_encode($firstNames);

    mysqli_close($conn);
} else {
    echo "Job ID not provided.";
}
?>
