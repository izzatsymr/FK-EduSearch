<?php
// Connect to the database
$mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the question ID and updated values from the form
    $question_id = $_POST['question_id'];
    $expert_id = $_POST['expert_id'];
    $remaining_time = $_POST['remaining_time'];

    // Update the question in the database
    $query = "UPDATE questions SET expert_id = '$expert_id', remaining_time = '$remaining_time' WHERE id = '$question_id'";
    mysqli_query($mysql, $query);

    // Redirect back to the question list page
    header("Location: question-list.php");
    exit();
} else {
    // Check if the question ID is provided in the URL
    if (isset($_GET['id'])) {
        $question_id = $_GET['id'];

        // Fetch the question from the database
        $query = "SELECT * FROM questions WHERE id = '$question_id'";
        $result = mysqli_query($mysql, $query);
        $question = mysqli_fetch_assoc($result);
    } else {
        // If no question ID is provided, redirect back to the question list page
        header("Location: discussion-list-view.php");
        exit();
    }
}

// Close the database connection
mysqli_close($mysql);
?>

<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>

<div class="container">
  <h1>Edit Question</h1>
  <form action="" method="POST">
    <div class="mb-3">
      <label for="question_id" class="form-label">Question ID</label>
      <input type="text" class="form-control" id="question_id" name="question_id" value="<?php echo $question['id']; ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="user_id" class="form-label">User ID</label>
      <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $question['user_id']; ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="type" class="form-label">Type</label>
      <input type="text" class="form-control" id="type" name="type" value="<?php echo $question['type']; ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="<?php echo $question['title']; ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control" id="description" name="description" readonly><?php echo $question['description']; ?></textarea>
    </div>
    <div class="mb-3">
      <label for="expert_id" class="form-label">Expert ID</label>
      <input type="text" class="form-control" id="expert_id" name="expert_id" value="<?php echo $question['expert_id']; ?>">
    </div>
    <div class="mb-3">
      <label for="remaining_time" class="form-label">Remaining Time</label>
      <input type="text" class="form-control" id="remaining_time" name="remaining_time" value="<?php echo $question['remaining_time']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>

</body>
</html>
