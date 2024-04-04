<?php
require_once('process/dbh.php'); // Include your database connection file.

if (isset($_GET['bio_id']) && is_numeric($_GET['bio_id'])) {
    $bio_id = $_GET['bio_id'];

    // Delete the user record from the database
    $deleteSql = "DELETE FROM userinfo WHERE bio_id = $bio_id";

    if (mysqli_query($conn, $deleteSql)) {
        header("Location: aloginwel.php"); // Redirect to the desired page after successful deletion
        exit();
    } else {
        die("Error deleting record: " . mysqli_error($conn));
    }
} else {
    die("Invalid ID or ID is missing.");
}
?>
