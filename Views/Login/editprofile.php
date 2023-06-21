<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="../../Styles (css)/style.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
        integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <link href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/images/favicon.ico" rel="shortcut icon"
        type="image/x-icon">
		
	<?php
		// Check if the form is submitted
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Retrieve the updated user data from the form
			$first_name = $_POST["first_name"];
			$last_name = $_POST["last_name"];
			$address = $_POST["address"];
			$email = $_POST["email"];

			// Create a connection
			$conn = mysqli_connect("localhost", "root", "", "fkedusearch");
			
			// Prepare and execute the query to fetch user data
			$sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', address='$address' WHERE email='$email'";
			if (mysqli_query($conn, $sql)) {
				echo "<script>alert('User data update successfully');</script>";
			} else {
				echo "<script>alert('Error updating user data');</script>" . mysqli_error($conn);
			}


			// Check the connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			// Close the database connection
			mysqli_close($conn);
		}
	?>	

</head>

<body>

    <div class="top-header bg-primary">
        <div class="container">
            <div class="row">

                <div class="col-md-5 mt-2 ">
                    <h6>Welcome to FKEDUSEARCH</h6>
                </div>

            </div>
        </div>
    </div>
	
	    <div class="container mt-4" id="top-logo">
        <div class="row">
            <div class="col-md-2" style="right: 5%;">
                <nav class="navbar navbar-light">
                    <a class="navbar-brand" href="#">
                        <img src="image/umplogo.png" width=auto height="70">
                    </a>
                </nav>
            </div>
			<h2>Edit User Profile</h2>

        </div>
    </div>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

	
	<br>
	
	    <div class="container">
        <br>
        <div class="row rounded">
            <div class="col-9 mt-3">
                <div class="tab-content bg-light pb-5" id="v-pills-tabContent">
                    <div class="tab-pane fade show active p-3" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab">
						<img id="profilePic"
                            src="https://icon-library.com/images/default-user-icon/default-user-icon-8.jpg"
                            class="rounded-circle img-fluid" >

                        <br>
                        <br>
                        <hr>
                        <br>

                        <form>

                            <div class="row pb-5">

                                <div class="col">
                                    <p class="font-weight-bold d-inline-block">First Name</p>
                                    <input type="text" class="form-control" name="first_name">
                                </div>

                                <div class="col">
                                    <p class="font-weight-bold d-inline-block">Last Name</p>
                                    <input type="text" class="form-control" name="last_name">
                                </div>

                            </div>

                            <div class="row">

                                <div class="col">
                                    <p class="font-weight-bold d-inline-block">Email Address</p>
                                    <p class="text-muted d-inline-block float-right">For notifications and logging in
                                    </p>
                                    <input type="email" class="form-control" name="email" placeholder="email@example.com">
                                </div>

                                <div class="col">

                                    <p class="font-weight-bold d-inline-block">Address</p>
                                    <input type="text" class="form-control" name="address">
                                    </div>

                                </div>

                            </div>

                        </form> 

                        <hr>

						<button type="submit" class="btn btn-outline-primary float-right mt-3 mb-5" data-toggle="modal"
                        data-target=".bd-example-modal-md" onclick="location.href='userprofile.php'">Update</button>
						<button type="button" class="btn btn-outline-primary float-center mt-3 mb-5" data-toggle="modal"
                        data-target=".bd-example-modal-md" onclick="location.href='profile.php'">Back</button>

                        <br>
                    </div>
                    <!-- <div class="tab-pane fade p-3" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
            
          </div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edited Successfully</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Details were edited successfully.</p>
                </div>
            </div>
        </div>
    </div>
	
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

