<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present
    if (isset($_POST['answer_id']) && isset($_POST['type']) && isset($_POST['description'])) {
        $answer_id = $_POST['answer_id'];
        $type = $_POST['type'];
        $description = $_POST['description'];

        // Connect to the database
        $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
        mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

        // Sanitize the input data
        $answer_id = mysqli_real_escape_string($mysql, $answer_id);
        $complaint_type = mysqli_real_escape_string($mysql, $type);
        $description = mysqli_real_escape_string($mysql, $description);

        // Insert the new complaint into the database with default status as "investigation"
        $query = "INSERT INTO complaints (answer_id, type, description, created_at, status) 
                  VALUES ('$answer_id', '$complaint_type', '$description', NOW(), 'investigation')";
        mysqli_query($mysql, $query);

        // Close the database connection
        mysqli_close($mysql);
    }
}

// Redirect back to complaint-list-view.php or any other desired page
header("Location: complaint-list-view.php");
exit();
