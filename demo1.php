
<?php
require_once('process/dbh.php'); // Include your database connection file.

if (isset($_GET['bio_id'])) {
    $id = $_GET['bio_id'];

    // Fetch the user information based on the provided ID using a prepared statement
    $sql = "SELECT * FROM userinfo WHERE bio_id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);

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

        // Update the user information in the database using a prepared statement
        $updateSql = "UPDATE userinfo SET firstName=?, lastName=?, email=?, contact=?, Designation=?, qualification=? WHERE bio_id=?";
        
        $stmt = mysqli_prepare($conn, $updateSql);
        mysqli_stmt_bind_param($stmt, "ssssssi", $updatedFirstName, $updatedLastName, $updatedEmail, $updatedContact, $updatedDesignation, $updatedQualification, $id);
        
        if (mysqli_stmt_execute($stmt)) {
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


<!DOCTYPE html>
<html>

<head>


    <!-- Title Page-->
    <title>manage employee|Housekeeping</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
    <style>
        header {
            background-color: #13287e;

        }

        .divider {
            background-color: #13287e;
            height: 5px;
        }

        .homered {
            background-color: rgb(0, 43, 198);
            padding: 30px 10px 22px 10px;
        }

        .logo {
            font-size: 2em;
            color: #fff;
            user-select: none;
        }

        .homered {
            background-color: #13287e;
            padding: 30px 10px 20px 10px;
        }

        .divider {
            background-color: rgb(0, 86, 144);
            height: 5px;
        }


        .homeblack:hover {
            background-color: rgb(19 40 126);
            padding: 30px 10px 18px 10px;
        }

        header h1 {
            margin-left: 34px;
            /* padding-right: 48px; */
            display: inline;
            font-family: Poppins, sans-serif;
            font-weight: bold;
            font-size: 21px;
            float: left;
            margin-top: -8px;
            margin-right: 58px;
        }


        img {
            width: 50px;
            float: left;
            margin-left: 75px;
            /* margin-top: 17px; */
            height: 38px;
        }

        .divider {
            background-color: #13287e;
            height: 5px;
        }

        nav ul li a {
            color: #00000;
            text-decoration: none;
        }

        nav ul {
            display: inline;
            padding: 10px;
            float: right;
        }

        .btn--green {
            background: #13287e;
        }

        .btn--green:hover {
            background: #13287e;
        }
        input {
            outline: none;
    margin: 0;
    border: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    width: 100%;
    font-size: 14px;
    font-family: inherit;
    margin-left: 60%;
    margin-top: -3%;
}
.row{
    margin-top:5%;
}

button {
    outline: none;
    background: none;
    border: none;
    background: #13287e;
    color: #fff;
    padding: 10px;
    margin-left: 108px;
    margin-top: 22px;
    border-radius: 10px;
    width: 43%;
}

H2{
    text-align:center;
}
    </style>
    <script>
        function validateEmail() {
            var email = document.forms["registrationForm"]["email"].value;

            // Check if the email contains '@'
            if (!email.includes('@')) {
                alert("Please enter a valid email address.");
                return false;
            }

            return true;
        }

        function validateContactNumber() {
            var contactNumber = document.forms["registrationForm"]["contact"].value;

            // Check if the contact number is exactly 10 digits
            if (contactNumber.length !== 10 || isNaN(contactNumber)) {
                alert("Please enter a valid 10-digit contact number.");
                return false;
            }

            return true;
        }

        function validateBioID() {
            var bioID = document.forms["registrationForm"]["bioid"].value;

            // Check if the bio ID is exactly 9 digits
            if (bioID.length !== 9 || isNaN(bioID)) {
                alert("Please enter a valid 9-digit bio ID.");
                return false;
            }

            return true;
        }

        function validateForm() {
            return validateEmail() && validateContactNumber() && validateBioID();
            // Add more validation functions as needed
        }
    </script>
</head>

<body>
    <header>
        <nav>
            <img src="logo.png" alt="Description of the image">
            <h1 class="container">Housekeeping <br> Management</h1>
            <ul id="navli">
                <li><a class="homered" href="adminhomepage.html">HOME</a></li>
                <li><a class="homered" href="aloginwel.php">ALL DETAILS</a></li>
                <li><a class="homeblack" href="addemp.php">ADD EMPLOYEE</a></li>
                <li><a class="homeblack" href="building.php">MANAGE BUILDING</a></li>
                <li><a class="homeblack" href="index.html">LOG OUT</a></li>
            </ul>
        </nav>
    </header>

    <div class="divider"></div>




    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">

                <form method="POST">
    <h2>EDIT USER INFORMATION</h2>
    <div class="row">
        <label for="firstName">FIRST NAME</label>
        <input type="text" name="firstName" value="<?php echo $userinfo['firstName']; ?>" required><br>
    </div>
    <div class="row">
        <label for="lastName">LAST NAME</label>
        <input type="text" name="lastName" value="<?php echo $userinfo['lastName']; ?>" required><br>
    </div>
    <div class="row">
        <label for="email">EMAIL ID</label>
        <input type="email" name="email" value="<?php echo $userinfo['email']; ?>" required><br>
    </div>
    <div class="row">
        <label for="contact">CONTACT NO</label>
        <input type="text" name="contact" value="<?php echo $userinfo['contact']; ?>" required><br>
    </div>
    <div class="row">
        <label for="Designation">DESIGNATION</label>
        <input type="text" name="Designation" value="<?php echo $userinfo['Designation']; ?>" required><br>
    </div>
    <div class="row">
        <label for="qualification">QUALIFICATION</label>
        <input type="text" name="qualification" value="<?php echo $userinfo['qualification']; ?>" required><br>
    </div>
    <button type="submit" name="submit">UPDATE</button>
</form>

                </div>
            </div>
        </div>
    </div>
    <script>
        // Function to fetch and populate supervisors
        function populateSupervisors() {
            console.log("Fetching supervisors...");
            var supervisorSelect = document.getElementById("supervisor");

            // Clear existing options
            supervisorSelect.innerHTML = '<option value="" disabled selected>Select Supervisor</option>';

            // Fetch supervisors from the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                console.log("XHR State:", xhr.readyState, "Status:", xhr.status);

                if (xhr.readyState == 4) {
                    console.log("Response:", xhr.responseText);

                    if (xhr.status == 200) {
                        try {
                            var supervisors = JSON.parse(xhr.responseText);
                            console.log("Supervisors:", supervisors); // Check if this prints the expected data

                            // Populate options with supervisor names
                            supervisors.forEach(function (supervisor) {
                                var option = document.createElement("option");
                                option.value = supervisor.bio_id; // Use the correct property for the supervisor ID
                                option.text = supervisor.firstName; // Use the correct property for the supervisor's first name
                                supervisorSelect.appendChild(option);
                            });
                        } catch (error) {
                            console.error("Error parsing JSON:", error);
                        }
                    } else {
                        console.error("Request failed with status:", xhr.status);
                    }
                }
            };

            xhr.open("GET", "get_supervisors.php", true);
            xhr.send();
        }

        // Call populateSupervisors initially to set the initial state
        populateSupervisors();

        function toggleSupervisor() {
            var designationSelect = document.getElementById("designation");
            var supervisorGroup = document.getElementById("supervisorGroup");

            // If Worker is selected, show the supervisor selection, else hide it
            supervisorGroup.style.display = (designationSelect.value === "Worker") ? "block" : "none";
        }

        function submitForm() {
            // Your existing submitForm function
        }
    </script>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
<!-- end document-->