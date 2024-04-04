<?php
session_start();
// Database connection parameters
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root";
$password = "";
$dbname = "housekeeping";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bio_id = $_POST["bio_id"];
    $password = $_POST["password"];
    
    // Sanitize input
    $bio_id = $conn->real_escape_string($bio_id);
    $password = $conn->real_escape_string($password);

    // Query to check user's credentials
    $query = "SELECT * FROM userinfo WHERE bio_id='$bio_id' AND password='$password'";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        // User is authenticated
        while($row = mysqli_fetch_assoc($result)){
            $user_id = $row["bio_id"];
            $firstName = $row['firstName'];

            $_SESSION["bio_id"] = $user_id;
            $_SESSION["firstName"] = $firstName;
       
        
        $role = $row["Designation"];

        // Redirect based on user role
        if ($role == "admin") {
            
            header("Location: adminhomepage.html");
            exit();
        } elseif ($role == "supervisor") {
           
            header("Location: sloginwel.php");
            exit();
        } elseif ($role == "manager") {
        
            header("Location: assign.php");
            exit();
        } elseif ($role == "storekeeper") {
            header("Location: storewel.php");
            exit();
        } else {
            echo "Unknown role: $role";
        }
    }  }else {
        echo "Login failed. Please check your bio ID and password.";
    }
}

// Close the connection
$conn->close();
?>
