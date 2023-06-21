<!DOCTYPE html>
<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');

        body {
            background-color: silver;
            font-family: 'Inter', sans-serif;
        }

        h1.header {
            text-align: Center;
    
        }

        ul.navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: white;
        }

        ul.navbar::after {
            content: "";
            display: table;
            clear: both;
        }

        ul.navbar li {
            float: left;
        }

        ul.navbar li a {
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul.navbar li a:hover {
            background-color: #111;
            color: white;
        }

        .navbar-right {
            float: right;
        }

        .profile-pic {
            display: inline-block;
            vertical-align: middle;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .notification-logo {
            display: inline-block;
            vertical-align: middle;
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 10px; /* Adjust as needed */
        }

        table {
            width: 1000px;
            margin: 10px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            font-size: 16px;
        }

        th {
            padding: 10px;
            background-color: #f9f9f9;
            font-weight: bold;
            text-align: left;
            font-size: 20px;
        }

        td {
            padding: 10px;
            text-align: left;
            font-size: 25px;
        }
    </style>
</head>
<body>

<?php
    include '..\..\Assets\navbar.html'; ?>

<ul class="navbar">
    <li><a href="MainPage.php">Home</a></li>
    <li><a href="DataListPage.php">Data</a></li>
    <li><a href="StatusListPage.php">Status</a></li>
    <li><a href="UserListPage.php">User List</a></li>
    <li><a href="ComplaintListPage.php">Complaint</a></li>
    <li><a href="ReportPage.php">Report</a></li>
    <li class="navbar-right">
        <img src="https://static.vecteezy.com/system/resources/thumbnails/009/734/564/small/default-avatar-profile-icon-of-social-media-user-vector.jpg" alt="Profile Picture" class="profile-pic">
        <img src="https://png.pngtree.com/png-vector/20190725/ourmid/pngtree-vector-notification-icon-png-image_1577363.jpg" alt="Notification Logo" class="notification-logo">
    </li>
</ul>

    <h1 class="header 1">Status List:</h>

    <table>
        <tr>
            <th>In Investigation:</th>
            <td>
            <?php
                // Database connection details
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "fkedusearch";

                // Create a connection to the database
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check if the connection was successful
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Prepare and execute the SQL query
                $sql = "SELECT COUNT(*) AS total_InInvestigation
                FROM complaints
                WHERE status = 'investigation'";
                $result = $conn->query($sql);

                // Check if there is a row returned
                if ($result->num_rows > 0) {
                    // Fetch the data
                    $row = $result->fetch_assoc();
                    echo $row["total_InInvestigation"];
                } else {
                    echo "0";
                }

                // Close the database connection
                $conn->close();
                ?>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th>On Hold:</th>
            <td>
            <?php
                // Database connection details
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "fkedusearch";

                // Create a connection to the database
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check if the connection was successful
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Prepare and execute the SQL query
                $sql = "SELECT COUNT(*) AS total_OnHold
                FROM complaints
                WHERE status = 'onhold'";
                $result = $conn->query($sql);

                // Check if there is a row returned
                if ($result->num_rows > 0) {
                    // Fetch the data
                    $row = $result->fetch_assoc();
                    echo $row["total_OnHold"];
                } else {
                    echo "0";
                }

                // Close the database connection
                $conn->close();
                ?>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Resolved:</th>
            <td>
            <?php
                // Database connection details
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "fkedusearch";

                // Create a connection to the database
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check if the connection was successful
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Prepare and execute the SQL query
                $sql = "SELECT COUNT(*) AS total_Resolved
                FROM complaints
                WHERE status = 'resolved'";
                $result = $conn->query($sql);

                // Check if there is a row returned
                if ($result->num_rows > 0) {
                    // Fetch the data
                    $row = $result->fetch_assoc();
                    echo $row["total_Resolved"];
                } else {
                    echo "0";
                }

                // Close the database connection
                $conn->close();
                ?>
            </td>
        </tr>
    </table>
</body>
</html>
