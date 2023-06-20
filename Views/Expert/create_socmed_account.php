<!DOCTYPE html>
<html>
<head>
    <title>Create Social Media Account</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Create Social Media Account</h2>
        <form action="create_socmed_account.php" method="POST">
            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" name="type" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="link">Link:</label>
                <input type="text" name="link" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process the form submission
        $type = $_POST["type"];
        $link = $_POST["link"];

        // Insert the social media account into the database
        $conn = mysqli_connect("localhost", "root", "", "fkedusearch");
        $query = "INSERT INTO socmed_accounts (type, link) VALUES ('$type', '$link')";
        mysqli_query($conn, $query);

        // Redirect back to the first page
        header("Location: expertise.php");
        exit();
    }
    ?>
</body>
</html>
