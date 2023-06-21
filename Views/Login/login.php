<?php
// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form inputs
  $email = $_POST['email'];
  $password = $_POST['password'];
  $userType = $_POST['userType'];

  // Validate the inputs (you can add more validation as per your requirements)

  // Connect to the database
  $conn = mysqli_connect("localhost", "root", "", "fkedusearch");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare the SQL statement
  $sql = "SELECT * FROM users WHERE username = '$email' AND password = '$password' AND role_id = '$userType'";
  
  // Execute the query
  $result = mysqli_query($conn, $sql);

  // Check if a matching record is found
  if (mysqli_num_rows($result) == 1) {
    // Authentication successful
    $row = mysqli_fetch_assoc($result);

    // Set session variables or perform any other actions as needed
    $_SESSION['email'] = $row['email'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['user_type'] = $row['role_id'];

    // Redirect to the appropriate dashboard based on role ID
    switch ($userType) {
      case 1: // Admin
        header("Location: profile.php");
        break;
      case 2: // Expert
        header("Location: expert_dashboard.php");
        break;
      case 3: // General User
        header("Location: user_dashboard.php");
        break;
      default:
        echo "Invalid role ID.";
        break;
    }
  } else {
    // Authentication failed
    echo "Invalid username or password.";
  }

  // Close the database connection
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
	
	<style>
		body {
			background-image: url("image/chancellory.webp");
			background-size:cover;
			display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
		}
		
		.w3-container{
			max-width: 350px;
			margin: auto;
			background: white;
			opacity: 0.9;
			padding: 20px;
			
		}

	</style>
	
</head>

<body>
    <?php

    // To display error message if username and password are invalid
    if (isset($_SESSION['ERRMSG_ARR'])) {

        echo "<hl style='color:red'>Error found: ";

        for ($loop = 0; $loop < count($_SESSION['ERRMSG_ARR']); $loop++) {
            echo $_SESSION['ERRMSG_ARR'][$loop] . "! ";
        }

        echo "</hl>";
        unset($_SESSION['ERRMSG_ARR']);
    }

    ?>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="w3-container">
    <div class="login-box" align="center">

        <h2>Login</h2>

        <form method="post" action="session.php" style="font-size: l0pt">

            <div class="user-box">
				<label>Email</label>
                <input type="text" name="email" required="">
            </div>
			
			<br>

            <div class="user-box">
			    <label>Password</label>
                <input type="password" name="password" required="">
            </div>
			
			<br>
			
			<div>
      <label for="userType">User Type:</label>
      <select id="userType" name="userType">
        <option value="1">Admin</option>
        <option value="2">Expert</option>
        <option value="3">General User</option>
      </select>
    </div>
			
			<br>

            <a href="profile.php">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <button type="submit">LOGIN</button>
            </a>
			

        </form>
		<br>
        <a href="forgotpass.php" class="float-left text-primary">Forgot Password?</a>

    </div>
</div>
</body>

</html>