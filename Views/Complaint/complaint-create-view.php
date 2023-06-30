<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include '..\..\Assets\navbar.html';
    ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Create New Complaint</h2>

                <form method="post" action="complaint-create.php">
                    <div class="form-group">
                        <label for="answer_id">Answer ID:</label>
                        <input type="text" class="form-control" id="answer_id" name="answer_id" value="<?php echo isset($_GET['answer_id']) ? $_GET['answer_id'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="complaint_type">Complaint Type:</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="Unsatisfied Expert’s Feedback">Unstatisfied Expert's Feedback</option>
                            <option value="Wrongly  Assigned Research Area">Wrongly Assigned Research Area</option>
                            <option value="Technical Problems">Technical Problems</option>
                            <option value="Plagiarism or Academic Misconduct">Plagiarism or Academic Misconduct</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Complaint Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>

    <footer class="footer mt-auto py-3 bg-body-tertiary">
        <div class="container">
            <span class="text-body-secondary">Copyright Universiti Malaysia Pahang. 2023.</span>
        </div>
    </footer>
</body>

</html>