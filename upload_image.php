<?php
session_start();
require_once('process/dbh.php'); // Include your database connection code here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Check if job_id is set in the URL
        if (isset($_GET['job_id'])) {
            $job_id = $_GET['job_id']; // Get the job_id from the URL
            
            // Define a directory to store the uploaded images
            $uploadDir = "uploads/";
            
            // Generate a unique filename for the uploaded image
            $filename = uniqid() . "_" . $_FILES["image"]["name"];
            
            // Set the path to save the image
            $targetFilePath = $uploadDir . $filename;
            
            // Check if the file is an actual image
            $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $allowedExtensions = array("jpg", "jpeg", "png", "gif");
            
            if (in_array($imageFileType, $allowedExtensions)) {
                // Move the uploaded image to the specified directory
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    // Update the job record in the database with the image path
                    $updateSql = "UPDATE job SET image = '$targetFilePath' WHERE job_id = '$job_id'";
                    if (mysqli_query($conn, $updateSql)) {
                        // You can perform any additional actions here if needed
                        // For example, you could redirect to another page
                    } else {
                        $message = "Error updating database: " . mysqli_error($conn);
                    }
                } else {
                    $message = "Error uploading image.";
                }
            } else {
                $message = "Invalid file format. Allowed formats: JPG, JPEG, PNG, GIF.";
            }
        } else {
            $message = "Job ID not provided in the URL.";
        }
    } else {
        $message = "Error: " . $_FILES["image"]["error"];
    }
}

// Redirect to the job details page (change the URL to your actual job details page)
header("Location: job_details.php?job_id=$job_id");
exit();
?>
