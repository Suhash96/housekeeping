<?php
require_once('process/dbh.php');

// Get the bio_id from the URL parameter
if (isset($_GET['bio_id'])) {
    $bio_id = $_GET['bio_id'];

    // Query the asset_history table for history records associated with the bio_id
    $sql = "SELECT asset_id, asset_name, asset_quantity, date FROM asset_history WHERE bio_id = $bio_id";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }
}
?>

<html>
<head>
    <title>Asset History</title>
    <link rel="stylesheet" type="text/css" href="styleemplogin.css">
    <style>
        /* Add the CSS styles specific to this page */
        /* You can customize these styles as needed */
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
        /* Remove the specific CSS styles for the date column */
        .date-column {
            /* No need to specify background-color or text color */
        }

        /* Add more column-specific styles as needed */

        /* Styles for the "OK" button container */
        .button-container {
            text-align: center;
            margin-top: 20px; /* Adjust the margin as needed for vertical positioning */
        }

        /* Styles for the "OK" button */
        .ok-button {
            background-color:#13287e ; /* Green color */
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
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
    </header>
    <div class="divider"></div>

    <h2>Asset History For BioID: <?php echo $bio_id; ?></h2>

    <table>
        <tr>
            <th class="date-column">Date</th>
            <th class="asset-id-column">Asset ID</th>
            <th>Asset Name</th>
            <th>Asset Quantity</th>
            
            <!-- Add more columns as needed for your asset history -->
        </tr>

        <?php
        while ($history = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class='date-column'>" . $history['date'] . "</td>";
            echo "<td class='asset-id-column'>" . $history['asset_id'] . "</td>";
            echo "<td>" . $history['asset_name'] . "</td>";
            echo "<td>" . $history['asset_quantity'] . "</td>";
            // Add more columns as needed for your asset history
            echo "</tr>";
        }
        ?>

    </table>

    <!-- "OK" button container -->
    <div class="button-container">
        <button class="ok-button" onclick="window.location.href='assethis.php'">OK</button>
    </div>
</body>
</html>
