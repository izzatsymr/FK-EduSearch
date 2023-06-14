<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .close-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Edit Complaint</h2>

                <?php
                // Check if the complaint ID and other parameters are provided in the URL
                if (isset($_GET['id']) && isset($_GET['answer_id']) && isset($_GET['question_id']) && isset($_GET['username']) && isset($_GET['type']) && isset($_GET['description']) && isset($_GET['created_at']) && isset($_GET['status'])) {
                    // Get the parameters from the URL
                    $id = $_GET['id'];
                    $answer_id = $_GET['answer_id'];
                    $question_id = $_GET['question_id'];
                    $username = $_GET['username'];
                    $type = $_GET['type'];
                    $description = $_GET['description'];
                    $created_at = $_GET['created_at'];
                    $status = $_GET['status'];
                ?>

                    <form method="post" action="update-complaint.php">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label for="answer_id">Answer ID:</label>
                            <input type="text" class="form-control" id="answer_id" name="answer_id" value="<?php echo $answer_id; ?>" readonly>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="question_id">Question ID:</label>
                            <input type="text" class="form-control" id="question_id" name="question_id" value="<?php echo $question_id; ?>" readonly>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="username">User Name:</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" readonly>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <input type="text" class="form-control" id="type" name="type" value="<?php echo $type; ?>" readonly>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" readonly><?php echo $description; ?></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="created_at">Created At:</label>
                            <input type="text" class="form-control" id="created_at" name="created_at" value="<?php echo $created_at; ?>" readonly>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="status">
                                <option value="investigation" <?php if ($status == "investigation") echo "selected"; ?>>investigation</option>
                                <option value="onhold" <?php if ($status == "onhold") echo "selected"; ?>>onhold</option>
                                <option value="resolved" <?php if ($status == "resolved") echo "selected"; ?>>resolved</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                <?php
                } else {
                    echo "Invalid parameters.";
                }
                ?>

                <i class="fas fa-times close-icon" onclick="closeEditPopup()"></i>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        function closeEditPopup() {
            // Close the popup window
            window.close();
        }
    </script>
</body>

</html>