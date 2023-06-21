<?php
// Connect to the database
$mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

// Fetch all questions from the database
$query = "SELECT * FROM answers";
$result = mysqli_query($mysql, $query);

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
  <h1>Answer List</h1>
  <table class="table">
    <thead>
      <tr>
        <th>Answer ID</th>
        <th>Question ID</th>
        <th>Description</th>
        <th>Status</th>
        <th>Created_At</th>
        <th>Updated_At</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Loop through the result and display each question
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['id'] . "</td>";
          echo "<td>" . $row['question_id'] . "</td>";
          echo "<td>" . $row['description'] . "</td>";
          echo "<td>" . $row['status'] . "</td>";
          echo "<td>" . $row['created_at'] . "</td>";
          echo "<td>" . $row['updated_at'] . "</td>";
          echo "<td>";
         // if ($row['expert_id'] === null) {
           //   echo "<a href='discussion-edit-view.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>";
          }
          echo "</td>";
          echo "</tr>";
      //}
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
