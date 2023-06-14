<!DOCTYPE html>
<html>

<head>
    <title>Complaints List Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .chart-card {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Complaints Report</h1>
        <div class="card chart-card">
            <div class="card-body">
                <h4 class="card-title">Report By Type</h4>
                <canvas id="complaintsByTypeChart"></canvas>
            </div>
        </div>

        <div class="card chart-card">
            <div class="card-body">
                <h4 class="card-title">Report By Status</h4>
                <canvas id="complaintsByStatusChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script>
        // Fetch complaints by type data from PHP
        <?php
        $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
        mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

        $complaintsByTypeData = array();
        $sql = "SELECT type, COUNT(*) AS count FROM complaints GROUP BY type";
        $result = mysqli_query($mysql, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $complaintsByTypeData['labels'][] = $row['type'];
                $complaintsByTypeData['counts'][] = $row['count'];
            }
        }
        mysqli_close($mysql);
        ?>

        var complaintsByTypeData = <?php echo json_encode($complaintsByTypeData); ?>;

        // Create the complaints by type chart
        var complaintsByTypeCtx = document.getElementById("complaintsByTypeChart").getContext("2d");
        var complaintsByTypeChart = new Chart(complaintsByTypeCtx, {
            type: 'bar',
            data: {
                labels: complaintsByTypeData.labels,
                datasets: [{
                    label: "Complaints by Type",
                    data: complaintsByTypeData.counts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(153, 102, 255, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }
        });

        // Fetch complaints by status data from PHP
        <?php
        $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
        mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

        $complaintsByStatusData = array();
        $sql = "SELECT status, COUNT(*) AS count FROM complaints GROUP BY status";
        $result = mysqli_query($mysql, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $complaintsByStatusData['labels'][] = $row['status'];
                $complaintsByStatusData['counts'][] = $row['count'];
            }
        }
        mysqli_close($mysql);
        ?>

        var complaintsByStatusData = <?php echo json_encode($complaintsByStatusData); ?>;

        // Create the complaints by status chart
        var complaintsByStatusCtx = document.getElementById("complaintsByStatusChart").getContext("2d");
        var complaintsByStatusChart = new Chart(complaintsByStatusCtx, {
            type: 'pie',
            data: {
                labels: complaintsByStatusData.labels,
                datasets: [{
                    data: complaintsByStatusData.counts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(75, 192, 192, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>

</html>