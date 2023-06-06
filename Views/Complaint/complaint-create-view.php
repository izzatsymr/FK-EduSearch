<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Create New Complaint</h2>

                <form method="post" action="complaint-create.php">
                    <div class="form-group">
                        <label for="answer_id">Answer ID:</label>
                        <input type="text" class="form-control" id="answer_id" name="answer_id" required>
                    </div>
                    <div class="form-group">
                        <label for="complaint_type">Complaint Type:</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="Unsatisfied Expert’s Feedback">Unstatisfied Expert's Feedback</option>
                            <option value="Wrongly  Assigned Research Area">Wrongly  Assigned Research Area</option>
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
</body>

</html>
