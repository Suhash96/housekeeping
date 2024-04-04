<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <title>Make a Website Using HTML/CSS</title>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      /* overflow: hidden; */
      background: url('../images/wp4658232.webp') no-repeat;
      font-family: 'Poppins';
      line-height: 1.7em;

    }

    a {
      text-decoration: none;
      color: #fff;
    }

    .container {
      max-width: 1100px;
      margin: auto;
    }

    .lead {
      font-size: 16px;
      padding: 10px 10px;
      text-align: justify;
    }

    .btn {
      display: inline-block;
      padding: 07px 16px;
      background: rgb(38, 94, 222);
      ;
      border: none;
      cursor: pointer;
      font-size: 16px;
      border-radius: 03px;
      color: #fff;
      transition: all 0.3;
    }

    .clr {
      clear: both;
    }

    /* Close Utality Classes */

    #navbar {
      background-color: #13287e;
      overflow: hidden;
    }

    #navbar h1 {
      margin-left: -70px;
      margin-bottom: 10px;
      float: left;
      padding-top: 20px;
      color: white;
    }

    #navbar ul {
      list-style: none;
      float: right;
    }

    #navbar ul li {
      float: left;
    }

    #navbar ul li a {
      margin-top:24px;
      display: block;
      padding: 8px;
      text-align: center;
      transition: all 0.5s;
    }

    #navbar ul li a:hover,
    #navbar ul li a.current {
      background-color: #13287e;
      transition: all 0.5s;
    }

    /* Showcase Area */
    #showcase {
      background: url('../images/wp4658232.webp') no-repeat center center/cover;
      height: 600px;
      color: #fff;
    }

    .showcase-content {
      padding-top: 170px;
      color: white;
    }

    .showcase-content h2 {
      font-size: 60px;
      line-height: 1.9em;
    }

    .showcase-content p {
      font-size: 20px;
      margin-bottom: 20px;
    }

    .showcase-content .btn:hover {
      background: #4397EA;
      border: none;
      color: #fff;
      transition: all 0.3s;
    }

    /* body {
      background-image: url("wp4658232.webp");
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
    } */

    img {
      width: 52px;
      float: left;
      margin-left: 75px;
      margin-top: 17px;
    }
  </style>
</head>

<body>
  <header>
    <!-- Navbar -->
    <nav id="navbar">
      <span><img src="logo.png" alt=""></span>
      <div class="container">
        <h1 class="container">Housekeeping <br> Management</h1>

        <ul>
          <li><a class="homered" href="adminhomepage.html">HOME</a></li>
          <li><a class="homered" href="aloginwel.php">ALL DETAILS</a></li>
          <li><a class="homeblack" href="addemp.php">ADD EMPLOYEE</a></li>
          <li><a class="homeblack" href="building.php">MANAGE BUILDING</a></li>
          <li><a class="homeblack" href="index.html">LOG OUT</a></li>
        </ul>
      </div>
    </nav>
    <!-- Showcase Area -->
    
  </header>


</body>

</html>