<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Job Table</title>
    <link rel="stylesheet" type="text/css" href="styleemplogin.css">
    <style>
        body {
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
            /* padding: 11px; */
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

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #13287e;
        }

        tr:hover {
            background-color: #90a2ed;
        }

        .hidden-image {
            display: none;
        }

        nav ul li {
            display: inline-block;
            list-style-type: none;
            color: white;
            float: left;
            margin-left: 12px;
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

    <body>
        <h2 style="    margin-left: 129px;">Job Status</h2>
        <table>

            <tr>
                <th align="center">Job ID</th>
                <th align="center">From Date</th>
                <th align="center">To Date</th>
                <th align="center">Floor No</th>
                <th align="center">Supervisor</th>
                <th align="center">Status</th>
                <th align="center">Image</th>
            </tr>

            <?php
            $servername = "localhost";
            $dBUsername = "root";
            $dbPassword = "";
            $dBName = "housekeeping";

            $conn = mysqli_connect($servername, $dBUsername, $dbPassword, $dBName);

            if (!$conn) {
                echo "Database Connection Failed";
            }

            // Query to fetch data from the 'job' table with a CASE statement
            $sql = "SELECT j.job_id, j.from_date, j.to_date, j.floor_no, u.firstName AS supervisor_name,
    CASE 
        WHEN j.status = 'Completed' THEN 'Completed'
        ELSE 'Pending'
    END AS status,
    j.image
    FROM job j
    LEFT JOIN userinfo u ON j.supervisor = u.bio_id";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["job_id"] . "</td>";
                    echo "<td>" . $row["from_date"] . "</td>";
                    echo "<td>" . $row["to_date"] . "</td>";
                    echo "<td>" . $row["floor_no"] . "</td>";
                    echo "<td>" . $row["supervisor_name"] . "</td>"; // Display supervisor's firstName
                    echo "<td>" . $row["status"] . "</td>";

                    // Add a dropdown button for "Completed" status
                    if ($row["status"] === 'Completed') {
                        echo '<td><button class="toggle-image-button" data-image-src="' . $row["image"] . '">Show Image</button></td>';
                    } else {
                        echo '<td></td>'; // Empty cell for non-completed rows
                    }
                    echo "</tr>";
                }
            }

            $conn->close();
            ?>


        </table>
        <script>
            const toggleImageButtons = document.querySelectorAll(".toggle-image-button");

            toggleImageButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const imageSrc = button.getAttribute("data-image-src");

                    // Open a new window or tab with the image
                    window.open(imageSrc, "_blank");
                });
            });
        </script>
    </body>

</html>