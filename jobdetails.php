<?php
session_start();
require_once('process/dbh.php');

// SQL query to select distinct bio_id values from the requestasset table where bio_id is not NULL
$sql = "SELECT DISTINCT bio_id FROM requestasset WHERE bio_id IS NOT NULL";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>housekeeping | Housekeeping Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <style>
        header {
            background-color: #005690;
        }
        .divider {
            background-color: #8BCA02;
            height: 5px;
        }
        .homered {
            background-color: rgb(0, 43, 198);
            padding: 30px 10px 22px 10px;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #8BCA02;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: #005690;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <h1>Housekeeping</h1>
            <ul id="navli">
                <li><a class="homeblack" href="storewel.php">HOME</a></li>
                <li><a class="homered" href="#">requested asset</a></li>
                <li><a class="homeblack" href="login.html">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <div class="divider"></div>

    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <div class="content">
                        <h2>Requested Bio IDs</h2>
                        
                        <table>
                            <tr>
                                <th>Bio ID</th>
                                <th>First Name</th>
                                <th>Job ID</th>
                                <th>Floor No</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Options</th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $bioID = $row['bio_id'];

                                // Query to fetch first name from userinfo table
                                $firstNameQuery = "SELECT firstname FROM userinfo WHERE bio_id = '$bioID'";
                                $firstNameResult = mysqli_query($conn, $firstNameQuery);
                                $firstName = "";
                                if ($firstNameRow = mysqli_fetch_assoc($firstNameResult)) {
                                    $firstName = $firstNameRow['firstname'];
                                }

                                // Query to fetch job details from the job table
                                $jobQuery = "SELECT job_id, floor_no, from_date, to_date FROM job WHERE bio_id = '$bioID'";
                                $jobResult = mysqli_query($conn, $jobQuery);

                                while ($jobRow = mysqli_fetch_assoc($jobResult)) {
                                    $jobID = $jobRow['job_id'];
                                    $floorNo = $jobRow['floor_no'];
                                    $fromDate = $jobRow['from_date'];
                                    $toDate = $jobRow['to_date'];

                                    // Query to fetch job details from the workerlist table
                                    $workerListQuery = "SELECT * FROM workerlist WHERE job_id = '$jobID'";
                                    $workerListResult = mysqli_query($conn, $workerListQuery);
                                    $workerListData = mysqli_fetch_assoc($workerListResult);

                                    echo "<tr>";
                                    echo "<td><a href='details.php?bio_id=$bioID'>$bioID</a></td>";
                                    echo "<td>$firstName</td>";
                                    echo "<td>$jobID</td>";
                                    echo "<td>$floorNo</td>";
                                    echo "<td>$fromDate</td>";
                                    echo "<td>$toDate</td>";
                                    echo "<td><a href=\"details.php?bio_id=$bioID\">View</a> | <a href=\"delete_request.php?bio_id=$bioID\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
