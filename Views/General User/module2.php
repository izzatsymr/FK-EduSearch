<!DOCTYPE html>
<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');

        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }

        ul.navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
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
            color: #333;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        ul.navbar li a:hover {
            background-color: #333;
            color: #fff;
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
            width: 300px;
            margin: 10px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        th {
            padding: 10px;
            background-color: #f9f9f9;
            font-weight: bold;
            text-align: left;
        }

        td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <ul class="navbar">
        <li><a href="Discussion.php">Discussion</a></li>
        <li><a href="GeneralUser.php">General User</a></li>
        <li><a href="Experts.php">Experts</a></li>
        <li><a href="Reports.php">Reports</a></li>
        <li><a href="Complaints.php">Complaints</a></li>
        <li><a href="manage-account.php">Manage Account</a></li>
        <li class="navbar-right">
            <img src="https://static.vecteezy.com/system/resources/thumbnails/009/734/564/small/default-avatar-profile-icon-of-social-media-user-vector.jpg" alt="Profile Picture" class="profile-pic">
            <img src="https://png.pngtree.com/png-vector/20190725/ourmid/pngtree-vector-notification-icon-png-image_1577363.jpg" alt="Notification Logo" class="notification-logo">
        </li>
    </ul>

</body>
</html>
