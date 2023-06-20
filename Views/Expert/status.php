<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">FK-EDUSEARCH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Discussion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">General Users</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Experts
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Expert Profile</a></li>
                            <li><a class="dropdown-item" href="#">Expert Information</a></li>
                          <li><a class="dropdown-item" href="#">Status</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Complaint</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Manage Account</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

  <div class="container">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Type</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
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
          $query = "SELECT q.type, q.title, q.description, q.status, q.id
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
              $id = $row["id"];
              ?>
              <tr>
                <td><?php echo $type; ?></td>
                <td><?php echo $title; ?></td>
                <td><?php echo $description; ?></td>
                <td><?php echo $status; ?></td>
                <td>
                  <div class="d-flex">
                    <?php if ($status !== 'accepted') { ?>
                      <!-- Display the accept button only if the status is not "accepted" -->
                      <a href="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id . '&action=accept'; ?>" class="btn btn-primary me-2">Accept</a>
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
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
