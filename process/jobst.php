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
        		.container {
    background-color:#005690;
}
.logo {
    font-size: 2em;
    color: #fff;
    user-select: none;
}
.homered {
    background-color:#005690;
    padding: 30px 10px 22px 10px;
}
header h1 {
    display: inline;
    font-family:Poppins, sans-serif;
    font-weight: 400;
    font-size: 32px;
    float: left;
    margin-top: 0px;
    margin-right: 10px;
}
.homered {
    background-color: #005690;
    padding: 30px 10px 20px 10px;
}

  .divider{
	background-color: rgb(0, 86, 144);
	height: 5px;
  }
  
  .homeblack:hover{
	background-color: rgb(0 86 144);
	padding: 30px 10px 18px 10px;
  
  }


  header {
    background: #005690;
    color: white;
    padding: 18px 20px 53px 40px;
    height: 4px;
}

		.divider {
    background-color: #8BCA02;
    height: 5px;
}
nav ul li a {
    color: #00000;
    text-decoration: none;
}
        header {
            background-color: #005690;
        }
        .divider {
            background-color: #8BCA02;
            height: 5px;
        }
       

.homered {
    background-color: rgb(0 86 144);
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
            background-color: #4CAF50;
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

                                echo "<tr>";
                                echo "<td><a href='details.php?bio_id=$bioID'>$bioID</a></td>";
                                echo "<td>$firstName</td>";
                                echo "<td><a href=\"details.php?bio_id=$bioID\">View</a> | <a href=\"delete_request.php?bio_id=$bioID\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

                                echo "</tr>";
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
