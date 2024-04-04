<?php
session_start();
require_once('process/dbh.php'); // Include your database connection code here

if (isset($_POST['request_accept'])) {
    // Retrieve asset details from the submitted form
    $assetIDs = $_POST['asset_id'];
    $requestQuantities = $_POST['request_quantity'];

    // Loop through the assets and update the asset_quantity
    for ($i = 0; $i < count($assetIDs); $i++) {
        $assetID = $assetIDs[$i];
        $requestQuantity = $requestQuantities[$i];

        // Query to update asset_quantity in the assets table
        $updateSql = "UPDATE assets SET asset_quantity = asset_quantity - $requestQuantity WHERE asset_id = '$assetID'";
        
        $updateResult = mysqli_query($conn, $updateSql);

        // Check if the update was successful
        if (!$updateResult) {
            // Handle the error, such as displaying an error message
            echo "Error updating asset quantity for asset ID: $assetID";
        }
    }

    // Redirect back to the previous page or show a success message
    header("Location: previous_page.php"); // Replace 'previous_page.php' with the actual URL you want to redirect to
    exit();
} else {
    // Handle the case when the form is not submitted
    echo "Form not submitted.";
}
?>
