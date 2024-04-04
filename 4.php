<?session.php

// Start the session (if not already started)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in, except for specific pages
$excluded_pages = array('login.html', 'managerwel.php', 'sloginwel.php', 'assign.php','addemp.php','building.php'); // Add the names of public pages here

if (!isset($_SESSION['bio_id']) && !in_array(basename($_SERVER['PHP_SELF']), $excluded_pages)) {
    // Redirect the user to the login page if not logged in and not on an excluded page
    header("Location: login.html");
    exit(); // Stop executing further code
}

// Check the user's role and redirect accordingly
if ($_SESSION['	Designation'] == 'admin') {
    header("Location: aloginwel.php");
    exit();
} elseif ($_SESSION['Designation'] == 'manager') {
    header("Location: managerwel.php");
    exit();
} elseif ($_SESSION['Designation'] == 'supervisor') {
    header("Location: sloginwel.php");
    exit();
}
?>


// If needed, you can store additional session data or perform other session-related tasks here
