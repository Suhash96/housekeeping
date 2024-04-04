
<?php
require_once('process/dbh.php'); // Include your database connection file.

if (isset($_GET['bio_id'])) {
    $id = $_GET['bio_id'];

    // Fetch the user information based on the provided ID using a prepared statement
    $sql = "SELECT * FROM userinfo WHERE bio_id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }

    $userinfo = mysqli_fetch_assoc($result);

    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        // Retrieve and sanitize the updated data from the form
        $updatedFirstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $updatedLastName = mysqli_real_escape_string($conn, $_POST['lastName']);
        $updatedEmail = mysqli_real_escape_string($conn, $_POST['email']);
        $updatedContact = mysqli_real_escape_string($conn, $_POST['contact']);
        $updatedDesignation = mysqli_real_escape_string($conn, $_POST['Designation']);
        $updatedQualification = mysqli_real_escape_string($conn, $_POST['qualification']);

        // Update the user information in the database using a prepared statement
        $updateSql = "UPDATE userinfo SET firstName=?, lastName=?, email=?, contact=?, Designation=?, qualification=? WHERE bio_id=?";
        
        $stmt = mysqli_prepare($conn, $updateSql);
        mysqli_stmt_bind_param($stmt, "ssssssi", $updatedFirstName, $updatedLastName, $updatedEmail, $updatedContact, $updatedDesignation, $updatedQualification, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: aloginwel.php"); // Redirect to the desired page after successful update
            exit();
        } else {
            die("Error updating record: " . mysqli_error($conn));
        }
    }
} else {
    die("Invalid ID");
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
            background: #13287e !important;
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
    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    
                        <form method="POST">
                            <h2>EDIT USER INFORMATION</h2>
            <div class="row">
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" value="<?php echo $userinfo['firstName']; ?>" required><br>
            </div>
            <div class="row">
            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" value="<?php echo $userinfo['lastName']; ?>" required><br>
            </div>
            <div class="row">
            <label for="email">Email Id:</label>
            <input type="email" name="email" value="<?php echo $userinfo['email']; ?>" required><br>
            </div>
            <div class="row">
            <label for="contact">Contact no:</label>
            <input type="text" name="contact" value="<?php echo $userinfo['contact']; ?>" required><br>
            </div>
            <div class="row">
            <label for="Designation">Designation:</label>
            <input type="text" name="Designation" value="<?php echo $userinfo['Designation']; ?>" required><br>
            </div>
            <div class="row">
                
            <label for="qualification">Qualification:</label>
            <input type="text" name="qualification" value="<?php echo $userinfo['qualification']; ?>" required><br>
            </div>
            <!-- <div></div> -->
        <button type="submit" name="submit">UPDATE</button>
            
            
        


            <!-- <input type="submit" name="submit" value="Update"> -->
        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>

<!-- HTML form to edit user information -->
<html>
<head>

    <style>
        header{
        background-color:#005690;
    
    }
    .divider {
    background-color: #8BCA02;
    height: 5px;
}
input{
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 18px;
    width: 273px;
    border: 0px;
}

body{
    text-align:center;
    /* padding-top:8%; */
}
form{
    box-shadow: 0px 0px 0px 11px #d5d3d3;
    /* background: #13287e; */
    padding: 30px;
    color: #000000;
    width: 37%;
    /* border-radius: 26px; */
    margin-left: 30%;
    border: 1px solid black;
    border-radius: 10px

}
.row{
    /* margin-left:35px; */
    display: flex;
    justify-content: space-around;
    align-items: baseline;
}

button{
    padding: 10px;
    width: 200px;
    border-radius: 10px;
    margin-top: 10px;
}
label{
    width:35%;
}
.card-body{
padding-top: 5%;
}
        </style>
</head>
</body>
</html>
