<?php
// Start session
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
	
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="../../Styles (css)/style.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
        integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <link href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/images/favicon.ico" rel="shortcut icon"
        type="image/x-icon">

	<style>
		body {
			background-image: url("image/FK.jpg");
			background-position: center;
			background-size:cover;
			display: flex;
            justify-content: center;
			align-item: center;
			width: 400vh
            height: 90vh;
		}
		
		.w3-container{
			max-width: 550px;
			margin: auto;
			background: white;
			opacity: 0.9;
			padding: 20px;
			
		}


	</style>
	
	
</head>
<body>
    

    <?php
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['first_name'])) {
            if (!empty($_POST['last_name'])) {
                if (!empty($_POST['address'])) {
                    if (!empty($_POST['email'])) {
                        if (!empty($_POST['password'])) {

                            // 1. Connect to MySQL server
                            $mysql = mysqli_connect("localhost", "root", "", "fkedusearch") or die(mysqli_connect_error());

                            // 2. Write SQL statement that inserts the record into table named "users"
                            $first_name = $_POST['first_name'];
                            $last_name = $_POST['last_name'];
                            $address = $_POST['address'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $academic_status = $_POST['academic_status'];
							$userType = $_POST['userType'];

                            $query = "INSERT INTO users VALUES ('', '$first_name', '$last_name', '$email', '$userType','$password','$academic_status','$address',  NULL, NOW(), NULL, NULL)";

                            // To run SQL query in database
                            $result = mysqli_query($mysql, $query);

                            // Check whether the insert was successful or not
                            if ($result) {
                                echo "<script>alert('You are Registered');</script>";
                            } else {
                                die("Insert failed: " . mysqli_error($mysql));
                            }
                        } else {
                            $error = "Please input a password!";
                        }
                    } else {
                        $error = "Please input an email!";
                    }
                } else {
                    $error = "Please input an address!";
                }
            } else {
                $error = "Please input a last name!";
            }
        } else {
            $error = "Please input a first name!";
        }
    }
    ?>
	
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="w3-container" align = "center">

    <div class="register-box">
        <h2>Register</h2>
        <form method="post" action="register.php">
            <div class="user-box">
                <input type="text" name="first_name" required="">
                <label>First Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="last_name" required="">
                <label>Last Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="address" required="">
                <label>Address</label>
            </div>
            <div class="user-box">
                <input type="email" name="email" required="">
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <div class="user-box">
                <input type="text" name="academic_status" required="">
                <label>Academic Status</label>
            </div>
			<div>
				<label for="userType">User Type:</label>
				<select id="userType" name="userType">
				<option value="1">Admin</option>
				<option value="2">Expert</option>
				<option value="3">General User</option>
				</select>
			</div>
			
            <br>
            <button type="submit">REGISTER</button>
            <br><br>
			
           
            </a>

        </form>
    </div>
	
	
				<a href="profile.php">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <button type="back">BACK</button>
</div>
</body>
</html>
