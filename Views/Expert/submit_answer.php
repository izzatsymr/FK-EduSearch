<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required fields are present
    if (isset($_POST['type']) && isset($_POST['title']) && isset($_POST['question_description']) && isset($_POST['answer_description']) && isset($_POST['expert']) && isset($_POST['question_id'])) {
        $type = $_POST['type'];
        $title = $_POST['title'];
        $questionDescription = $_POST['question_description'];
        $answerDescription = $_POST['answer_description'];
        $expert = $_POST['expert'];
        $questionId = $_POST['question_id'];

        // Assuming you have a database connection established
        $mysql = mysqli_connect("localhost", "root", "", "fkedusearch") or die(mysqli_connect_error());

        // Insert the answer into the database
        $query = "INSERT INTO answers (question_id, description) VALUES ($questionId, '$answerDescription')";
        $result = mysqli_query($mysql, $query);

        if ($result) {
            // Answer stored successfully

            // Update the status of the corresponding question to "accepted"
            $updateQuery = "UPDATE questions SET status = 'accepted' WHERE id = $questionId";
            $updateResult = mysqli_query($mysql, $updateQuery);

            if ($updateResult) {
                mysqli_close($mysql);
                header("Location: status.php");
                exit;
            } else {
                // Failed to update question status
                echo "Failed to update question status. Please try again.";
            }
        } else {
            // Failed to store answer
            echo "Failed to submit answer. Please try again.";
        }

        // Close the database connection
        mysqli_close($mysql);
    } else {
        echo "Missing required fields.";
    }
} else {
    echo "Invalid request.";
}
?>
