<?php
// Create a connection
$conn = mysqli_connect("localhost", "root", "", "fkedusearch");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the email parameter is provided in the URL
if (isset($_GET['email'])) {
    // Get the email from the URL
    $email = $_GET['email'];

    // Prepare and execute the query to delete the user
    $sql = "DELETE FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // User deleted successfully
        echo "User deleted successfully!";
    } else {
        // Failed to delete the user
        echo "Failed to delete the user.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
