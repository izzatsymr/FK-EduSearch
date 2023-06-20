<!DOCTYPE html>
<html>
<head>
    <title>Expert Information and Ratings Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        h2, h4 {
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
            margin-top: 20px;
        }
        li {
            margin-bottom: 5px;
        }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">FK-EDUSEARCH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Experts
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Expert Profile</a></li>
                            <li><a class="dropdown-item" href="#">Expert Information</a></li>
                          <li><a class="dropdown-item" href="#">Status</a></li>
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
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4">Expert Information and Ratings Report</h2>

        <?php
        $conn = mysqli_connect("localhost", "root", "", "fkedusearch");

        // Calculate the ratings
        $query = "SELECT rating, DATE(updated_at) AS date FROM feedbacks ORDER BY date";
        $result = mysqli_query($conn, $query);

        $ratingsByDay = array();
        $ratingsByWeek = array();
        $ratingsByMonth = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $rating = $row['rating'];
            $date = $row['date'];

            $ratingsByDay[$date][] = $rating;
            $ratingsByWeek[date('Y-W', strtotime($date))][] = $rating;
            $ratingsByMonth[date('Y-m', strtotime($date))][] = $rating;
        }

        // Calculate the total ratings
        $totalRatings = mysqli_num_rows($result);

        // Calculate the average rating
        $averageRating = 0;
        if ($totalRatings > 0) {
            $sumRatings = array_sum(array_column($ratingsByDay, 'rating'));
            $averageRating = $sumRatings / $totalRatings;
        }

        // Fetch research areas
        $query = mysqli_query($conn, "SELECT * FROM researches");
        $researchAreas = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $researchAreas[$row['id']] = $row['name'];
        }

        // Generate the research areas report
        $researchReport = "";
        foreach ($researchAreas as $id => $name) {
            $researchReport .= "<strong>Research Area:</strong> $name<br>";
            $researchReport .= "<strong>Total Ratings:</strong> " . count($ratingsByDay[$id] ?? []) . "<br>";
            $researchReport .= "<hr>";
        }

        // Generate the ratings by day report
        $ratingsByDayReport = "";
        foreach ($ratingsByDay as $date => $ratings) {
            $ratingsByDayReport .= "<strong>Date:</strong> $date<br>";
            $ratingsByDayReport .= "<strong>Total Ratings:</strong> " . count($ratings) . "<br>";
            $ratingsByDayReport .= "<hr>";
        }

        // Generate the ratings by week report
        $ratingsByWeekReport = "";
        foreach ($ratingsByWeek as $week => $ratings) {
            $ratingsByWeekReport .= "<strong>Week:</strong> $week<br>";
            $ratingsByWeekReport .= "<strong>Total Ratings:</strong> " . count($ratings) . "<br>";
            $ratingsByWeekReport .= "<hr>";
        }

        // Generate the ratings by month report
        $ratingsByMonthReport = "";
        foreach ($ratingsByMonth as $month => $ratings) {
            $ratingsByMonthReport .= "<strong>Month:</strong> $month<br>";
            $ratingsByMonthReport .= "<strong>Total Ratings:</strong> " . count($ratings) . "<br>";
            $ratingsByMonthReport .= "<hr>";
        }
        ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <h4>Total Ratings: <?php echo $totalRatings; ?></h4>
                <h4>Average Rating: <?php echo $averageRating; ?></h4>

                <h4>Research Areas Ratings:</h4>
                <?php echo $researchReport; ?>

                <h4>Ratings by Day:</h4>
                <?php echo $ratingsByDayReport; ?>

                <h4>Ratings by Week:</h4>
                <?php echo $ratingsByWeekReport; ?>

                <h4>Ratings by Month:</h4>
                <?php echo $ratingsByMonthReport; ?>

                <h4>List of Publications:</h4>
                <ul>
                    <?php
                    $publicationQuery = mysqli_query($conn, "SELECT author, title, year, publisher FROM publications");
                    $publicationCount = mysqli_num_rows($publicationQuery);
                    echo "<p>Number of Publications: $publicationCount</p>";
                    while ($row = mysqli_fetch_assoc($publicationQuery)) {
                        echo "<li><strong>Author:</strong> {$row['author']} | <strong>Title:</strong> {$row['title']} | <strong>Year:</strong> {$row['year']} | <strong>Publisher:</strong> {$row['publisher']}</li>";
                    }
                    ?>
                </ul>

                <h4>Ratings for Research Areas:</h4>
                <canvas id="researchChart"></canvas>

                <h4>Ratings by Day:</h4>
                <canvas id="dayChart"></canvas>

                <h4>Ratings by Week:</h4>
                <canvas id="weekChart"></canvas>

                <h4>Ratings by Month:</h4>
                <canvas id="monthChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Fetch the ratings for research areas
        <?php
        $researchRatings = array();
        foreach ($researchAreas as $id => $name) {
            $researchRatings[$name] = count($ratingsByDay[$id] ?? []);
        }
        ?>

        // Generate the research areas chart
        var researchChart = new Chart(document.getElementById('researchChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($researchRatings)); ?>,
                datasets: [{
                    label: 'Ratings Count',
                    data: <?php echo json_encode(array_values($researchRatings)); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });

        // Generate the ratings by day chart
        var dayChart = new Chart(document.getElementById('dayChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode(array_keys($ratingsByDay)); ?>,
                datasets: [{
                    label: 'Ratings Count',
                    data: <?php echo json_encode(array_map('count', $ratingsByDay)); ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });

        // Generate the ratings by week chart
        var weekChart = new Chart(document.getElementById('weekChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode(array_keys($ratingsByWeek)); ?>,
                datasets: [{
                    label: 'Ratings Count',
                    data: <?php echo json_encode(array_map('count', $ratingsByWeek)); ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });

        // Generate the ratings by month chart
        var monthChart = new Chart(document.getElementById('monthChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode(array_keys($ratingsByMonth)); ?>,
                datasets: [{
                    label: 'Ratings Count',
                    data: <?php echo json_encode(array_map('count', $ratingsByMonth)); ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    </script>
</body>
</html>
