<?php
// Connect to the database
$mysql = mysqli_connect("localhost", "root", "", "fkedusearch") or die(mysqli_connect_error());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the question_id parameter is set
    if (isset($_POST['question_id'])) {
        $questionId = $_POST['question_id'];

        // Delete the question from the database
        $query = "DELETE FROM questions WHERE id = '$questionId'";
        $result = mysqli_query($mysql, $query);

        if ($result) {
            // Deletion successful
            echo "Question deleted successfully.";
        } else {
            // Deletion failed
            echo "Error deleting the question: " . mysqli_error($mysql);
        }
    } else {
        // Invalid request
        echo "Invalid request. Please provide a valid question ID.";
    }
}

// Close the database connection
mysqli_close($mysql);
?>
