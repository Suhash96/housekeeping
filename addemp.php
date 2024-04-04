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
                    <h2 class="title">Registration Info</h2>

                    <form action="addempprocess.php" method="POST">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="firstName" name="firstName"
                                        required="required">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="lastName" name="lastName"
                                        required="required">
                                </div>
                            </div>
                        </div>





                        <div class="input-group">
                            <input class="input--style-1" type="email" placeholder="Email" name="email"
                                required="required">
                        </div>
                        <div class="input-group">
                            <p>Birthday</p>
                            <input class="input--style-1" type="date" placeholder="BIRTHDATE" name="birthday"
                                required="required">
                        </div>


                        <div class="input-group">
                            <input class="input--style-1" type="tel" placeholder="Contact Number (10 digits)"
                                name="contact" pattern="\d{10}" required="required">


                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Bio ID (9 digits)" name="bioid"
                                pattern="\d{9}" title="Bio ID must be 9 digits" required="required">
                        </div>


                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="password" name="password"
                                required="required">
                        </div>

                        <div class="input-group">
                            <select class="input--style-1" name="designation" id="designation" required="required"
                                onchange="toggleSupervisor()">
                                <option value="" disabled selected>Select Designation</option>
                                <option value="storekeeper">Storekeeper</option>
                                <option value="Worker">Worker</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Manager">Manager</option>
                            </select>
                        </div>

                        <div class="input-group" id="supervisorGroup" style="display: none;">
                            <select class="input--style-1" name="supervisor" id="supervisor">
                                <option value="" disabled selected>Select Supervisor</option>
                                <!-- Add options for supervisors here -->
                            </select>
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="qualification" name="qualification"
                                required="required">
                        </div>







                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Submit</button>
                        </div>
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