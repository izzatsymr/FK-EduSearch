<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FK-EDUSEARCH</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <style>
    .remaining-time {
      min-width: 100px;
    }
  </style>
</head>

<body>
  <?php
  include '..\..\Assets\navbar.html';
  ?>

  <div class="container">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Type</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Remaining Time</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Assuming you have a database connection established
          $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
          mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

          // Handle the actions when the accept or delete buttons are clicked
          if (isset($_GET['id']) && isset($_GET['action'])) {
            $statusId = $_GET['id'];
            $action = $_GET['action'];

            // Perform the necessary update or delete in the database based on the action
            if ($action === 'accept') {
              // Update the status as "Accepted"
              $updateQuery = "UPDATE questions SET status = 'accepted' WHERE id = $statusId";
              mysqli_query($mysql, $updateQuery);
            } elseif ($action === 'delete') {
              // Delete the row from the table
              $deleteQuery = "DELETE FROM questions WHERE id = $statusId";
              mysqli_query($mysql, $deleteQuery);
            }

            // Redirect back to the same page after the update or delete
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
          }

          // Retrieve the data from the database
          $query = "SELECT q.type, q.title, q.description, q.status, TIME_TO_SEC(q.remaining_time) AS remaining_seconds, q.id
                    FROM questions q, experts e
                    WHERE q.expert_id = e.id";

          $result = mysqli_query($mysql, $query);

          if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
              $type = $row["type"];
              $title = $row["title"];
              $description = $row["description"];
              $status = $row["status"];
              $remainingSeconds = $row["remaining_seconds"];
              $id = $row["id"];
          ?>
              <tr>
                <td><?php echo $type; ?></td>
                <td><?php echo $title; ?></td>
                <td><?php echo $description; ?></td>
                <td><?php echo $status; ?></td>
                <td>
                  <div class="remaining-time" data-remaining="<?php echo $remainingSeconds; ?>"></div>
                </td>
                <td>
                  <div class="d-flex">
                    <?php if ($status !== 'accepted') { ?>
                      <!-- Display the accept button only if the status is not "accepted" -->
                      <a href="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id . '&action=accept'; ?>" class="btn btn-primary me-2">Accept</a>
                    <?php } else { ?>
                      <!-- Display the answer button if the status is "accepted" -->
                      <a href="answers.php?id=<?php echo $id; ?>" class="btn btn-primary me-2">Answer</a>
                    <?php } ?>
                    <a href="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id . '&action=delete'; ?>" class="btn btn-danger">Delete</a>
                  </div>
                </td>
              </tr>
          <?php
            }
          } else {
            echo "0 results";
          }

          mysqli_close($mysql);
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-k1tk05hqFz1rDKxKZtK/2ea1ByxQWVCF9eE/Dr0bTeeMFgZ3eodVKX0W50OztFO9" crossorigin="anonymous"></script>
  <script>
    // Timer logic
    function startTimer(element) {
      var remainingSeconds = parseInt(element.getAttribute('data-remaining'));
      var interval = setInterval(function() {
        var minutes = Math.floor(remainingSeconds / 60);
        var seconds = remainingSeconds % 60;

        element.innerHTML = minutes + "m " + seconds + "s";

        if (remainingSeconds <= 0) {
          clearInterval(interval);
          element.innerHTML = "Expired";
        } else {
          remainingSeconds--;
        }
      }, 1000);
    }

    var remainingTimeElements = document.querySelectorAll('.remaining-time');
    remainingTimeElements.forEach(function(element) {
      startTimer(element);
    });
  </script>
</body>

</html>
