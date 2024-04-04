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
    height: 4px;
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
button {
	border:solid;
    background-color: #13287e;
    color: white;
}
tr:hover {
    background-color: #90a2ed;
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

       

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: #005690;
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }
        h2 {
    display: block;
    font-size: 1.5em;
    margin-block-start: 0.83em;
    margin-block-end: 0.83em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
    font-family:Poppins, sans-serif;
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
                <li><a class="homeblack" href="storewel.php">HOME</a></li>
                <li><a class="homered" href="#">REQUESTED ASSET</a></li>
                <li><a class="homeblack" href="login.html">LOG OUT</a></li>
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
