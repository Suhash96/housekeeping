<?php
session_start();

$jobId = isset($_GET['job_id']) ? $_GET['job_id'] : null;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "housekeeping";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function determineAssignedColumn($classroom) {
    // Extract numeric part from the classroom
    $numericClassroom = filter_var($classroom, FILTER_SANITIZE_NUMBER_INT);

    // Define your rules for assigning columns based on classroom ranges
    if ($numericClassroom >= 1 && $numericClassroom <= 30) {
        if ($numericClassroom >= 11 && $numericClassroom <= 15) {
            return "assigned_classroom3";
        } elseif ($numericClassroom >= 16 && $numericClassroom <= 20) {
            return "assigned_classroom4";
        } elseif ($numericClassroom >= 21 && $numericClassroom <= 25) {
            return "assigned_classroom5";
        } elseif ($numericClassroom >= 26 && $numericClassroom <= 30) {
            return "assigned_classroom6";
        }
    } elseif (in_array($classroom, ['restroom', 'staffroom', 'lab'])) {
        switch ($classroom) {
            case 'restroom':
                return "assigned_classroom7";
            case 'staffroom':
                return "assigned_classroom8";
            case 'lab':
                return "assigned_classroom9";
        }
    }

    // Default case, you can adjust this as needed
    die("Invalid classroom value");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selected_workers']) && isset($_POST['classroom'])) {
        $selectedWorkers = $_POST['selected_workers'];
        $classroom = $_POST['classroom'];
        $maxWorkers = 3; // Adjust this value as needed
        if (count($selectedWorkers) > $maxWorkers) {
            die("You can only choose up to $maxWorkers workers for a single classroom.");
        }
        foreach ($selectedWorkers as $bioId) {
            // Check if the worker is busy
            $checkBusySql = "SELECT `busy` FROM `userinfo` WHERE `bio_id` = '$bioId'";
            $checkBusyResult = mysqli_query($conn, $checkBusySql);

            if ($checkBusyResult) {
                $busyRow = mysqli_fetch_assoc($checkBusyResult);
                $busyStatus = $busyRow['busy'];

                // If the worker is busy, prevent the selection
                if ($busyStatus == 1) {
                    die("Worker with Bio ID $bioId is currently busy and cannot be selected.");
                }
            } else {
                die("Query error: " . mysqli_error($conn));
            }
        }
        // Update the busy status for selected workers
        foreach ($selectedWorkers as $bioId) {
            $updateBusySql = "UPDATE `userinfo` SET `busy` = 1 WHERE `bio_id` = '$bioId'";
            $updateBusyResult = mysqli_query($conn, $updateBusySql);

            if (!$updateBusyResult) {
                die("Update busy status error: " . mysqli_error($conn));
            }
        }

        // $assignedColumn = determineAssignedColumn($classroom);
        $assignedColumn = "assigned_classroom3";


        $workerNames = array();

        foreach ($selectedWorkers as $bioId) {
            $sql = "SELECT `firstName` FROM `userinfo` WHERE `bio_id` = '$bioId'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $workerNames[] = $row['firstName'];
            } else {
                die("Query error: " . mysqli_error($conn));
            }
        }

        $workerNamesStr = implode(", ", $workerNames);
        $updateSql = "UPDATE `job` SET `$assignedColumn` = '$workerNamesStr' WHERE `job_id` = '$jobId'";
        $updateResult = mysqli_query($conn, $updateSql);

        if (!$updateResult) {
            die("Update error: " . mysqli_error($conn));
        }

        // Get the floor_no for redirection
        $floorNoSql = "SELECT `floor_no` FROM `job` WHERE `job_id` = '$jobId'";
        $floorNoResult = mysqli_query($conn, $floorNoSql);
        $floorNoRow = mysqli_fetch_assoc($floorNoResult);
        $floorNo = $floorNoRow['floor_no'];

        // Display a success message and redirect to room_list.php with the same job ID and floor_no
        echo '<script>alert("Your job has been scheduled.");</script>';
        echo '<script>
                setTimeout(function(){
                    window.location.href = "sloginwel.php?job_id=' . $jobId . '&floor_no=' . $floorNo . '";
                }, 2000);
              </script>';
    }
}

$supervisorBioId = $_SESSION['bio_id'];

// SQL query to fetch workers under the specified supervisor
$sql = "SELECT `firstName`, `bio_id` FROM `userinfo` WHERE `designation` = 'worker' AND `supervisor` = '$supervisorBioId'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Worker List</title>
    <link rel="stylesheet" type="text/css" href="styleemplogin.css">
    <style>
        .container {
            background-color:#005690;
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
    background-color: #13287e;
    height: 5px;
}

        .homeblack:hover{
            background-color: rgb(0 86 144);
            padding: 30px 10px 18px 10px;
        }

        header {
            background: #13287e;
    color: white;
    padding: 18px 20px 53px 40px;
    height: 0px;
        }

 

        nav ul li a {
            color: #00000;
    text-decoration: none;
        }

       

        

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        header h1 {
    margin-left: 15px;
    /* padding-right: 48px; */
    display: inline;
    font-family: Poppins, sans-serif;
    font-weight: bold;
    font-size: 21px;
    float: left;
    margin-top: -8px;
    margin-right: 58px;
}

        h6 {
            text-align: center;
            color: #2f2727;
            font-size:40px;
        }

        .worker-list {
            list-style: none;
            padding: 0;
        }

        .worker-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
            background-color: #fff;
        }

        .select-checkbox input[type="checkbox"] {
            margin-right: 10px;
        }

        .worker-name {
            flex-grow: 1;
            color: #333;
        }

        .bio-id {
            color: #777;
        }

        .schedule-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        .schedule-button:hover {
            background-color: #0056b3;
        }

        .schedule-button:focus {
            outline: none;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            text-align: center;
            border-radius: 5px;
        }

        .close {
            color: #888;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }
        img {
            width: 50px;
            float: left;
            margin-left: 75px;
            /* margin-top: 17px; */
            height: 38px;
        }
    </style>
</head>
<body>
<header>
    <nav>
    <img src="logo.png" alt="Description of the image">
    <h1 class="container1">Housekeeping <br> Management</h1>
        <ul id="navli">
            <li><a class="homered" href="sloginwel.php">HOME</a></li>
            <li><a class="homered" href="assetreq.php">REQUEST ASSET</a></li>
            <li><a class="homeblack" href="login.html">LOG OUT</a></li>
            <li><a class="homeblack" href="login.html"><?php echo $_SESSION['bio_id']; ?></a></li>
        </ul>
    </nav>
</header>
<div class="divider"></div>
<div class="divider"></div>

<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
    <div class="wrapper wrapper--w680">
        <div class="card card-1">
            <div class="card-heading"></div>
            <div class="card-body">
                <div class="content">
                    <div class="container">
                    <form method="post" action="" onsubmit="scheduleJob();">
    <input type="hidden" name="job_id" value="<?php echo $jobId; ?>">
    <input type="hidden" name="classroom" value="<?php echo isset($_GET['classroom']) ? htmlspecialchars($_GET['classroom']) : ''; ?>">

                            <h6>All Workers</h6>
                            <ul class="worker-list">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>";
            echo "<label class='select-checkbox'><input type='checkbox' name='selected_workers[]' value='" . $row['bio_id'] . "'></label>";
            echo "<span class='worker-name'>" . $row['firstName'] . "</span>";
            echo "<span class='bio-id'>Bio ID: " . $row['bio_id'] . "</span>";
            echo "</li>";
        }
        ?>
    </ul>

                            <div style="text-align: center;">
        <input type="submit" id="scheduleButton" class="schedule-button" value="Schedule">
    </form>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="message" class="message"></div>
        </div>
    </div>
    <!-- Message container -->
    <div id="message" class="message"></div>
</div>
                </div>
               
                    <script>
    function scheduleJob() {
        // Get the selected checkboxes
        var checkboxes = document.querySelectorAll('input[name="selected_workers[]"]:checked');

        // Display the message based on the number of selected workers
        var messageDiv = document.getElementById("message");

        if (checkboxes.length === 0) {
            // No worker selected
            messageDiv.innerHTML = "Please select a worker.";
        } else {
            // At least one worker selected
            messageDiv.innerHTML = "Your job has been scheduled.";

            // Show the modal
            var modal = document.getElementById("myModal");
            modal.style.display = "block";

            // Redirect after 2 seconds
            setTimeout(function () {
                window.location.href = 'room_list.php';
            }, 2000);
        }
    }

    function closeModal() {
        // Hide the modal
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
</script>
               
            </div>
        </div>
    </div>
</div>
</body>
</html>