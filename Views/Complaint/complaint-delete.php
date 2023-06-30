<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Connect to MySQL server
    $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

    // Select the database named "fkedusearch"
    mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

    // Delete the complaint with the provided ID
    $deleteQuery = "DELETE FROM complaints WHERE id = '$id'";
    $deleteResult = mysqli_query($mysql, $deleteQuery);

    // Close the database connection
    mysqli_close($mysql);
}

header("Location: complaint-list-view.php");
exit();
?>

