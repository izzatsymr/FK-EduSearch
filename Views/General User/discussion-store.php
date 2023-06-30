


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['user_id']) && isset($_POST['type']) && isset($_POST['title']) && isset($_POST['description'])) {
        $user_id = $_POST['user_id'];
        $type = $_POST['type'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        // Connect to the database
        $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
        mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

        $user_id = mysqli_real_escape_string($mysql, $user_id);
        $type = mysqli_real_escape_string($mysql, $type);
        $title = mysqli_real_escape_string($mysql, $title);
        $description = mysqli_real_escape_string($mysql, $description);

        $query = "INSERT INTO questions (user_id, expert_id, type, title, description) VALUES ('$user_id', null, '$type', '$title', '$description')";
        mysqli_query($mysql, $query);

        // Close the database connection
        mysqli_close($mysql);
    }
}
header("Location: discussion-list-view.php");
exit();

