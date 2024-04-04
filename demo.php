<?php
// Establish database connection
$servername = "localhost";
$username = "username";
$password = "password";
$database = "housekeeping";

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if bio_id is provided and valid
if(isset($_GET['bio_id']) && is_numeric($_GET['bio_id'])) {
    $bio_id = $_GET['bio_id'];

    // Fetch user information from the database
    $sql = "SELECT * FROM userinfo WHERE bio_id = $bio_id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $userinfo = mysqli_fetch_assoc($result);
    } else {
        echo "No records found with the given ID.";
        exit;
    }
} else {
    echo "Invalid bio_id.";
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract data from the form submission
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $designation = $_POST['designation'];
    $qualification = $_POST['qualification'];

    // Update the record in the database
    $update_sql = "UPDATE userinfo SET firstName='$firstName', lastName='$lastName', email='$email', contact='$contact', Designation='$designation', qualification='$qualification' WHERE bio_id = $bio_id";

    if (mysqli_query($conn, $update_sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="post">
        <label>First Name:</label>
        <input type="text" name="firstName" value="<?php echo $userinfo['firstName']; ?>"><br>
        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?php echo $userinfo['lastName']; ?>"><br>
        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $userinfo['email']; ?>"><br>
        <label>Contact:</label>
        <input type="text" name="contact" value="<?php echo $userinfo['contact']; ?>"><br>
        <label>Designation:</label>
        <input type="text" name="designation" value="<?php echo $userinfo['Designation']; ?>"><br>
        <label>Qualification:</label>
        <input type="text" name="qualification" value="<?php echo $userinfo['qualification']; ?>"><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
