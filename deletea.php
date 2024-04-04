<?php
require_once('process/dbh.php');

if (isset($_GET['asset_id'])) {
    $asset_id = $_GET['asset_id'];

    // Construct the SQL query to delete the asset
    $deleteSql = "DELETE FROM assets WHERE asset_id = '$asset_id'";
    
    // Execute the delete query
    if (mysqli_query($conn, $deleteSql)) {
        // Successful deletion
        header("Location: storewel.php"); // Redirect back to the listing page
        exit();
    } else {
        // Error deleting the asset
        echo "Error deleting asset: " . mysqli_error($conn);
    }
} else {
    echo "Invalid ID or ID is missing.";
}
?>
