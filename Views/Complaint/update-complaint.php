<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present
    if (isset($_POST['id']) && isset($_POST['status'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];

        // Connect to the database
        $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
        mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

        // Update the status in the database
        $query = "UPDATE complaints SET status = '$status' WHERE id = $id";
        mysqli_query($mysql, $query);

        // Close the database connection
        mysqli_close($mysql);
    }
}

// Redirect back to complaint-list-view.php
header("Location: complaint-list-view.php");
exit();
