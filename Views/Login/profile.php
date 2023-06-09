<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="../../Styles (css)/style.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <link href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/images/favicon.ico" rel="shortcut icon" type="image/x-icon">

    <?php
    // Connect to the database and fetch the total number of experts and general users
    $conn = mysqli_connect("localhost", "root", "", "fkedusearch");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch the total number of experts
    $sqlExperts = "SELECT COUNT(*) AS totalExperts FROM users WHERE role_id = 2";
    $resultExperts = mysqli_query($conn, $sqlExperts);
    $rowExperts = mysqli_fetch_assoc($resultExperts);
    $totalExperts = $rowExperts['totalExperts'];

    // Fetch the total number of general users
    $sqlGeneralUsers = "SELECT COUNT(*) AS totalGeneralUsers FROM users WHERE role_id = 3";
    $resultGeneralUsers = mysqli_query($conn, $sqlGeneralUsers);
    $rowGeneralUsers = mysqli_fetch_assoc($resultGeneralUsers);
    $totalGeneralUsers = $rowGeneralUsers['totalGeneralUsers'];

    // Close the database connection
    mysqli_close($conn);
    ?>


</head>

<body>
    <?php
    include '..\..\Assets\navbar.html';
    ?>

    <div class="container">
        <h2>Admin Dashboard</h2>
        <br><br>
        <div class="row rounded">
            <div class="col-3 mb-4 mt-3 pt-4 pb-3 bg-light w-auto h-fit-content">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-profile-tab" selected data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <i class="fas fa-user"></i> &nbsp; Expert total <span class="badge badge-primary"><?php echo $totalExperts; ?></span>
                    </a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                        <i class="fas fa-users"></i> &nbsp; General User total <span class="badge badge-primary"><?php echo $totalGeneralUsers; ?></span>
                    </a>
                </div>
            </div>

            <div class="col-9 mt-3">
                <div class="tab-content bg-light pb-5" id="v-pills-tabContent">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <script>
                        const ctx = document.getElementById('myChart');

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                                datasets: [{
                                    label: 'Number of Daily Report',
                                    data: [12, 19, 3, 5, 2, 3, 8],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>


                    <br>
                    <br>
                    <hr>
                    <br>

                    <button type="button" class="btn btn-outline-primary float-right mt-3 mb-5" data-toggle="modal" data-target=".bd-example-modal-md" onclick="location.href='logout.php'">Log Out</button>

                    <br>
                    <br>

                    <footer class="footer pt-5 pb-5" id="footer">
                        <div class="container">
                            <span class="text-muted float-left">
                                <p id="copyright">&copy; 2023 Section 01A GP6</p>
                            </span>

                            <span class="float-right">
                                <p id="footerInfo"> Izzat | Thaqi | Aziz | Yushag | Shafia</p>
                            </span>
                        </div>
                    </footer>



</body>

</html>