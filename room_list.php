<?php
session_start();
require_once('process/dbh.php');

// Retrieve job_id and floor_no from URL parameters
$jobId = $_GET['job_id'];
$userFloor = $_GET['floor_no'];

// SQL query to select rooms based on the user's floor number
$sql = "SELECT room_no, room_type FROM building WHERE floor_no = '$userFloor'";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<html>
<head>

    <title>Room List</title>
    <link rel="stylesheet" type="text/css" href="styleemplogin.css">
	<style>
 

 <style>
		body{
            overflow-y: scroll;
        }
		
		.container {
    background-color: #13287e;
}
.logo {
    font-size: 2em;
    color: #fff;
    user-select: none;
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
    height: 0px;
}
.divider {
    background-color: #13287e;
    height: 5px;
}
nav ul li a {
    color: #00000;
    text-decoration: none;
}   .accept-button {
        background-color: #8BCA02;
        color: white;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 5px;
    }

    .accept-button:hover {
        background-color: #5F9900;
    }

    .page-wrapper {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        margin: 20px;
    }

    .card-1 {
        background: #fff;
        border-radius: 5px;
        box-shadow: 0px 0px 20px 0px #000000;
    }
    .classroom-list li {
        margin: 10px 0;
        border: 1px solid #ddd; /* Add borders to the <li> elements */
        padding: 5px;
        border-radius: 5px; /* Add some rounded corners */
    }

    /* Style the <a> links inside the <li> elements */
    .classroom-list li a {
        text-decoration: none;
        color: #000; /* Change link color */
    }

    /* Add padding and background color to <a> links on hover */
    .classroom-list li a:hover {
        background-color: #8BCA02;
        color: #fff; /* Change link color on hover */
        padding: 5px 10px;
        border-radius: 5px; /* Add some rounded corners on hover */
    }
    
    

   

    .card-body {
        padding: 20px;
    }

    .content h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .classroom-list {
        list-style-type: none;
        padding: 0;
    }

    .classroom-list li {
        margin: 10px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #ddd;
        text-align: left;
    }

    th, td {
        padding: 10px;
    }

    th {
        background-color: #005690;
        color: white;
    }
    .table-style {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table-style th, .table-style td {
    border: 1px solid #ddd;
    text-align: center; /* Center-align text in table cells */
    padding: 10px;
}

.table-style th {
    background-color: #005690;
    color: white;
}

/* Add borders between table rows */
.table-style tr:not(:first-child) {
    border-top: 1px solid #ddd;
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
<body>
<header>
        <nav>
        <img src="logo.png" alt="Description of the image">
        <h1 class="container">Housekeeping <br> Management</h1>
			<ul id="navli">
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
        <h1>Classroom List</h1>
        <ul class="classroom-list">
    <h1>List of Rooms on Floor <?php echo $userFloor; ?></h1>
    <div class="divider"></div>
    <form method="post" action="assign_classroom.php">
</form>

    <table>
        <!-- <?php
        while ($room = mysqli_fetch_assoc($result)) {

            
            echo "<li><a href='worker_list_1-5.php'>Classroom 1-5</a></li>";
            echo "<li><a href='worker_list_6-10.php'>Classroom 6-10</a></li>";
            echo "<li><a href='worker_list_11-15.php'>Classroom 11-15</a></li>";
            echo "<li><a href='worker_list_16-20.php'>Classroom 16-20</a></li>";
            echo "<li><a href='worker_list_21-25.php'>Classroom 21-25</a></li>";
            echo "<li><a href='worker_list_26-30.php'>Classroom 26-30</a></li>";
            echo "<li><a href='worker_list.php'>restroom</a></li>";
            echo "<li><a href='worker_list.php'>staff room</a></li>";
            echo "<li><a href='worker_list.php'>lab</a></li>";
            
            // echo "<tr>";
            // echo "<td>".$room['room_no']."</td>";
            // echo "<td>".$room['room_type']."</td>";
            // echo "</tr>";
        }
        ?> -->
        <div style="text-align: center;">

    </table>
    <li><a href='worker_list_1-5.php?job_id=<?php echo $jobId; ?>&classroom=Classroom1-5'>Classroom 1-5</a></li>
    <li><a href='worker_list_6-10.php?job_id=<?php echo $jobId; ?>&classroom=Classroom6-10'>Classroom 6-10</a></li>
    <li><a href='worker_list_11-15.php?job_id=<?php echo $jobId; ?>&classroom=Classroom11-15'>Classroom 11-15</a></li>
    <li><a href='worker_list_16-20.php?job_id=<?php echo $jobId; ?>&classroom=Classroom16-20'>Classroom 16-20</a></li>
    <li><a href='worker_list_21-25.php?job_id=<?php echo $jobId; ?>&classroom=Classroom21-25'>Classroom 21-25</a></li>
    <li><a href='worker_list_26-30.php?job_id=<?php echo $jobId; ?>&classroom=Classroom26-30'>Classroom 26-30</a></li>
    <li><a href='worker_list.php?job_id=<?php echo $jobId; ?>&classroom=restroom'>restroom</a></li>
    <li><a href='worker_list.php?job_id=<?php echo $jobId; ?>&classroom=staffroom'>staff room</a></li>
    <li><a href='worker_list.php?job_id=<?php echo $jobId; ?>&classroom=lab'>lab</a></li>
            
</body>
</html>








