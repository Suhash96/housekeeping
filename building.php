<!DOCTYPE html>
<html>

<head>
   

    <!-- Title Page-->
    <title>building|Housekeeping</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
    <style>
        <style>
        header{
        background-color:#005690;
    
    }
   

header h1 {
    margin-left: 90px;
    /* padding-right: 48px; */
    display: inline;
    font-family: Poppins, sans-serif;
    font-weight: bold;
    font-size: 21px;
    float: left;
    margin-top: -11px;
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
    padding: 21px 20px 53px 40px;
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
nav ul {
    display: inline;
    padding: 10px;
    float: right;
}

.btn--green {
    background: #13287e;
}

.btn--green:hover {
    background: #13287e;
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
            <li><a class="homered" href="adminhomepage.html">HOME</a></li>
				<li><a class="homered" href="aloginwel.php">ALL DETAILS</a></li>
				<li><a class="homeblack" href="addemp.php">ADD EMPLOYEE</a></li>
				<li><a class="homeblack" href="building.php">MANAGE BUILDING</a></li>
				<li><a class="homeblack" href="index.html">LOG OUT</a></li>
			</ul>
		</nav>
	</header>
    
    <div class="divider"></div>




    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Building Info</h2>
                    <form action="buildingprocess.php" method="POST">
                         <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                     <input class="input--style-1" type="text" placeholder="building name" name="buildingname" required="required">
                                </div>
                            </div>
                        </div>





                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="building id" name="building_id" required="required">
                        </div>
                       
                        
                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="floor numer" name="floor_no" required="required" >
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="room number" name= "room_no" required="required">
                        </div>
                        <div class="input-group">
    <select class="input--style-1" type="number" placeholder="room type"name="room_type">
        <option value="class room">classroom</option>
        <option value="restroom">restroom</option>
        <option value="staff room">Staffroom</option>
        <option value="lab">lab</option>

        <!-- Add more room types as needed -->
    </select>
</div>

                        
                        







                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Submit</button>
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