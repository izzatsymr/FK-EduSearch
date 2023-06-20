<!DOCTYPE html>
<html>
<head>
    <title>Create Publication</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Create Publication</h2>
        <form action="create_publication.php" method="POST">
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" name="author" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="year">Year:</label>
                <input type="text" name="year" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="publisher">Publisher:</label>
                <input type="text" name="publisher" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process the form submission
        $author = $_POST["author"];
        $title = $_POST["title"];
        $year = $_POST["year"];
        $publisher = $_POST["publisher"];

        // Insert the publication into the database
        $conn = mysqli_connect("localhost", "root", "", "fkedusearch");
        $query = "INSERT INTO publications (author, title, year, publisher) VALUES ('$author', '$title', '$year', '$publisher')";
        mysqli_query($conn, $query);

        // Redirect back to the first page
        header("Location: expertise.php");
        exit();
    }
    ?>
</body>
</html>
