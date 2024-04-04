<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "housekeeping";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get worker name from POST data
$workerName = isset($_POST['worker_name']) ? $_POST['worker_name'] : '';

$updateSql = "UPDATE `userinfo` SET `busy` = 0 WHERE `firstName` = ?";
$updateStatement = $conn->prepare($updateSql);

$response = array();

if ($updateStatement) {
    $updateStatement->bind_param("s", $workerName);
    $updateResult = $updateStatement->execute();

    if (!$updateResult) {
        $response['success'] = false;
        $response['message'] = "Update error: " . $updateStatement->error;
    } else {
        $response['success'] = true;
        $response['message'] = "Update successfully";
        $response['workerName'] = $workerName;
    }

    $updateStatement->close();
} else {
    $response['success'] = false;
    $response['message'] = "Prepare error: " . $conn->error;
}

$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
