<?php
header('Content-Type: application/json');

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the form data
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $email = htmlspecialchars($_POST['email']);
    $birthday = htmlspecialchars($_POST['birthday']);
    $contact = htmlspecialchars($_POST['contact']);
    $bioid = htmlspecialchars($_POST['bioid']);
    $password = htmlspecialchars($_POST['password']);
    $designation = htmlspecialchars($_POST['designation']);
    $qualification = htmlspecialchars($_POST['qualification']);
    
    // Validate and process the data (e.g., store it in a database)
    // ...

    // Send a response (e.g., JSON response)
    $response = [
        'success' => true,
        'message' => 'Employee registration successful',
    ];
    echo json_encode($response);
} else {
    // Handle other HTTP methods (GET, PUT, DELETE, etc.) or return an error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
