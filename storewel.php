<?php
require_once('process/dbh.php');
$sql = "SELECT asset_id, asset_name,asset_quantity FROM assets";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>
<html>
<head>
	<title>Store keeper | housekeeping Management System</title>
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

.divider {
    background-color: #ffffff;
    height: 40px;
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
button {
	border:solid;
    background-color: #13287e;
    color: white;
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
				<li><a class="homeblack" href="addstore.php">ADD ASSET</a></li>
				<li><a class="homeblack" href="reqdasset.php">REQUESTED ASSET</a></li>
                <li><a class="homeblack" href="assethis.php">ASSET HISTORY</a></li>
				<li><a class="homeblack" href="login.html">LOG OUT</a></li>
			</ul>
		</nav>
	</header>
	<div class="divider"></div>

		<table>
			<tr>

				<th align = "center">Asset Id</th>
				<th align = "center">Asset Name</th>
				<th align = "center">Asset Quantity</th>
				<th align = "center">Options</th>
			</tr>

			<?php
				while ($userinfo = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$userinfo['asset_id']."</td>";
					echo "<td>".$userinfo['asset_name']."</td>";
					echo "<td>".$userinfo['asset_quantity']."</td>";
					echo "<td><a href=\"deletea.php?asset_id={$userinfo['asset_id']}\" onClick=\"return confirm('Are you sure you want to delete?')\"><BUTTON>Delete</BUTTON></a></td>";

				}


			?>

		</table>
		
	
</body>
</html>
	 
	