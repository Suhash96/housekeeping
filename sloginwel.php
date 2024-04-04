<?php
session_start();
require_once ('process/dbh.php');
$supervisorBioId = $_SESSION["bio_id"];

// SQL query to select jobs assigned to the logged-in supervisor with supervisor's firstName
$sql = "SELECT job.job_id, job.floor_no, userinfo.firstName
        FROM job
        JOIN userinfo ON job.supervisor = userinfo.bio_id
        WHERE job.supervisor = '$supervisorBioId' AND job.status != 'completed'";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Check if a job has been marked as "completed" and delete it from the database
if (isset($_GET['completed_job_id'])) {
    $completedJobId = $_GET['completed_job_id'];
    $deleteSql = "DELETE FROM job WHERE job_id = '$completedJobId' AND supervisor = '$supervisorBioId'";
    $deleteResult = mysqli_query($conn, $deleteSql);

    if ($deleteResult) {
        // Job successfully deleted
        echo "<script>alert('Job marked as completed and deleted.');</script>";
    } else {
        // Error occurred while deleting the job
        echo "<script>alert('Error deleting the job.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel | Housekeeping Management System</title>
    <link rel="stylesheet" type="text/css" href="styleemplogin.css">
    <style>
        .accept-button {
            background-color: #8BCA02;
            /* Green color for the button */
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .accept-button:hover {
            background-color: #5F9900;
            /* Darker green color on hover */
        }

        .details-button {
            background-color: #0074D9;
            /* Blue color for the button */
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .details-button:hover {
            background-color: #0056b3;
            /* Darker blue color on hover */
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

        .divider {
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

        th {
            background-color: #13287e;
            color: white;
        }

        tr:hover {
            background-color: #90a2ed;
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
    </style>
</head>

<body>
    <header>
        <nav>
        <img src="logo.png" alt="Description of the image">
            <h1 class="container">Housekeeping <br> Management</h1>
            <ul id="navli">
                <li><a class="homered" href="sloginwel.php">HOME</a></li>
                <li><a class="homeblack" href="assetreq.php">REQUEST ASSETS</a></li>
                <li><a class="homeblack" href="login.html">LOGOUT</a></li>
            </ul>
        </nav>
    </header>
    <BR><BR>
    <!-- <div class="divider"></div> -->



    <table>
        <tr>
            <th>Job ID</th>
            <th>Floor Number</th>
            <th>Supervisor's Name</th>
            <th>Options</th>
        </tr>

        <?php
        while ($job = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $job['job_id'] . "</td>";
            echo "<td>" . $job['floor_no'] . "</td>";
            echo "<td>" . $job['firstName'] . "</td>";
            echo "<td>";
            echo "<a href='room_list.php?job_id=" . $job['job_id'] . "&floor_no=" . $job['floor_no'] . "' class='accept-button'>Accept</a>";
            echo "<a href='job_details.php?job_id=" . $job['job_id'] . "' class='details-button'>Details</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>

    </table>
</body>

</html>