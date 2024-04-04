<?php
require_once('process/dbh.php');
$sql = "SELECT bio_id, firstName, Designation FROM userinfo WHERE Designation = 'Supervisor'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>
<html>
<head>
    <title>Admin Panel | Housekeeping Management System</title>
    <link rel="stylesheet" type="text/css" href="styleemplogin.css">
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
                <li><a class="homered" href="storewel.php">HOME</a></li>
                <li><a class="homeblack" href="login.html">LOG OUT</a></li>
            </ul>
        </nav>
    </header><BR>
    <!-- <div class="divider"></div> -->

    <table>
        <tr>
            <th align="center">Bio_id</th>
            <th align="center">FirstName</th>
            <th align="center">Designation</th>
            <th align="center">Options</th>
        </tr>

        <?php
        while ($userinfo = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$userinfo['bio_id']."</td>";
            echo "<td>".$userinfo['firstName']."</td>";
            echo "<td>".$userinfo['Designation']."</td>";
            echo "<td><a href=\"view_history.php?bio_id={$userinfo['bio_id']}\">View</a></td>";
            echo "</tr>";
        }
        ?>

    </table>
</body>
</html>
