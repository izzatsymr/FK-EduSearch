<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');

        body {
            background-color: white;
            font-family: 'Inter', sans-serif;
        }

        h1.header {
            text-align: center;
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

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

    </style>
</head>
<body>
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

    $sql = "SELECT COUNT(*) AS total_complaints FROM complaints";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalComplaints = $row['total_complaints'];


    // Close the database connection
    $conn->close();
?>

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

<h1 class="header">Dashboards</h1>

<div class="dropdown">
    <button class="dropbtn">Choose Graph</button>
    <div class="dropdown-content">
        <a href="ReportPage.php">Data Graph</a>
        <a href="StatusGraphPage.php">Status Graph</a>
        <a href="UserGraphPage.php">User Graph</a>
        <a href="ComplaintGraphPage.php">Complaint Graph</a>
    </div>
</div>

<canvas id="myChart"></canvas>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');

    // Define the data
    var data = {
        labels: ['Total Complaints'],
        datasets: [{
            label: 'Total Count',
            data: [<?php echo $totalComplaints; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)', // Red
            ],
                
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }]
    };

    // Create the bar chart
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
