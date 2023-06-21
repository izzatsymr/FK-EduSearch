<!DOCTYPE html>
<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

  <?php
  include '..\..\Assets\navbar.html';
  ?>

  <div class="container">
    <h1>Create Discussion</h1>
    <form action="discussion-store.php" method="POST">
      <div class="mb-3">
        <label for="user_id" class="form-label">User ID</label>
        <input type="text" class="form-control" id="user_id" name="user_id">
      </div>
      <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select class="form-select" id="type" name="type">
          <option value="Software Engineering">Software Engineering</option>
          <option value="Networking">Networking</option>
          <option value="Graphics & Multimedia">Graphics & Multimedia</option>
          <option value="Security">Security</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Create Discussion</button>
    </form>
  </div>

</body>

</html>