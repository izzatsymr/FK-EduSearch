<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Styles/style.css">
</head>

<body>
    <div class="container" style="margin-top: 25px;">
        <div class="row">
            <div class="col-sm-15">
                <?php echo $deleteMsg ?? ''; ?>
                <!-- New container for displaying total complaints by type -->
                <div class="mb-3">
                    <h3>Complaint List</h3>
                    <h5>Complaint Count By Type</h5>
                    <form method="GET" action="">
                        <div class="form-group">
                            <label for="dateType">Select Date Type:</label>
                            <select class="form-control" id="dateType" name="dateType">
                                <option value="day">Today</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <?php
                    // Check if dateType is set in the URL parameters
                    if (isset($_GET['dateType'])) {
                        $dateType = $_GET['dateType'];

                        // Connect to MySQL server
                        $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

                        // Select the database named "fkedusearch"
                        mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

                        // Query to fetch total complaints by type based on selected dateType
                        $query = "SELECT type, COUNT(*) as total FROM complaints WHERE DATE(created_at) >= CURDATE() - INTERVAL 1 $dateType GROUP BY type";
                        $result = mysqli_query($mysql, $query);

                        if (mysqli_num_rows($result) > 0) {
                            echo "<div class='mt-3'>";
                            echo "<h5>Total Complaints by Type ($dateType):</h5>";
                            echo "<ul>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                $type = $row["type"];
                                $total = $row["total"];
                                echo "<li>$type: $total</li>";
                            }
                            echo "</ul>";
                            echo "</div>";
                        } else {
                            echo "<p>No complaints found for the selected $dateType.</p>";
                        }

                        // Close the database connection
                        mysqli_close($mysql);
                    }
                    ?>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Complaint ID</th>
                                <th>Answer ID</th>
                                <th>Question ID</th>
                                <th>User Name</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // Connect to MySQL server
                            $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

                            // Select the database named "fkedusearch"
                            mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

                            $query = "SELECT u.first_name, a.question_id, c.id, c.answer_id, c.type, c.description, c.status, c.created_at
                            FROM complaints c, answers a, questions q, users u 
                            WHERE c.answer_id = a.id AND a.question_id = q.id AND q.user_id = u.id";

                            $result = mysqli_query($mysql, $query);

                            if (mysqli_num_rows($result) > 0) {
                                // Output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row["id"];
                                    $answer_id = $row["answer_id"];
                                    $question_id = $row["question_id"];
                                    $username = $row["first_name"];
                                    $type = $row["type"];
                                    $description = $row["description"];
                                    $created_at = $row["created_at"];
                                    $status = $row["status"];
                            ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $answer_id; ?></td>
                                        <td><?php echo $question_id; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo $description; ?></td>
                                        <td><?php echo $created_at; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <!-- Edit button that redirects to complaint-edit-view.php -->
                                            <a href="complaint-edit-view.php?id=<?php echo $id; ?>&answer_id=<?php echo $answer_id; ?>&question_id=<?php echo $question_id; ?>&username=<?php echo $username; ?>&type=<?php echo $type; ?>&description=<?php echo $description; ?>&created_at=<?php echo $created_at; ?>&status=<?php echo $status; ?>" class="btn btn-primary">Edit</a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>