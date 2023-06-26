<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <style>
    .card {
        margin-bottom: 20px;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Trigger the search on input change
      $('#search-input').on('input', function() {
        var searchKeyword = $(this).val();

        // Send an AJAX request to fetch matching questions
        $.ajax({
          url: 'fetch-questions.php',
          method: 'GET',
          data: { search: searchKeyword },
          success: function(data) {
            // Update the question list with the fetched data
            $('#question-list').html(data);
          }
        });
      });

      // Delete button click event handler
      $(document).on('click', '.delete-btn', function() {
        // Display confirmation message
        if (confirm('Are you sure you want to delete this question?')) {
          var questionId = $(this).data('question-id');

          // Send an AJAX request to delete the question
          $.ajax({
            url: 'delete-question.php',
            method: 'POST',
            data: { question_id: questionId },
            success: function(response) {
              // Refresh the question list
              $('#search-input').trigger('input');
            }
          });
        }
      });
    });
  </script>
</head>
<body>

<div class="container">
    <h1>Question List</h1>

    <!-- Search form -->
    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Search keywords" id="search-input">
    </div>

    <!-- Add Discussion button -->
    <a href="discussion-create.php" class="btn btn-primary mb-3">Add Discussion</a>

    <!-- Question list container -->
    <div id="question-list">
      <?php
      // Connect to the database
      $mysql = mysqli_connect("localhost", "root", "", "fkedusearch") or die(mysqli_connect_error());

      if ($_SERVER['REQUEST_METHOD'] === 'GET') {
          if (isset($_GET['search'])) {
              $searchKeyword = $_GET['search'];
              // Construct the query to search for matching questions
              $query = "SELECT * FROM questions WHERE title LIKE '%$searchKeyword%' OR description LIKE '%$searchKeyword%'";
          } else {
              // Fetch all questions from the database
              $query = "SELECT * FROM questions";
          }

          // Execute the query
          $result = mysqli_query($mysql, $query);

          // Loop through the result and display each question as a card
          while ($row = mysqli_fetch_assoc($result)) {
              echo '<div class="card">';
              echo '<div class="card-body">';
              echo '<h5 class="card-title">Question ID: ' . $row['id'] . '</h5>';
              echo '<h6 class="card-subtitle mb-2 text-muted">Type: ' . $row['type'] . '</h6>';
              echo '<h6 class="card-subtitle mb-2 text-muted">Title: ' . $row['title'] . '</h6>';
              echo '<p class="card-text">Description: ' . $row['description'] . '</p>';
              echo '<p class="card-text">Status: ' . $row['status'] . '</p>';
              echo '<form method="POST" action="">';
              echo '<input type="hidden" name="question_id" value="' . $row['id'] . '">';
              echo '<button type="submit" name="like" class="btn btn-primary">Like (' . $row['like'] . ')</button>';
              echo '<button type="submit" name="answer" class="btn btn-success">Answer</button>';
              echo '<button type="button" class="btn btn-danger delete-btn" data-question-id="' . $row['id'] . '">Delete</button>';
              echo '</form>';
              echo '</div>';
              echo '</div>';
          }

          // Close the database connection
          mysqli_close($mysql);
      }
      ?>
    </div>
</div>

</body>
</html>
