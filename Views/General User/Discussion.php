<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php
    include '..\..\Assets\navbar.html';
    ?>

    <div class="container">
        <h1>Question List</h1>

        <!-- Search form -->
        <div class="mb-3">
            <form action="" method="GET" class="input-group">
                <input type="text" class="form-control" placeholder="Search keywords" name="search">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <!-- Add Discussion button -->
        <a href="discussion-create.php" class="btn btn-primary mb-3">Add Discussion</a>

        <?php
        // Connect to the database
        $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
        mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['search'])) {
                $searchKeyword = $_GET['search'];
                // Construct the query to search for matching questions
                $query = "SELECT * FROM questions WHERE title LIKE '%$searchKeyword%' OR description LIKE '%$searchKeyword%'";
            } else {
                // Fetch all questions from the database
                $query = "SELECT * FROM questions";
            }

            // Execute the query
            $result = mysqli_query($mysql, $query);

            // Loop through the result and display each question as a card
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">Question ID: ' . $row['id'] . '</h5>';
                echo '<h6 class="card-subtitle mb-2 text-muted">Type: ' . $row['type'] . '</h6>';
                echo '<h6 class="card-subtitle mb-2 text-muted">Title: ' . $row['title'] . '</h6>';
                echo '<p class="card-text">Description: ' . $row['description'] . '</p>';
                echo '<p class="card-text">Status: ' . $row['status'] . '</p>';
                echo '<form method="POST" action="">';
                echo '<input type="hidden" name="question_id" value="' . $row['id'] . '">';
                echo '<button type="submit" name="like" class="btn btn-primary">Like (' . $row['like'] . ')</button>';
                echo '<button type="submit" name="answer" class="btn btn-success">Answer</button>';
                echo '</form>';
                echo '</div>';
                if ($row['expert_id'] === null) {
                    echo "<a href='discussion-edit-view.php?id=" . $row['id'] . "' class='btn btn-primary'>Assign Expert</a>";
                }
                echo '</div>';
            }

            // Close the database connection
            mysqli_close($mysql);
        }
        ?>

    </div>

</body>

</html>