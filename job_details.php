<?php
session_start();
require_once('process/dbh.php'); // Include your database connection code here

// Check if the job_id parameter is set in the URL
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

    // SQL query to retrieve job details based on job_id
    $sql = "SELECT * FROM job WHERE job_id = '$job_id'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }

    // Fetch the job details
    $job = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Details | Housekeeping Management System</title>
    <link rel='stylesheet' type='text/css' href='styleemplogin.css'>
    <style>
                     
		.container {
    background-color: #13287e;
}
.logo {
    font-size: 2em;
    color: #fff;
    user-select: none;
}

header h1 {
    margin-left: 90px;
    /* padding-right: 48px; */
    display: inline;
    font-family: Poppins, sans-serif;
    font-weight: bold;
    font-size: 21px;
    float: left;
    margin-top: -8px;
    margin-right: 58px;
}
.homered {
    background-color: #13287e;
    padding: 30px 10px 20px 10px;
}

.divider{
	background-color: rgb(0, 86, 144);
	height: 5px;
  }
  
  .homeblack:hover {
    background-color: rgb(19 40 126);
    padding: 30px 10px 18px 10px;
}

  header {
    background: #13287e;
    color: white;
    padding: 18px 20px 53px 40px;
    height: 2px;
}
.divider {
    background-color: #13287e;
    height: 5px;
}
nav ul li a {
    color: #00000;
    text-decoration: none;
}

.details-table th, .details-table td {
    text-align: left;
    width: 30%;
    color: black; /* Set the text color */
    background-color: #f7f7f7; /* Background color */
    padding: 5px 10px;
}


.accept-button {
    background-color: #8BCA02; /* Green color for the button */
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 5px;
}

.accept-button:hover {
    background-color: #5F9900; /* Darker green color on hover */
}

.details-button {
    background-color: #0074D9; /* Blue color for the button */
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 5px;
}

.details-button:hover {
    background-color: #0056b3; /* Darker blue color on hover */
}

/* Add CSS styling for the details box */
.details-box {
    background-color: #f0f0f0;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin: 20px;
}

/* Style the table within the details box */
.details-table {
    width: 100%;
} /* Your existing CSS styles here */
  /* Add this CSS code to your existing styles */
.tick-icon {
    display: none; /* Initially hide the tick icon */
    width: 20px; /* Adjust the size as needed */
    height: 20px; /* Adjust the size as needed */
    background-image: url('path/to/green-tick-icon.png'); /* Specify the path to your green tick icon image */
    background-size: cover; /* Adjust as needed */
    background-repeat: no-repeat;
    margin-left: 5px; /* Adjust the spacing between the button text and icon */
    vertical-align: middle; /* Align the icon vertically with the button text */
}

.upload-success .tick-icon {
    display: inline-block; /* Display the tick icon when the button has the upload-success class */
}
.center-align {
            text-align: center;
        }

        .submit-button {
    background-color: #13287e;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
}

        .submit-button:hover {
            background-color: #13287e; /* Darker green color on hover */
        }
        /* Add this CSS code to your existing styles */
.message-box {
    display: none;
    background-color: #8BCA02; /* Green color for the message box */
    color: white;
    text-align: center;
    padding: 10px;
    border-radius: 5px;
    margin-top: 20px;
}

.message {
    display: flex;
    align-items: center;
    justify-content: center;
}

.message-text {
    margin-right: 10px;
    font-weight: bold;
}
/* CSS for the message container */
.message-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7); /* Semi-transparent black background */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

/* CSS for the message content */
.message-content {
    background-color: #8BCA02; /* Green color for the message background */
    color: white;
    padding: 20px;
    text-align: center;
    border-radius: 5px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* CSS for the message icon (green checkmark) */
.message-icon {
    font-size: 48px; /* Adjust the size as needed */
    margin-bottom: 10px;
}

/* CSS for the message text */
.message-text {
    font-size: 24px; /* Adjust the size as needed */
}

/* CSS for blurred background content */
.details-box.blur {
    filter: blur(5px); /* Adjust the blur intensity as needed */
    transition: filter 0.3s; /* Add a transition effect for the blur */
}
/* CSS for the modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.7);
}

/* CSS for the modal content */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* CSS for the close button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}


/* /* Your existing CSS styles here */
    </style>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to handle displaying the "Work has been done" message
    function displayWorkDoneMessage() {
        // Display the message with a big green tick
        var messageBox = document.querySelector(".message-box");
        var messageText = document.querySelector("#message-text");
        messageText.textContent = "Work has been done";
        messageBox.style.display = "block";
    }

    // JavaScript function to handle successful image upload
    function handleUploadSuccess() {
        // Get the upload button and add a tick icon
        var uploadButton = document.querySelector(".upload-button");
        uploadButton.innerHTML = "Uploaded &#10004;"; // "&#10004;" is the Unicode character for a tick icon
        uploadButton.classList.add("upload-success");
    }

    // JavaScript function to handle submitting the job status update
   function submitJobStatusUpdate() {
        // Perform an AJAX request to update the job status
        $.ajax({
            url: "update_job_status.php", // Replace with the actual PHP script to handle the update
            type: "POST",
            data: {
                job_id: "<?php echo $job['job_id']; ?>",
                status: "completed"
            },
            success: function(response) {
                // Handle the status update response
                console.log(response);

                // Check if the response indicates success
                if (response === "success") {
                    // Display a success message
                    displayWorkDoneMessage();

                    // Redirect after a short delay (e.g., 3 seconds)
                    redirectToSloginwel();
                } else {
                    // Display an error message or handle the error accordingly
                    console.error("Error updating job status:", response);
                }
            },
            error: function(xhr, status, error) {
                // Handle errors (if needed)
                console.error(xhr.responseText);
            }
        });
    }


    // Function to handle the redirect to sloginwel.php
    function redirectToSloginwel() {
        setTimeout(function () {
            window.location.href = "sloginwel.php";
        }, 3000); // Redirect after 3 seconds (adjust the timing as needed)
    }

    // Add an event listener for the submit button click
    $(document).ready(function() {
        $("form").submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Serialize the form data
            var formData = new FormData($(this)[0]);

            // Perform an AJAX POST request to upload the image
            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle the response (if needed)
                    handleUploadSuccess();

                    // Display the message and redirect
                    displayWorkDoneMessage();
                    redirectToSloginwel();
                },
                error: function(xhr, status, error) {
                    // Handle errors (if needed)
                    console.error(xhr.responseText);
                }
            });
        });

        // Add an event listener for the "Submit" button click
        $(".submit-button").click(function() {
            // Call the function to submit the job status update
            submitJobStatusUpdate();
        });
    });
</script>
<script>
    function showWorkerDetails(workerName) {
        // Open the modal
        var modal = document.getElementById('classroomModal');
        modal.style.display = 'block';

        // Display the worker's name and status
        displayWorkerStatus(workerName);

        // Close the modal when the user clicks on the close button (x)
        var closeBtn = document.getElementsByClassName('close')[0];
        closeBtn.onclick = function () {
            closeModal();
        };

        // Close the modal if the user clicks outside of it
        window.onclick = function (event) {
            if (event.target === modal) {
                closeModal();
            }
        };
    }

    function closeModal() {
        var modal = document.getElementById('classroomModal');
        modal.style.display = 'none';

        // Clear modal content when closing
        var modalContent = document.querySelector('.modal-content');
        modalContent.innerHTML = '';
    }

    function displayWorkerStatus(workerName) {
        // Get the modal content element
        var modalContent = document.querySelector('.modal-content');

        // Display the worker's name
        var workerNameElement = document.createElement('p');
        workerNameElement.textContent = 'Worker Details: ' + workerName;
        modalContent.appendChild(workerNameElement);

        // Display the status "Pending" beside the worker's name
        var statusElement = document.createElement('p');
        statusElement.textContent = 'Status: Peng';
        modalContent.appendChild(statusElement);
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var statusButtons = document.querySelectorAll('.status-btn');

        statusButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var currentStatus = button.getAttribute('data-status');
                var newStatus = currentStatus === 'pending' ? 'completed' : 'pending';
                var workerName = button.getAttribute('data-worker');

                // Update the button status and text
                button.setAttribute('data-status', newStatus);
                button.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);

                // Send an AJAX request to update the user's status in the database
                updateStatus(workerName, newStatus);
            });
        });

        function updateStatus(workerName, status) {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Define the request details (method, URL, asynchronous)
    xhr.open('POST', 'busy.php', true);

    // Set the request header for POST data
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Define the callback function for when the request is complete
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            console.log('Response:', xhr.responseText);
            // Handle the response if needed
            if (xhr.status == 200) {
                console.log('Status updated successfully');
            } else {
                console.error('Error updating status:', xhr.status, xhr.statusText);
            }
        }
    };

    // Prepare the data to send
    var data = 'worker_name=' + encodeURIComponent(workerName) + '&status=' + encodeURIComponent(status);

    // Send the request with the data
    xhr.send(data);
}
    });
</script>




</head>
<body>
<header>
    <nav>
    <h1 class="container">Housekeeping <br> Management</h1>
			<ul id="navli">
            <li><a class="homered" href="myjob.php">MY JOB</a></li>
            <li><a class="homeblack" href="assetreq.php">REQUEST ASSET</a></li>
            <li><a class="homeblack" href="login.html">LOG OUT</a></li>
        </ul>
    </nav>
</header>
<div class="divider"></div>
<div class="details-box">
    <h1>Job Details</h1>
    <table class="details-table">
        <tr>
            <th>Job ID</th>
            <td><?php echo $job['job_id']; ?></td>
        </tr>
        <tr>
            <th>From Date</th>
            <td><?php echo $job['from_date']; ?></td>
        </tr>
        <tr>
            <th>To Date</th>
            <td><?php echo $job['to_date']; ?></td>
        </tr>
        <tr>
            <th>Floor Number</th>
            <td><?php echo $job['floor_no']; ?></td>
        </tr>
        <tr>
            <th>Supervisor Name</th>
            <td><?php echo $job['supervisor']; ?></td>
        </tr>
<tr>
    <th>Workers Name</th>
    <td>
        <!-- Add a details button for each worker -->
        <button class="details-button" onclick="showWorkerDetails('<?php echo $job['worker_name']; ?>')">Details</button>
    </td>
</tr>
    </table>
    <div class="image-upload">
        <h2>Attach Image</h2>
        <form action="upload_image.php?job_id=<?php echo $job_id; ?>" method="POST" enctype="multipart/form-data">
            <input type="file" name="image" id="image" accept="image/*" required>
            <button type="submit" class="upload-button">Upload</button>
        </form>
    </div>
</div>

<div class="center-align">
    <button class="submit-button">Submit</button>
</div>
<div class="message-box">
    <div class="message">
        <span id="message-text"></span>
        <span class="tick-icon">&#10004;</span>
    </div>
</div>

</body>
<!-- Modal for Worker Details -->
<div id="classroomModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Assigned Classrooms</h2>
        <table class="details-table">
           
        <!-- Add rows dynamically for each assigned classroom -->
        <tr>
    <th>Classroom 1-5</th>
    <td>
        <?php echo $job['assigned_classroom']; ?>
        <!-- Add a hidden input field to store the worker name -->
        <input type="hidden" class="worker-name" value="<?php echo $job['assigned_classroom']; ?>">
    </td>
    <td>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "housekeeping";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $workerName = $job['assigned_classroom'];
        $query = "SELECT * FROM userinfo WHERE firstName='$workerName'";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        // User is authenticated
        while($row = mysqli_fetch_assoc($result)){
         
            $busyStatus = $row['busy'];
        

        // Assuming you have fetched the 'busy' status from the database
        // Implement this function to get the 'busy' status

        // Display the button based on the 'busy' status
        if ($busyStatus == 1) {
            echo '<button class="status-btn" data-status="pending">Pending</button>';
        } else {
            echo '<button class="status-btn" data-status="completed">Completed</button>';

        }
    }
    }
    else {
        echo '<button class="status-btn" data-status="pending">Pending</button>';

    }
        ?>
    </td>
</tr>



<tr>
    <th>Classroom 6-10</th>
    <td>
        <?php echo $job['assigned_classroom2']; ?>
        <!-- Add a hidden input field to store the worker name -->
        <input type="hidden" class="worker-name" value="<?php echo $job['assigned_classroom2']; ?>">
    </td>
    <td>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "housekeeping";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $workerName = $job['assigned_classroom2'];
        $query = "SELECT * FROM userinfo WHERE firstName='$workerName'";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        // User is authenticated
        while($row = mysqli_fetch_assoc($result)){
         
            $busyStatus = $row['busy'];
        

        // Assuming you have fetched the 'busy' status from the database
        // Implement this function to get the 'busy' status

        // Display the button based on the 'busy' status
        if ($busyStatus == 1) {
            echo '<button class="status-btn" data-status="pending">Pending</button>';
        } else {
            echo '<button class="status-btn" data-status="completed">Completed</button>';

        }

    }
    
    }
    else {
        echo '<button class="status-btn" data-status="pending">Pending</button>';

    }
        ?>
    </td>
</tr>

            <tr>
                <th>Classroom 11-15</th>
                <td>
        <?php echo $job['assigned_classroom3']; ?>
        <!-- Add a hidden input field to store the worker name -->
        <input type="hidden" class="worker-name" value="<?php echo $job['assigned_classroom3']; ?>">
    </td>
    <td>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "housekeeping";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $workerName = $job['assigned_classroom3'];
        $query = "SELECT * FROM userinfo WHERE firstName='$workerName'";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        // User is authenticated
        while($row = mysqli_fetch_assoc($result)){
         
            $busyStatus = $row['busy'];
        

        // Assuming you have fetched the 'busy' status from the database
        // Implement this function to get the 'busy' status

        // Display the button based on the 'busy' status
        if ($busyStatus == 1) {
            echo '<button class="status-btn" data-status="pending">Pending</button>';
        } else {
            echo '<button class="status-btn" data-status="completed">Completed</button>';

        }

    }
    
    }
    else {
        echo '<button class="status-btn" data-status="pending">Pending</button>';

    }
        ?>
    </td>                
            </tr>
            <tr>
                <th>Classroom 16-20</th>
                <td>
        <?php echo $job['assigned_classroom4']; ?>
        <!-- Add a hidden input field to store the worker name -->
        <input type="hidden" class="worker-name" value="<?php echo $job['assigned_classroom4']; ?>">
    </td>
    <td>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "housekeeping";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $workerName = $job['assigned_classroom4'];
        $query = "SELECT * FROM userinfo WHERE firstName='$workerName'";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        // User is authenticated
        while($row = mysqli_fetch_assoc($result)){
         
            $busyStatus = $row['busy'];
        

        // Assuming you have fetched the 'busy' status from the database
        // Implement this function to get the 'busy' status

        // Display the button based on the 'busy' status
        if ($busyStatus == 1) {
            echo '<button class="status-btn" data-status="pending">Pending</button>';
        } else {
            echo '<button class="status-btn" data-status="completed">Completed</button>';

        }

    }
    
    }
    else {
        echo '<button class="status-btn" data-status="pending">Pending</button>';

    }
        ?>
    </td>               </td>
            </tr>
            <tr>
                <th>Classroom 21-25</th>
                <td>
        <?php echo $job['assigned_classroom5']; ?>
        <!-- Add a hidden input field to store the worker name -->
        <input type="hidden" class="worker-name" value="<?php echo $job['assigned_classroom5']; ?>">
    </td>
    <td>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "housekeeping";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $workerName = $job['assigned_classroom5'];
        $query = "SELECT * FROM userinfo WHERE firstName='$workerName'";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        // User is authenticated
        while($row = mysqli_fetch_assoc($result)){
         
            $busyStatus = $row['busy'];
        

        // Assuming you have fetched the 'busy' status from the database
        // Implement this function to get the 'busy' status

        // Display the button based on the 'busy' status
        if ($busyStatus == 1) {
            echo '<button class="status-btn" data-status="pending">Pending</button>';
        } else {
            echo '<button class="status-btn" data-status="completed">Completed</button>';

        }

    }
    
    }
    else {
        echo '<button class="status-btn" data-status="pending">Pending</button>';

    }
        ?>
    </td>                </td>
            </tr>
            <tr>
                <th>Classroom 26-30</th><td>
        <?php echo $job['assigned_classroom6']; ?>
        <!-- Add a hidden input field to store the worker name -->
        <input type="hidden" class="worker-name" value="<?php echo $job['assigned_classroom6']; ?>">
    </td>
    <td>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "housekeeping";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $workerName = $job['assigned_classroom6'];
        $query = "SELECT * FROM userinfo WHERE firstName='$workerName'";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        // User is authenticated
        while($row = mysqli_fetch_assoc($result)){
         
            $busyStatus = $row['busy'];
        

        // Assuming you have fetched the 'busy' status from the database
        // Implement this function to get the 'busy' status

        // Display the button based on the 'busy' status
        if ($busyStatus == 1) {
            echo '<button class="status-btn" data-status="pending">Pending</button>';
        } else {
            echo '<button class="status-btn" data-status="completed">Completed</button>';

        }

    }
    
    }
    else {
        echo '<button class="status-btn" data-status="pending">Pending</button>';

    }
        ?>
    </td>             </td>
            </tr>
            <tr>
                <th>Restroom</th><td>
        <?php echo $job['assigned_classroom7']; ?>
        <!-- Add a hidden input field to store the worker name -->
        <input type="hidden" class="worker-name" value="<?php echo $job['assigned_classroom7']; ?>">
    </td>
    <td>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "housekeeping";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $workerName = $job['assigned_classroom7'];
        $query = "SELECT * FROM userinfo WHERE firstName='$workerName'";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        // User is authenticated
        while($row = mysqli_fetch_assoc($result)){
         
            $busyStatus = $row['busy'];
        

        // Assuming you have fetched the 'busy' status from the database
        // Implement this function to get the 'busy' status

        // Display the button based on the 'busy' status
        if ($busyStatus == 1) {
            echo '<button class="status-btn" data-status="pending">Pending</button>';
        } else {
            echo '<button class="status-btn" data-status="completed">Completed</button>';

        }

    }
    
    }
    else {
        echo '<button class="status-btn" data-status="pending">Pending</button>';

    }
        ?>
    </td>               </td>
            </tr>
            <tr>
                <th>Staffroom</th><td>
        <?php echo $job['assigned_classroom8']; ?>
        <!-- Add a hidden input field to store the worker name -->
        <input type="hidden" class="worker-name" value="<?php echo $job['assigned_classroom8']; ?>">
    </td>
    <td>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "housekeeping";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $workerName = $job['assigned_classroom8'];
        $query = "SELECT * FROM userinfo WHERE firstName='$workerName'";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        // User is authenticated
        while($row = mysqli_fetch_assoc($result)){
         
            $busyStatus = $row['busy'];
        

        // Assuming you have fetched the 'busy' status from the database
        // Implement this function to get the 'busy' status

        // Display the button based on the 'busy' status
        if ($busyStatus == 1) {
            echo '<button class="status-btn" data-status="pending">Pending</button>';
        } else {
            echo '<button class="status-btn" data-status="completed">Completed</button>';

        }

    }
    
    }
    else {
        echo '<button class="status-btn" data-status="pending">Pending</button>';

    }
        ?>
    </td>            </td>
            </tr>
            <tr>
                <th>Lab</th><td>
        <?php echo $job['assigned_classroom9']; ?>
        <!-- Add a hidden input field to store the worker name -->
        <input type="hidden" class="worker-name" value="<?php echo $job['assigned_classroom9']; ?>">
    </td>
    <td>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "housekeeping";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $workerName = $job['assigned_classroom9'];
        $query = "SELECT * FROM userinfo WHERE firstName='$workerName'";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        // User is authenticated
        while($row = mysqli_fetch_assoc($result)){
         
            $busyStatus = $row['busy'];
        

        // Assuming you have fetched the 'busy' status from the database
        // Implement this function to get the 'busy' status

        // Display the button based on the 'busy' status
        if ($busyStatus == 1) {
            echo '<button class="status-btn" data-status="pending">Pending</button>';
        } else {
            echo '<button class="status-btn" data-status="completed">Completed</button>';

        }

    }
    
    }
    else {
        echo '<button class="status-btn" data-status="pending">Pending</button>';

    }
        ?>
    </td>               </td>
            </tr>
            
            <!-- Add more rows as needed -->
        </table>
        <!-- Include jQuery from CDN -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

       <script>
        $(document).ready(function() {
    $(".status-btn").on("click", function() {
        var statusBtn = $(this);
        var workerName = statusBtn.closest('tr').find('.worker-name').val();

        // Make AJAX request
        $.ajax({
            type: "POST",
            url: "update_busy_status.php",
            data: { worker_name: workerName },
            dataType: "json",
            success: function(response) {
                alert(response.message);

                if (response.success) {
                    console.log(response.workerName);
                } else {
                    console.error("Update failed");
                }
            },
            error: function(error) {
                console.error("AJAX Error:", error);
            }
        });
    });
});

       </script>

    </div>
</div>
</html>

<?php
} else {
    echo "Job ID not provided.";
}
?>