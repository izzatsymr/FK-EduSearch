<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Answer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h2>Create Answer</h2>
    <?php
    if (!isset($_GET['id'])) {
      echo "No question ID provided";
    } else {
      $questionId = $_GET['id'];

      // Assuming you have a database connection established
      $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
      mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

      // Fetch the question details and the corresponding expert's name from the database
      $query = "SELECT q.type, q.title, q.description AS question_description, a.description AS answer_description, CONCAT(u.first_name, ' ', u.last_name) AS expert_name
                FROM questions q
                INNER JOIN experts e ON q.expert_id = e.id
                INNER JOIN users u ON e.user_id = u.id
                LEFT JOIN answers a ON q.id = a.question_id
                WHERE q.id = $questionId";
      $result = mysqli_query($mysql, $query);

      if (mysqli_num_rows($result) > 0) {
        $question = mysqli_fetch_assoc($result);
    ?>
        <form action="submit_answer.php" method="POST">
          <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" name="type" class="form-control" value="<?php echo $question['type']; ?>" readonly>
          </div>

          <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" value="<?php echo $question['title']; ?>" readonly>
          </div>

          <div class="form-group">
            <label for="question_description">Question Description:</label>
            <textarea name="question_description" class="form-control" readonly><?php echo $question['question_description']; ?></textarea>
          </div>

          <div class="form-group">
            <label for="answer_description">Answer Description:</label>
            <textarea name="answer_description" class="form-control" required><?php echo $question['answer_description']; ?></textarea>
          </div>

          <div class="form-group">
            <label for="expert">Expert:</label>
            <input type="text" name="expert" class="form-control" value="<?php echo $question['expert_name']; ?>" readonly>
          </div>

          <input type="hidden" name="question_id" value="<?php echo $questionId; ?>">

          <button type="submit" name="submit" class="btn btn-primary">Create</button>
        </form>
    <?php
      } else {
        echo "Invalid question ID";
      }
    }
    ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-aFNMInViLUNXhtpC54gNfGnDr+AkMucFDtdbFs8+0d/CtqG1X1bXkMeF4pl7Uh/3" crossorigin="anonymous"></script>
</body>

</html>
