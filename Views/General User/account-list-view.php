<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>

<div class="container">
  <h1>Registered Accounts</h1>

  <?php
  // Connect to the database
  $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
  mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

  // Fetch all accounts from the database
  $query = "SELECT * FROM users";
  $result = mysqli_query($mysql, $query);

  if (mysqli_num_rows($result) > 0) {
      echo '<table class="table">';
      echo '<thead>';
      echo '<tr>';
      echo '<th>First Name</th>';
      echo '<th>Last Name</th>';
      echo '<th>Email</th>';
      echo '<th>Academic Status</th>';
      echo '<th>Created At</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      
      // Loop through the result and display each account
      while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<td>' . $row['first_name'] . '</td>';
          echo '<td>' . $row['last_name'] . '</td>';
          echo '<td>' . $row['email'] . '</td>';
          echo '<td>' . $row['academic_status'] . '</td>';
          echo '<td>' . $row['created_at'] . '</td>';
          echo '</tr>';
      }
      
      echo '</tbody>';
      echo '</table>';
  } else {
      echo '<p>No registered accounts found.</p>';
  }

  // Close the database connection
  mysqli_close($mysql);
  ?>

  <a href="index.html" class="btn btn-secondary">Back to Home</a>
</div>

</body>
</html>
