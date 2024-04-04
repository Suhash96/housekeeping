<?php
require_once('process/dbh.php');

// Check if the user is logged in and has an active session
session_start();
if (!isset($_SESSION['user_id'])) {
    // Handle the case where the user is not logged in
    echo "User is not logged in.";
    exit();
}

// Get the user's session ID and requested quantities
$userSessionId = session_id();
$quantities = $_POST['quantities'];

// Loop through the quantities and insert them into the requested_asset table
foreach ($quantities as $assetId => $quantity) {
    // Sanitize the inputs to prevent SQL injection (you should use prepared statements)
    $assetId = mysqli_real_escape_string($conn, $assetId);
    $quantity = mysqli_real_escape_string($conn, $quantity);
    $userSessionId = mysqli_real_escape_string($conn, $userSessionId);

    // Insert the data into the requested_asset table
    $insertSql = "INSERT INTO requested_asset (user_session_id, asset_id, requested_quantity) VALUES ('$userSessionId', '$assetId', '$quantity')";
    $insertResult = mysqli_query($conn, $insertSql);

    if (!$insertResult) {
        die("Error: " . mysqli_error($conn));
    }
}

// You can return a success message or perform other actions here
echo "Request submitted successfully.";
?>
