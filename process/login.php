<?php
session_start();

require '../vendor/autoload.php'; // Include Composer's autoloader

// MongoDB connection parameters
$mongodb_url = "mongodb://localhost:27017"; // MongoDB connection URL
$database_name = "housekeeping"; // MongoDB database name
$collection_name = "userinfo"; // MongoDB collection name

try {
    // Connect to MongoDB
    $mongoClient = new MongoDB\Client($mongodb_url);

    // Select the database and collection
    $database = $mongoClient->$housekeeping;
    $collection = $database->$userinfo;

    // Process login form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $role = $_POST["role"];
        $bio_id = $_POST["bio_id"];
        $password = $_POST["password"];

        // Query to check user's credentials
        $query = ['bio_id' => $bio_id, 'password' => $password, 'Designation' => $role];
        $user = $collection->findOne($query);

        if ($user) {
            // User is authenticated
            $_SESSION["bio_id"] = $bio_id;
            $_SESSION["firstName"] = $user['firstName'];

            // Redirect based on user role
            switch ($role) {
                case 'admin':
                    header("Location: aloginwel.php");
                    exit();
                case 'manager':
                    header("Location: assign.php");
                    exit();
                case 'supervisor':
                    header("Location: sloginwel.php");
                    exit();
                case 'storekeeper':
                    header("Location: storewel.php");
                    exit();
                default:
                    echo "Invalid role";
                    break;
            }
        } else {
            echo "Login failed. Please check your credentials.";
        }
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    die("MongoDB connection failed: " . $e->getMessage());
}
?>
