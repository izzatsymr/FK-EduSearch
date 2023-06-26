<?php
// Connect to the database
$mysql = mysqli_connect("localhost", "root", "", "fkedusearch") or die(mysqli_connect_error());

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

// Initialize the variable to store the question list HTML
$questionListHTML = '';

// Loop through the result and generate the question list HTML
while ($row = mysqli_fetch_assoc($result)) {
    $questionListHTML .= '<div class="card">';
    $questionListHTML .= '<div class="card-body">';
    $questionListHTML .= '<h5 class="card-title">Question ID: ' . $row['id'] . '</h5>';
    $questionListHTML .= '<h6 class="card-subtitle mb-2 text-muted">Type: ' . $row['type'] . '</h6>';
    $questionListHTML .= '<h6 class="card-subtitle mb-2 text-muted">Title: ' . $row['title'] . '</h6>';
    $questionListHTML .= '<p class="card-text">Description: ' . $row['description'] . '</p>';
    $questionListHTML .= '<p class="card-text">Status: ' . $row['status'] . '</p>';
    $questionListHTML .= '<form method="POST" action="">';
    $questionListHTML .= '<input type="hidden" name="question_id" value="' . $row['id'] . '">';
    $questionListHTML .= '<button type="submit" name="like" class="btn btn-primary">Like (' . $row['like'] . ')</button>';
    $questionListHTML .= '<button type="submit" name="answer" class="btn btn-success">Answer</button>';
    $questionListHTML .= '</form>';
    $questionListHTML .= '</div>';
    $questionListHTML .= '</div>';
}

// Close the database connection
mysqli_close($mysql);

// Return the question list HTML
echo $questionListHTML;
?>
