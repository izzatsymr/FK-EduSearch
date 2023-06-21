<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Assuming you have a database connection established
  $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
  mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

  $questionId = $_POST['question_id'];
  $answerDescription = $_POST['answer_description'];

  // Save the answer in the database
  $insertQuery = "INSERT INTO answers (question_id, description) VALUES ('$questionId', '$answerDescription')";
  $insertResult = mysqli_query($mysql, $insertQuery);

  if ($insertResult) {
    // Redirect to status.php
    header("Location: status.php");
    exit();
  } else {
    echo "Error: " . mysqli_error($mysql);
  }

  // Close the database connection
  mysqli_close($mysql);
} else {
  echo "Invalid request";
}
?>
