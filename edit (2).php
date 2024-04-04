<?php
require_once('process/dbh.php'); // Include your database connection file.

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the user information based on the provided ID
    $sql = "SELECT * FROM userinfo WHERE bio_id = $id";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }

    $userinfo = mysqli_fetch_assoc($result);

    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        // Retrieve and sanitize the updated data from the form
        $updatedFirstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $updatedLastName = mysqli_real_escape_string($conn, $_POST['lastName']);
        $updatedEmail = mysqli_real_escape_string($conn, $_POST['email']);
        $updatedContact = mysqli_real_escape_string($conn, $_POST['contact']);
        $updatedDesignation = mysqli_real_escape_string($conn, $_POST['Designation']);
        $updatedQualification = mysqli_real_escape_string($conn, $_POST['qualification']);

        // Update the user information in the database
        $updateSql = "UPDATE userinfo SET firstName='$updatedFirstName', lastName='$updatedLastName', email='$updatedEmail', contact='$updatedContact', Designation='$updatedDesignation', qualification='$updatedQualification' WHERE bio_id=$id";

        if (mysqli_query($conn, $updateSql)) {
            header("Location: aloginwel.php"); // Redirect to the desired page after successful update
            exit();
        } else {
            die("Error updating record: " . mysqli_error($conn));
        }
    }
} else {
    die("Invalid ID");
}
?>

<!-- HTML form to edit user information -->
<html>
<head>
    <!-- Add your HTML and styling here as needed -->
</head>
<body>
    <h2>Edit User Information</h2>
    <form method="POST">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" value="<?php echo $userinfo['firstName']; ?>" required><br>

        <!-- Add similar fields for other user information -->

        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>