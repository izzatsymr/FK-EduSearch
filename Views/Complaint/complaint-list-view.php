<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Styles/style.css">

    <style>
        .edit-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 999;
        }

        .edit-popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            width: 80%;
            max-width: 600px;
            border-radius: 5px;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
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
                <a href="Complaint-report-view.php" class="btn btn-primary mt-3">Full Report</a> <!-- Button for Full Report -->
                <br>
                <br>
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
                                <th>Issued On</th>
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
                                            <!-- Edit button that displays the pop-up overlay -->
                                            <a href="javascript:void(0);" class="btn btn-primary" onclick="displayEditPopup(<?php echo $id; ?>, <?php echo $answer_id; ?>, <?php echo $question_id; ?>, '<?php echo $username; ?>', '<?php echo $type; ?>', '<?php echo $description; ?>', '<?php echo $created_at; ?>', '<?php echo $status; ?>')">Edit</a>
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

                <div id="editPopup" class="edit-popup">
                    <div class="edit-popup-content">
                        <!-- Close button -->
                        <button class="close-button" onclick="closeEditPopup()">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function displayEditPopup(id, answerId, questionId, username, type, description, createdAt, status) {
            var editPopup = document.getElementById("editPopup");
            editPopup.style.display = "block";

            var editPageUrl = "complaint-edit-view.php?id=" + id + "&answer_id=" + answerId + "&question_id=" + questionId + "&username=" + username + "&type=" + type + "&description=" + description + "&created_at=" + createdAt + "&status=" + status;
            var xhr = new XMLHttpRequest();
            xhr.open("GET", editPageUrl, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var editPopupContent = document.querySelector(".edit-popup-content");
                    editPopupContent.innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        function closeEditPopup() {
            var editPopup = document.getElementById("editPopup");
            editPopup.style.display = "none";
        }
    </script>

</body>

</html>