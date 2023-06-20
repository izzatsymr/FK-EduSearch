<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

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
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">FK-EDUSEARCH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Discussion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">General Users</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Experts
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Expert Profile<span class="badge bg-primary rounded-pill">14</span></a></li>
                            <li><a class="dropdown-item" href="#">Status<span class="badge bg-primary rounded-pill">14</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Complaint</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Manage Account</a>
                    </li>
                </ul>
                <br>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 25px;">
        <div class="row">
            <div class="col-sm-15">
                <?php echo $deleteMsg ?? ''; ?>
                <!-- Displaying total complaints by type -->
                <div class="mb-3">
                    <h3>Complaint List</h3>
                    <div class="card">
                        <div class="card-body">
                            <?php
                            // Connect to MySQL server
                            $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

                            // Select the database named "fkedusearch"
                            mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

                            // Query to fetch total complaints by type for different date types
                            $dateTypes = array("day", "week", "month");
                            $complaintTypes = array(); // Array to store unique complaint types

                            // Fetch unique complaint types
                            $query = "SELECT DISTINCT type FROM complaints";
                            $result = mysqli_query($mysql, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $complaintTypes[] = $row['type'];
                            }
                            ?>

                            <div class="mt-1">
                                <h5>Total Complaints by Type:</h5>
                                <table class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th>Complaint Type</th>
                                            <th>Today</th>
                                            <th>This Week</th>
                                            <th>This Month</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($complaintTypes as $complaintType) {
                                            echo "<tr>";
                                            echo "<td>$complaintType</td>";

                                            // Fetch and display total complaints for each date type
                                            foreach ($dateTypes as $dateType) {
                                                $query = "SELECT COUNT(*) as total FROM complaints WHERE DATE(created_at) >= CURDATE() - INTERVAL 1 $dateType AND type = '$complaintType'";
                                                $result = mysqli_query($mysql, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $total = $row['total'];

                                                echo "<td>$total</td>";
                                            }

                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                            // Close the database connection
                            mysqli_close($mysql);
                            ?>
                        </div>
                    </div>
                </div>

                <a href="Complaint-report-view.php" class="btn btn-primary mt-3">Full Report</a> <!-- Button for Full Report -->
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark align-middle">
                            <tr>
                                <th>Complaint ID</th>
                                <th>Answer ID</th>
                                <th>Question ID</th>
                                <th>User Name</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Issued On</th>
                                <th>Status</th>
                                <th>Action</th>
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
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row["id"];
                                    $answer_id = $row["answer_id"];
                                    $question_id = $row["question_id"];
                                    $username = $row["first_name"];
                                    $type = $row["type"];
                                    $description = $row["description"];
                                    $created_at = $row["created_at"];
                                    $status = $row["status"];
                                    $statusColor = '';
                                    switch ($status) {
                                        case 'onhold':
                                            $statusColor = '#FF5733';
                                            break;
                                        case 'investigation':
                                            $statusColor = '#3355FF';
                                            break;
                                        case 'resolved':
                                            $statusColor = '#77DD77';
                                            break;
                                        default:
                                            $statusColor = '';
                                            break;
                                    }
                            ?>
                                    <tr>
                                        <td class="align-middle"><?php echo $id; ?></td>
                                        <td class="align-middle"><?php echo $answer_id; ?></td>
                                        <td class="align-middle"><?php echo $question_id; ?></td>
                                        <td class="align-middle"><?php echo $username; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo $description; ?></td>
                                        <td class="align-middle"><?php echo $created_at; ?></td>
                                        <td class="align-middle" style="color: <?php echo $statusColor; ?>"><?php echo $status; ?></td>
                                        <td class="align-middle">
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
            </div>
        </div>
    </div>

    <div id="editPopup" class="edit-popup">
        <div class="edit-popup-content">
            <button class="close-button" onclick="closeEditPopup()">Close</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>