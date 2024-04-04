<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "housekeeping";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $contact = $_POST["contact"];
    $bioid = $_POST["bioid"];
    $password = $_POST["password"];
    $designation = $_POST["designation"];
    $qualification = $_POST["qualification"];
    $supervisor = isset($_POST["supervisor"]) ? $_POST["supervisor"] : null;

    // Check if bio_id already exists
    $checkBioIDQuery = "SELECT * FROM userinfo WHERE bio_id = '$bioid'";
    $checkBioIDResult = $conn->query($checkBioIDQuery);

    if ($checkBioIDResult->num_rows > 0) {
        echo "<div class='warning'>Warning: Bio ID '$bioid' is already registered.</div>";
    } else {
        // Perform the insert into the userinfo table
        $insertQuery = "INSERT INTO userinfo (firstName, lastName, email, birthday, contact, bio_id, password, designation, qualification, supervisor)
                        VALUES ('$firstName', '$lastName', '$email', '$birthday', '$contact', '$bioid', '$password', '$designation', '$qualification', '$supervisor')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "<div class='success-message'>Data inserted successfully!</div>";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
