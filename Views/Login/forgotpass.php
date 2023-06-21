<?php
// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form inputs
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $email = $_POST['email'];

    // Check if the new password matches the confirm password
    if ($newPassword === $confirmPassword) {
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "fkedusearch");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Update the password in the database
        $sql = "UPDATE users SET password = '$newPassword' WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Password updated successfully
            echo "<script>alert('Password updated successfully!');</script>";
        } else {
            // Failed to update the password
            echo "<script>alert('Password update failed.');</script>";
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // New password and confirm password do not match
        echo "New password and confirm password do not match.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
	
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
		
	<div class="w3-container">
	<div align = "center">
    <h2>Reset Password</h2>
	
	<br>
    <form method="post">
		<div align = "center">
			<label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
		</div>
		<br>
        <div align = "center">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
		<br>
        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
		<br>
        <div>
            <input type="submit" value="Reset Password">
        </div>
		
    </form>
	
	<br>
	
		<a href="login.php">
			<span></span>
			<span></span>
			<span></span>
            <span></span>
            <button type="back">BACK</button>

</body>
</html>

