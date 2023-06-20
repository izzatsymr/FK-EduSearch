<?php
// Connect to the database
$mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $academicStatus = $_POST['academicStatus'];
    $roleId = 1; // Replace with the appropriate role ID value from the roles table

    // Prepare the query to check if the account already exists
    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($mysql, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Account already exists, perform an update
        $query = "UPDATE users SET first_name = '$firstName', last_name = '$lastName', password = '$password', academic_status = '$academicStatus' WHERE email = '$email'";
        $action = 'updated';
    } else {
        // Account doesn't exist, perform an insert
        $query = "INSERT INTO users (first_name, last_name, email, password, academic_status, role_id, created_at) VALUES ('$firstName', '$lastName', '$email', '$password', '$academicStatus', $roleId, NOW())";
        $action = 'created';
    }

    // Execute the query
    if (mysqli_query($mysql, $query)) {
        echo '<div class="container">';
        echo '<h1>Account ' . $action . ' Successfully</h1>';
        echo '<p>The account has been ' . $action . ' and stored in the database.</p>';
        echo '<a href="manage-account.php" class="btn btn-primary">Back to Manage Accounts</a>';
        echo '</div>';
    } else {
        echo '<div class="container">';
        echo '<h1>Error</h1>';
        echo '<p>An error occurred while ' . $action . ' the account. Please try again.</p>';
        echo '<a href="manage-account.php" class="btn btn-primary">Back to Manage Accounts</a>';
        echo '</div>';
    }
}

// Close the database connection
mysqli_close($mysql);
?>
