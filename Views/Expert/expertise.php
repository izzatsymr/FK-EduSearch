<!DOCTYPE html>
<html>
<head>
    <title>Expertise Update</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .delete-btn {
            margin-left: 10px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
  <?php
  include '..\..\Assets\navbar.html';
  ?>
    <div class="container">
        <h2>Expertise Update</h2>
        <form action="" method="POST">
            <?php
            $conn = mysqli_connect("localhost", "root", "", "fkedusearch");

            // Retrieve academic status from users table
            $query = mysqli_query($conn, "SELECT academic_status FROM users");
            $row = mysqli_fetch_assoc($query);
            $academicStatus = $row['academic_status'];

            // Retrieve curriculum vitae from experts table
            $query = mysqli_query($conn, "SELECT curriculum_vitae FROM experts");
            $row = mysqli_fetch_assoc($query);
            $curriculumVitae = $row['curriculum_vitae'];
            ?>

            <div class="form-group">
                <label for="academicStatus">Academic Status:</label>
                <input type="text" name="academicStatus" class="form-control" value="<?php echo $academicStatus; ?>" required>
            </div>

            <div class="form-group">
                <label for="curriculumVitae">Curriculum Vitae:</label>
                <textarea name="curriculumVitae" class="form-control" required><?php echo $curriculumVitae; ?></textarea>
            </div>

            <!-- Research Areas -->
            <h4>Research Areas:</h4>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM researches");
            while ($row = mysqli_fetch_assoc($query)) {
                echo '<div class="form-check">';
                echo '<label class="form-check-label">'.$row['name'].'</label>';
                echo '<button type="button" class="btn btn-danger btn-sm delete-btn" data-id="'.$row['id'].'">Delete</button>';
                echo '</div>';
            }
            ?>

            <!-- Publications -->
            <h4>Publications:</h4>
            <?php
            $query = mysqli_query($conn, "SELECT id, author, title, year, publisher FROM publications");
            while ($row = mysqli_fetch_assoc($query)) {
                echo '<div class="form-check">';
                echo '<label class="form-check-label">Author: '.$row['author'].' | Title: '.$row['title'].' | Year: '.$row['year'].' | Publisher: '.$row['publisher'].'</label>';
                echo '<button type="button" class="btn btn-danger btn-sm delete-btn" data-id="'.$row['id'].'">Delete</button>';
                echo '</div>';
            }
            ?>

            <!-- Social Media Accounts -->
            <h4>Social Media Accounts:</h4>
            <?php
            $query = mysqli_query($conn, "SELECT type, link FROM socmed_accounts");
            while ($row = mysqli_fetch_assoc($query)) {
                echo '<div class="form-check">';
                echo '<label class="form-check-label">Type: '.$row['type'].' | Link: '.$row['link'].'</label>';
                echo '<button type="button" class="btn btn-danger btn-sm delete-btn" data-link="'.$row['link'].'">Delete</button>';
                echo '</div>';
            }
            ?>

            <div class="d-flex justify-content-between mt-4">
                <a href="create_research.php" class="btn btn-primary">Create Research</a>
                <a href="create_publication.php" class="btn btn-primary">Create Publication</a>
                <a href="create_socmed_account.php" class="btn btn-primary">Create Social Media Account</a>
            </div>

            <button type="submit" name="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Delete Research
            $('.delete-btn').click(function () {
                var id = $(this).data('id');
                var link = $(this).data('link');
                var type = $(this).data('type');
                var dataType = id ? 'research' : (link ? 'socmed' : 'publication');
                var dataValue = id || link;

                $.ajax({
                    url: 'delete_item.php',
                    type: 'POST',
                    data: { type: dataType, value: dataValue },
                    success: function (response) {
                        // Handle success response, e.g., remove the deleted item from the DOM
                        console.log(response);
                    },
                    error: function (xhr, status, error) {
                        // Handle error response
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
