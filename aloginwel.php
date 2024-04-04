<?php
require_once ('process/dbh.php');
$sql = "SELECT bio_id, firstName, lastName, email, contact, Designation, qualification FROM userinfo";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>
<html>

<head>
    <title>Admin Panel | housekeeping Management </title>
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
            border: solid;
            background-color: #13287e;
            color: white;
        }

        tr:hover {
            background-color: #90a2ed;
        }

        span {
            display: inline-block;
        }

        
    </style>
</head>

<body>

    <header>

        <nav>
            <img src="logo.png" alt="Description of the image">
            <h1 class="container">Housekeeping <br> Management</h1>
            <ul id="navli">
                <li><a class="homered" href="adminhomepage.html">HOME</a></li>
                <li><a class="homered" href="aloginwel.php">ALL DETAILS</a></li>
                <li><a class="homeblack" href="addemp.php">ADD EMPLOYEE</a></li>
                <li><a class="homeblack" href="building.php">MANAGE BUILDING</a></li>
                <li><a class="homeblack" href="index.html">LOG OUT</a></li>
            </ul>
        </nav>
    </header>
    <!-- <div class="divider"></div> -->

    <table>
        <tr>

            <th align="center">Bio_id</th>
            <th align="center">FirstName</th>
            <th align="center">LastName</th>
            <th align="center">Email</th>
            <th align="center">Contact</th>
            <th align="center">Designation</th>
            <th align="center">Qualification</th>
            <th align="center">Options</th>
        </tr>

        <?php
        while ($userinfo = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $userinfo['bio_id'] . "</td>";
            echo "<td>" . $userinfo['firstName'] . "</td>";
            echo "<td>" . $userinfo['lastName'] . "</td>";
            echo "<td>" . $userinfo['email'] . "</td>";
            echo "<td>" . $userinfo['contact'] . "</td>";
            echo "<td>" . $userinfo['Designation'] . "</td>";
            echo "<td>" . $userinfo['qualification'] . "</td>";
            echo "<td><a href=\"demo1.php?bio_id={$userinfo['bio_id']}\" onClick=\"return confirm('Are you sure you want to edit?')\"><button>Edit</button></a><a href=\"delete.php?bio_id={$userinfo['bio_id']}\" onClick=\"return confirm('Are you sure you want to delete?')\"><button>Delete</button></a></td>";
            // echo "<td></td>";
            echo "</tr>";
        }
        ?>

    </table>


</body>

</html>