<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>

    <?php

    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (!empty($_POST['first_name'])) {
            if (!empty($_POST['lastname'])) {
                // if (!empty($_POST['address'])) {
                    if (!empty($_POST['email'])) {
                        if (!empty($_POST['password'])) {

                            // 1. Connect to MySQL server
                            $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

                            // 2. Select the database named "fkedusearch"
                            mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

                            // 3. Write SQL statement that inserts the record into table named "users"
                            $first_name = $_POST['first_name'];
							$last_name = $_POST['last_name'];
							// $address = $_POST['address'];
                            $email = $_POST['email'];
                            $pass = $_POST['password'];
                            $academic_status = $_POST['academic_status'];
                            
							
                            $query = "INSERT INTO users VALUES ('', '1', '$first_name', '$last_name', '$email', NOW(), '$pass', '$academic_status', NULL, NULL, NOW(), NOW(),NULL";

                            // To run SQL query in database
                            $result = mysqli_query($mysql, $query);

                            // Check whether the insert was successful or not
                            if ($result) {
                                echo ('Your are registered');
                            } else {
                                die("Insert failed");
                            }
                        } else {
                            $error = "Please input password!";
                        }
                    } else {
                        $error = "Please input email!";
                    }
                // } else
                //     $error = "Please input address!";
            } else
                $error = "Please input last name!";
        } else
            $error = "Please input first name!";
    }

    ?>

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
			
			<!-- <div class="user-box">
                <input type="text" name="address" required="">
                <label>Address</label>
            </div> -->

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
			
			<br>
			
            <a href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <button type="submit">REGISTER</button>
            </a>

        </form>
		<br>
        <a href="login.php" class="float-left text-primary">Already a Member? Login</a>

    </div>

</body>

</html>