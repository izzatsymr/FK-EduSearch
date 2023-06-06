<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-15">
                <?php echo $deleteMsg ?? ''; ?>
                <!-- New container for displaying total complaints by type -->
                <div class="mb-3">
                    <h3>Total Complaints by Type</h3>
                    <form method="GET" action="">
                        <div class="form-group">
                            <label for="dateType">Select Date Type:</label>
                            <select class="form-control" id="dateType" name="dateType">
                                <option value="day">Day</option>
                                <option value="week">Week</option>
                                <option value="month">Month</option>
                            </select>
                        </div>
                        <div class="form-group" id="dateFields">
                            <label for="startDate">Select Date:</label>
                            <input type="date" class="form-control" id="startDate" name="startDate">
                        </div>
                        <div class="form-group" id="weekFields" style="display: none;">
                            <label for="weekNumber">Select Week Number:</label>
                            <input type="week" class="form-control" id="weekNumber" name="weekNumber">
                        </div>
                        <div class="form-group" id="monthFields" style="display: none;">
                            <label for="monthNumber">Select Month Number:</label>
                            <input type="month" class="form-control" id="monthNumber" name="monthNumber">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <script>
                        // Show/hide input fields based on selected date type
                        document.getElementById("dateType").addEventListener("change", function() {
                            var dateType = this.value;
                            var dateFields = document.getElementById("dateFields");
                            var weekFields = document.getElementById("weekFields");
                            var monthFields = document.getElementById("monthFields");

                            dateFields.style.display = "none";
                            weekFields.style.display = "none";
                            monthFields.style.display = "none";

                            if (dateType === "day") {
                                dateFields.style.display = "block";
                            } else if (dateType === "week") {
                                weekFields.style.display = "block";
                            } else if (dateType === "month") {
                                monthFields.style.display = "block";
                            }
                        });
                    </script>
                    <?php
                    // Check if dateType is set in the URL parameters
                    if (isset($_GET['dateType'])) {
                        $dateType = $_GET['dateType'];

                        // Connect to MySQL server
                        $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

                        // Select the database named "fkedusearch"
                        mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

                        // Initialize the date condition and bind parameters
                        $dateCondition = "";
                        $bindParams = array();

                        // Generate the date condition based on selected dateType
                        if ($dateType === "day") {
                            $startDate = $_GET['startDate'];
                            $dateCondition = "DATE(created_at) = ?";
                            $bindParams[] = $startDate;
                        } else if ($dateType === "week") {
                            $weekNumber = $_GET['weekNumber'];
                            $dateCondition = "WEEK(created_at) = ?";
                            $bindParams[] = $weekNumber;
                        } else if ($dateType === "month") {
                            $monthNumber = $_GET['monthNumber'];
                            $dateCondition = "MONTH(created_at) = ?";
                            $bindParams[] = $monthNumber;
                        }

                        // Prepare the query with the date condition
                        $query = "SELECT type, COUNT(*) as total FROM complaints WHERE $dateCondition GROUP BY type";
                        $stmt = mysqli_prepare($mysql, $query);

                        // Bind the parameters
                        if ($dateType === "day" || $dateType === "week" || $dateType === "month") {
                            mysqli_stmt_bind_param($stmt, str_repeat("s", count($bindParams)), ...$bindParams);
                        }

                        // Execute the query
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

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

                        // Close the statement
                        mysqli_stmt_close($stmt);

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