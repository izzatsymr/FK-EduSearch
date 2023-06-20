<!DOCTYPE html>
<html>
<head>
    <title>Create Research</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Create Research</h2>
        <form action="create_research.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process the form submission
        $name = $_POST["name"];

        // Insert the research into the database
        $conn = mysqli_connect("localhost", "root", "", "fkedusearch");
        $query = "INSERT INTO researches (name) VALUES ('$name')";
        mysqli_query($conn, $query);

        // Redirect back to the first page
        header("Location: expertise.php");
        exit();
    }
    ?>
</body>
</html>
