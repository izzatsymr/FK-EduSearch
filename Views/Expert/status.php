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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
              <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Experts
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Expert Profile<span class="badge bg-primary rounded-pill">14</span></a></li>
                <li><a class="dropdown-item" href="#">Status<span class="badge bg-primary rounded-pill">14</span></a></li>
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
                  </tr>
              </thead>

              <tbody>
                  <?php
                  // Connect to MySQL server
                  $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

                  // Select the database named "fkedusearch"
                  mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

                  $query = "SELECT q.type, q.title, q.description, q.status
                  FROM questions q, experts e
                  WHERE q.expert_id = e.id";

                  $result = mysqli_query($mysql, $query);

                  if (mysqli_num_rows($result) > 0) {
                      // Output data of each row
                      while ($row = mysqli_fetch_assoc($result)) {
                          $type = $row["title"];
                          $title = $row["title"];
                          $description = $row["description"];
                          $status = $row["status"];
                  ?>
                          <tr>
                              <td><?php echo $type; ?></td>
                              <td><?php echo $title; ?></td>
                              <td><?php echo $description; ?></td>
                              <td><?php echo $status; ?></td>
                              <td>
                                  <!-- Edit button that redirects to complaint-edit-view.php -->
                                  <a href="complaint-edit-view.php?id=<?php echo $id; ?>&answer_id=<?php echo $answer_id; ?>&question_id=<?php echo $question_id; ?>&username=<?php echo $username; ?>&type=<?php echo $type; ?>&description=<?php echo $description; ?>&created_at=<?php echo $created_at; ?>&status=<?php echo $status; ?>" class="btn btn-primary">Accept</a>
                                  <a href="complaint-edit-view.php?id=<?php echo $id; ?>&answer_id=<?php echo $answer_id; ?>&question_id=<?php echo $question_id; ?>&username=<?php echo $username; ?>&type=<?php echo $type; ?>&description=<?php echo $description; ?>&created_at=<?php echo $created_at; ?>&status=<?php echo $status; ?>" class="btn btn-primary">Reject</a>
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
