<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Edit Complaint</h2>

                <?php
                // Check if the complaint ID is provided in the URL
                if (isset($_GET['id'])) {
                    // Get the complaint ID from the URL
                    $id = $_GET['id'];

                    // Retrieve the complaint data from the database
                    $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
                    mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

                    $query = "SELECT u.first_name, a.question_id, c.id, c.answer_id, c.type, c.description, c.status, c.created_at
                    FROM complaints c, answers a, questions q, users u 
                    WHERE c.answer_id = a.id AND a.question_id = q.id AND q.user_id = u.id AND c.id = $id";

                    $result = mysqli_query($mysql, $query);

                    if (mysqli_num_rows($result) == 1) {
                        // Fetch the complaint data
                        $row = mysqli_fetch_assoc($result);
                        $answer_id = $row["answer_id"];
                        $question_id = $row["question_id"];
                        $username = $row["first_name"];
                        $type = $row["type"];
                        $description = $row["description"];
                        $created_at = $row["created_at"];
                        $status = $row["status"];
                ?>

                        <form method="post" action="update-complaint.php">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="answer_id">Answer ID:</label>
                                <input type="text" class="form-control" id="answer_id" name="answer_id" value="<?php echo $answer_id; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="question_id">Question ID:</label>
                                <input type="text" class="form-control" id="question_id" name="question_id" value="<?php echo $question_id; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="username">User Name:</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="type">Type:</label>
                                <input type="text" class="form-control" id="type" name="type" value="<?php echo $type; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description" readonly><?php echo $description; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="created_at">Created At:</label>
                                <input type="text" class="form-control" id="created_at" name="created_at" value="<?php echo $created_at; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="investigation" <?php if ($status == "investigation") echo "selected"; ?>>investigation</option>
                                    <option value="onhold" <?php if ($status == "onhold") echo "selected"; ?>>onhold</option>
                                    <option value="resolved" <?php if ($status == "resolved") echo "selected"; ?>>resolved</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                <?php
                    } else {
                        echo "Complaint not found.";
                    }

                    mysqli_close($mysql);
                } else {
                    echo "Invalid complaint ID.";
                }
                ?>

                <?php
                // Check if the form is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Check if the ID and status values are provided
                    if (isset($_POST["id"]) && isset($_POST["status"])) {
                        //Get the ID and status values from the form
                        $id = $_POST["id"];
                        $status = $_POST["status"];

                        //Connect to the MySQL server
                        $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

                        //Select the database named "fkedusearch"
                        mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

                        //Update the status attribute in the "complaints" table
                        $query = "UPDATE complaints SET status = '$status' WHERE id = $id";
                        $result = mysqli_query($mysql, $query);

                        //Check if the update was successful
                        if ($result) {
                            echo "Status updated successfully.";
                        } else {
                            echo "Error updating status: " . mysqli_error($mysql);
                        }

                        // 5. Close the database connection
                        mysqli_close($mysql);
                    } else {
                        echo "Invalid parameters.";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>