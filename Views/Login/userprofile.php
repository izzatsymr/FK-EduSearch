<!DOCTYPE html>
<html>

<head>
	<style>
		table,
		td,
		th {
			border: 1px solid;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}
	</style>


</head>

<body>
	<?php
	include '..\..\Assets\navbar.html';
	?>

	<h3>Profile Information</h3>
	<table>
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Address</th>
				<th>User Type</th>
				<th>Action</th>
			</tr>
		</thead>

		<script>
			function deleteUser(email) {
				if (confirm("Are you sure you want to delete this user?")) {
					// Send an AJAX request to delete the user
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							// Display the response message
							alert(this.responseText);
							// Refresh the page to update the table
							window.location.reload();
						}
					};
					xhttp.open("GET", "deleteuser.php?email=" + email, true);
					xhttp.send();
				}
			}
		</script>


		<tbody>
			<?php
			// Fetch user data from the database
			$host = "localhost";
			$first_name = "first_name";
			$last_name = "last_name";
			$email = "email";
			$address = "address";
			$role_id = "role_id";
			$database = "fkedusearch";

			// Create a connection
			$conn = mysqli_connect("localhost", "root", "", "fkedusearch");

			// Check the connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			// Prepare and execute the query to fetch user data
			$sql = "SELECT * FROM users";
			$result = mysqli_query($conn, $sql);

			// Generate the table rows dynamically
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$first_name = $row["first_name"];
					$last_name = $row["last_name"];
					$email = $row["email"];
					$address = $row["address"];
					$role_id = $row["role_id"];

					echo "<tr>";
					echo "<td>$first_name</td>";
					echo "<td>$last_name</td>";
					echo "<td>$email</td>";
					echo "<td>$address</td>";
					echo "<td>$role_id</td>";
					//echo "<td><a href='deleteuser.php?id=$role_id'>Delete</a></td>"; 
					//echo "<td><button onclick='deleteUser($role_id)'>Delete</button></td>";
					echo "<td><button onclick='deleteUser(\"$email\")'>Delete</button></td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan='2'>No users found</td></tr>";
			}

			// Close the database connection
			mysqli_close($conn);
			?>
		</tbody>
	</table>

	<br>
	<br>

	<input type="submit" value="Update Profile" onclick="location.href='editprofile.php';">
	<input type="button" value="Back" onclick="location.href='profile.php';">
	</form>

	<br><br>
	<hr>

	<footer class="footer pt-5 pb-5" id="footer">
		<div class="container">
			<span class="text-muted float-left">
				<p id="copyright">&copy; 2023 Section 01A GP6</p>
			</span>

			<span class="float-right">
				<p id="footerInfo"> Izzat | Thaqi | Aziz | Yushag | Shafia</p>
			</span>
		</div>
	</footer>

</body>

</html>