<?php
require_once('process/dbh.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asset_id = $_POST["asset_id"];
    $asset_name = $_POST["assetName"];
    $asset_quantity = $_POST["assetQuantity"];

    // Check if the asset with the same asset_id already exists in the database
    $checkSql = "SELECT * FROM assets WHERE asset_id = '$asset_id'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (!$checkResult) {
        die("Error checking assets: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($checkResult) > 0) {
        // Asset ID already exists, show a warning message
        // 
        // $update="UPDATE assets SET asset_quantity='$asset_quantity";
        // $updateresult=mysqli_query($conn,$update);
    } else {
        // Asset ID doesn't exist, insert a new record
        $insertSql = "INSERT INTO assets (asset_id, asset_name, asset_quantity) VALUES ('$asset_id', '$asset_name', '$asset_quantity')";
        $insertResult = mysqli_query($conn, $insertSql);

        if ($insertResult) {
            echo "<script>alert('Asset added successfully.');</script>";
        } else {
            echo "<script>alert('Error adding asset: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>
<!DOCTYPE html>
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

        .center-box {
            display: flex;
            justify-content:left;
            align-items: center;
            height: 90vh; /* This ensures the form is vertically centered on the viewport */
        }

        .form-container {
            background-color: #fff; /* Add a background color to your form container */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 70%; /* Set the width of the form container */
            max-width: 400px; /* Add a max-width to limit its size */
        }
        .form-container {
    background-color: #f5f5f5;
    padding: 44px;
    border-radius: 44px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    width: 70%;
    max-width: 400px;
    margin: 0 auto; /* Center the form horizontally */
    text-align:left;
}

/* Style for the form headings */
.form-container h2 {
    color: #005690;
    margin-bottom: 20px;
}

/* Style for the form labels */
.form-container label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

/* Style for the form input fields */
.form-container input[type="text"],
.form-container input[type="number"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Style for the submit button */
.form-container input[type="submit"] {
    background-color: #005690;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-container input[type="submit"]:hover {
    background-color: #003e64; /* Darker color on hover */
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
            <li><a class="homered" href="addstore.php">ADD ASSETS</a></li>
            <li><a class="homeblack" href="login.html1">LOG OUT</a></li>
        </ul>
    </nav>
</header>

<div class="divider"></div>

<div class="center-box">
    <div class="form-container">
        <h2>Add New assets</h2>
        <form method="post" action="">
            <label for="asset_id">Assets id:</label>
            <input type="text" name="asset_id" required><br><br>

            <label for="assetsName">Assets Name:</label>
            <input type="text" name="assetName" required><br><br>

            <label for="assetsQuantity">Assets Quantity:</label>
            <input type="number" name="assetQuantity" required><br><br>

            <input type="submit" value="Add assets">
        </form>
    </div>
</div>

</body>
</html>

