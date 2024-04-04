<?php
require_once('dbh.php'); // Include your database connection file.

// Initialize variables for success message and error message
$successMessage = "";
$errorMessage = "";

// Check if the form fields are set before accessing them
if (isset($_POST['from'], $_POST['to'], $_POST['floor_no'], $_POST['supervisor'])) {
    // Retrieve job details from the form
    $from = $_POST['from'];
    $to = $_POST['to'];
    $floor_no = $_POST['floor_no'];
    $supervisor = $_POST['supervisor'];

    // Do not provide a value for the primary key column (e.g., 'id') in the INSERT statement.
    // Let the database automatically generate the primary key value.
    $insertJobSql = "INSERT INTO job (from_date, to_date, floor_no, supervisor) 
                     VALUES ('$from', '$to', '$floor_no', '$supervisor')";

    if (mysqli_query($conn, $insertJobSql)) {
        // Get the auto-generated job ID
        $job_id = mysqli_insert_id($conn);

        // Set the success message
        $successMessage = "The job has been assigned successfully.";
    } else {
        // Handle the case where the insert query fails
        $errorMessage = "Error: " . mysqli_error($conn);
    }
} else {
    // Handle the case where some form fields are not set
    $errorMessage = "Form fields are missing.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Assignment Result</title>
    <style>
        /* Style for the centered box */
        .center-box {
            text-align: center;
            margin: 20% auto;
            padding: 20px;
            max-width: 400px;
            border: 2px solid #008000; /* Green border */
            border-radius: 10px;
            background-color: #f0f8ff; /* Light blue background */
        }

        /* Style for the green tick */
        .green-tick {
            color: #008000; /* Green color */
            font-size: 48px;
        }
    </style>
<script>
    <?php
    // Check if there was an error or if there is no success message
    if (!empty($errorMessage) || empty($successMessage)) {
    ?>
        // Reload the current page after displaying the message for 3 seconds
        setTimeout(function () {
            location.reload();
        }, 3000);
    <?php
    }
    ?>
</script>


</head>
<body>
    <div class="center-box">
        <?php
        if (!empty($successMessage)) {
            echo '<div class="green-tick">&#10004;</div>';
            echo '<p>' . $successMessage . '</p>';
        } elseif (!empty($errorMessage)) {
            echo '<p>' . $errorMessage . '</p>';
        }
        ?>
    </div>
</body>
</html>