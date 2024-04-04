<?php
session_start();
require_once('process/dbh.php');
$supervisorName = $_SESSION["bio_id"];

// SQL query to select jobs assigned to the logged-in supervisor
$sql = "SELECT asset_id, asset_name, asset_quantity FROM assets"; 
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Handle asset request submission
if (isset($_POST['submit_request'])) {
    $assetID = $_POST['asset_id'];
    $quantity = $_POST['quantity'];
    $bioID = $_SESSION['bio_id'];

   // Check if the asset quantity is sufficient for the request
    $checkQuantitySql = "SELECT asset_quantity FROM assets WHERE asset_id = '$assetID'";
    $quantityResult = mysqli_query($conn, $checkQuantitySql);

    if (!$quantityResult) {
        die("Error: " . mysqli_error($conn));
    }

    $asset = mysqli_fetch_assoc($quantityResult);
    $assetQuantity = $asset['asset_quantity'];

    if ($quantity > 0 && $quantity <= $assetQuantity) {
        // SQL query to insert the asset request into the "requestasset" table
        $insertSql = "INSERT INTO requestasset (asset_id, request_quantity, bio_id) VALUES ('$assetID', '$quantity', '$bioID')";
        $insertResult = mysqli_query($conn, $insertSql);

        if ($insertResult) {
            echo "Asset request submitted successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Sorry, the requested quantity is not available for this asset.";
    }
} // Missing closing brace for the if statement checking the submission of the asset request
?>


<html>
<head>
    <title>Admin Panel | Housekeeping Management System</title>
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
    height: 0px;
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
    .accept-button {
        background-color: #8BCA02;
        color: white;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 5px;
    }

    .accept-button:hover {
        background-color: #5F9900;
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
        form{
            background:#13287e;
    padding: 16px;
        }

        input.asset-input {
    padding: 14px;
    border-radius: 10px;
}

input.quantity-input {
    padding: 14px;
    border-radius: 10px;
}
button{
    padding: 10px;
    border-radius: 10px;
    width: 154px;
    height: 45px;
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
                <li><a class="homered" href="assetreq.php">REQUEST ASSEST</a></li>
                <li><a class="homeblack" href="login.html">LOG OUT</a></li>
                <li><a class="homeblack" href="login.html"><?php echo $_SESSION['bio_id']; ?></a></li>
            </ul>
        </nav>
    </header>
    <div class="divider"></div>

    <table>
        <tr>
            <th align="center">Asset ID</th>
            <th align="center">Asset Name</th>
            <th align="center">Asset Quantity</th>
        </tr>

        <?php
        while ($asset = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<tr onclick=\"showRequestForm('{$asset['asset_id']}')\">";
            echo "<td>".$asset['asset_id']."</td>";
            echo "<td>".$asset['asset_name']."</td>";
            echo "<td>".$asset['asset_quantity']."</td>";
        }
        ?>

    </table>

    <!-- Add the asset request form -->
    <div id="asset-request" style="display:none">
        <form method="POST" action="">
            <input type="text" class="asset-input" name="asset_id" id="selected_asset_id" placeholder="Asset ID">
            <input type="number" class="quantity-input" name="quantity" placeholder="Quantity">
            <button type="submit" name="submit_request" class="request-button">Request</button>
        </form>
    </div>
    <script>
        function showRequestForm(assetId) {
            document.getElementById('selected_asset_id').value = assetId;
            document.getElementById('asset-request').style.display = 'block';
        }
    </script>
</body>
</html>