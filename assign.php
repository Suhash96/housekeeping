<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Title Page-->
    <title>Assign Job | Admin Panel | housekeeping Management </title>
    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">
    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="styleemplogin.css">

    <style>
        body {
            overflow: hidden;
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

        nav ul {
            display: inline;
            padding: 11px;
            float: right;
        }

        .btn--green {
            background: #13287e;
        }

        .btn--green:hover {
            background: #13287e;
        }

        .card-1 .card-body {
            padding: 60px 76px;
            padding-top: 27px;
            padding-bottom: 38px;
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
    </style>
</head>

<body>
    <header>
        <nav>
        <img src="logo.png" alt="Description of the image">
            <h1 class="container">Housekeeping <br> Management</h1>
            <ul id="navli">
                <li><a class="homeblack" href="assign.php">HOME</a></li>
                <li><a class="homeblack" href="managerwel.php">JOB STATUS</a></li>
                <li><a class="homeblack" href="index.html">LOGOUT</a></li>
                <li><a class="homeblack" href="login.html">ID:
                        <?php echo $_SESSION['bio_id']; ?>
                    </a></li>
            </ul>
        </nav>

    </header>
    <div class="divider"></div>

    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Assign Job</h2>
                    <form action="process/assignp.php" method="POST" enctype="multipart/form-data">
                        <div class="input-group">
                            Form
                            <input class="input--style-1" type="date" placeholder="from" name="from"
                                required="required">
                        </div>
                        To
                        <div class="input-group">
                            <input class="input--style-1" type="date" placeholder="to" name="to" required="required">
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder=" floor no" name="floor_no"
                                required="required">
                        </div>

                        <!-- PHP code to fetch supervisors from the userinfo table -->
                        <?php
                        require_once ('process/dbh.php'); // Include your database connection file.
                        
                        // Assuming "Designation" is the field in the "userinfo" table that holds the designation.
                        $sql = "SELECT bio_id, firstName FROM userinfo WHERE Designation = 'supervisor'";
                        $result = mysqli_query($conn, $sql);

                        // Check if the query was successful
                        if (!$result) {
                            die("Error: " . mysqli_error($conn));
                        }
                        ?>

                        <!-- HTML code for the form with the dynamic dropdown -->
                        <div class="input-group">
                            <label for="supervisor">Select Supervisor:</label>
                            <select class="input--style-1" id="supervisor" name="supervisor" required="required"
                                style="width: 184px;">
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['bio_id'] . "'>" . $row['firstName'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>
    <!-- Main JS-->
    <script src="js/global.js"></script>
</body>

</html>
<!-- end document-->