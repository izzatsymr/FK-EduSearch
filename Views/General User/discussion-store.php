<?php
// Connect to the database
$mysql = mysqli_connect("localhost", "root", "", "fkedusearch") or die(mysqli_connect_error());

// Retrieve form data
$userID = $_POST['user_id'];
$type = $_POST['type'];
$title = $_POST['title'];
$description = $_POST['description'];

// Prepare the SQL statement
$query = "INSERT INTO questions (user_id, type, title, description) VALUES ('$userID', '$type', '$title', '$description')";

// Execute the SQL statement
if (mysqli_query($mysql, $query)) {
    // Display success message
    echo "The information has been entered successfully.";

    // Close the database connection
    mysqli_close($mysql);
} else {
    // Display an error message if the query execution fails
    echo "Error: " . mysqli_error($mysql);
}
?>

