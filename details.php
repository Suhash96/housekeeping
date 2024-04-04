<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
require_once('process/dbh.php'); // Include your database connection code here

// Check if a bio_id parameter is provided in the URL
if (isset($_GET['bio_id'])) {
    $bio_id = $_GET['bio_id'];

    // Query to fetch asset details and asset name based on bio_id
    $detailsSql = "SELECT ra.asset_id, ra.request_quantity, a.asset_name
                   FROM requestasset ra
                   JOIN assets a ON ra.asset_id = a.asset_id
                   WHERE ra.bio_id = '$bio_id'";
    
    $detailsResult = mysqli_query($conn, $detailsSql);

    if ($detailsResult && mysqli_num_rows($detailsResult) > 0) {
        echo "<html>";
        echo "<head>";
        echo "<title>housekeeping | Housekeeping Management System</title>";
        echo "<link rel='stylesheet' type='text/css' href='style.css'>";
        echo "<style>
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
            text-decoration: none;
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
        
element.style {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
}
img {
    width: 50px;
    float: left;
    margin-left: 75px;
    /* margin-top: 17px; */
    height: 38px;
}
        </style>";
        echo "</head>";
        echo "<body>";

        echo "<header>
        <nav>
        <img src='logo.png' alt='Description of the image'>
        <h1 class='container'>Housekeeping <br> Management</h1>
        <ul id='navli'>
                <li><a class='homeblack' href='storewel.php'>HOME</a></li>
                <li><a class='homered' href='#'>requested asset</a></li>
                <li><a class='homeblack' href='login.html'>Log Out</a></li>
            </ul>
        </nav>
        </header>";
        echo "<div class='page-wrapper bg-blue p-t-100 p-b-100 font-robo'>";
        echo "<div class='wrapper wrapper--w680'>";
        echo "<div class='card card-1'>";
        echo "<div class='card-heading'></div>";
        echo "<div class='card-body'>";
        echo "<div class='content'>";
        echo "<h2>Asset Details</h2>";

        // Create an HTML form to display asset details and handle the subtract operation
        echo "<form method='post' action=''>";
        echo "<table border='1'>";
        echo "<tr><th>Asset ID</th><th>Asset Name</th><th>Asset Quantity</th></tr>";

        $assetQuantitiesToUpdate = []; // To store asset quantities for update

        while ($row = mysqli_fetch_assoc($detailsResult)) {
            $assetID = $row['asset_id'];
            $assetQuantity = $row['request_quantity'];
            $assetName = $row['asset_name'];

            echo "<tr>";
            echo "<td>$assetID</td>";
            echo "<td>$assetName</td>";
            echo "<td>$assetQuantity</td>";
            echo "</tr>";

            // Store asset quantities for update
            $assetQuantitiesToUpdate[$assetID] = $assetQuantity;
        }

        echo "</table>";

        // Add the "Request Accept" button below the table (outside the loop)
        echo "<div style='text-align: center; margin-top: 20px;'>";
        echo "<button type='submit' name='request_accept' style='    background-color: #13287e;color: white; padding: 10px 20px; border: none; cursor: pointer;'>Request Accept</button>";
        echo "</div>";
        echo "</form>";

        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</body>";
        echo "</html>";

        // Check if the "Request Accept" button was pressed
        if (isset($_POST['request_accept'])) {
            // Initialize a flag to track if any errors occur during the update and insert operations
            $errorOccurred = false;

            // Retrieve the firstName associated with the bio_id from the userinfo table
            $userInfoSql = "SELECT firstName FROM userinfo WHERE bio_id = '$bio_id'";
            $userInfoResult = mysqli_query($conn, $userInfoSql);

            if ($userInfoResult && mysqli_num_rows($userInfoResult) > 0) {
                $userInfoRow = mysqli_fetch_assoc($userInfoResult);
                $firstName = $userInfoRow['firstName'];

                // Update asset_quantity in the assets table and add to asset_history
                foreach ($assetQuantitiesToUpdate as $assetID => $quantity) {
                    // Update asset_quantity in the assets table
                    $updateSql = "UPDATE assets SET asset_quantity = asset_quantity - $quantity WHERE asset_id = '$assetID'";
                    $updateResult = mysqli_query($conn, $updateSql);

                    if (!$updateResult) {
                        echo "Error updating asset quantity for asset ID: $assetID - " . mysqli_error($conn) . "<br>";
                        $errorOccurred = true;
                    } else {
                        // Get the current date and time with year, month, day, hour, minute, and second
                        $currentDate = date("Y-m-d H:i:s");

                        // After updating the asset quantity, insert a record into the asset_history table with asset_id, bio_id, firstName, asset_name, asset_quantity, and date
                        $historySql = "INSERT INTO asset_history (asset_id, bio_id, firstName, asset_name, asset_quantity, date) 
                                       VALUES ('$assetID', '$bio_id', '$firstName', '$assetName', $quantity, '$currentDate')";
                        $historyResult = mysqli_query($conn, $historySql);

                        if (!$historyResult) {
                            echo "Error recording asset history for asset ID: $assetID - " . mysqli_error($conn) . "<br>";
                            $errorOccurred = true;
                        }
                    }
                }

                if (!$errorOccurred) {
                    // Delete the requested asset details
                    $deleteSql = "DELETE FROM requestasset WHERE bio_id = '$bio_id'";
                    $deleteResult = mysqli_query($conn, $deleteSql);

                    if ($deleteResult) {
                        echo "Asset quantities updated and details deleted successfully.";
                        // Redirect to reqdasset.php using JavaScript
                        echo '<script>window.location.href = "reqdasset.php";</script>';
                    } else {
                        echo "Error deleting asset details: " . mysqli_error($conn);
                    }
                } else {
                    echo "Errors occurred during the update and history recording.";
                }
            } else {
                echo "No user information found for this Bio ID.";
            }
        }
    } else {
        echo "No asset details found for this Bio ID.";
    }
} else {
    // Handle the case when no bio_id parameter is provided
    echo "Please provide a valid Bio ID.";
}
?>
