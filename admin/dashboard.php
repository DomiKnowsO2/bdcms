<!DOCTYPE html>
<html lang="en">
<style>
    <?php
    include("./admin.css");
    ?>
</style>

<head>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./calendar/evo-calendar/css/evo-calendar.min.css">
    <link rel="stylesheet" type="text/css" href="./calendar/evo-calendar/css/evo-calendar.midnight-blue.min.css">

    <link rel="stylesheet" type="text/css" href="./calendar/demo/demo.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Mono&display=swap" rel="stylesheet">
</head>

<body>
    <div class="col py-1 margin">

        <div class="row">
            <!-- sale card start -->

            <div class="col-md-3">
                <div class="card text-center order-visitor-card">
                    <div class="card-block">
                        <h6 class="m-b-0">Appointments</h6>
                        <h4 class="m-t-15 m-b-15"><i class="fas fa-calendar-alt"></i>
                            <?php
                            $sql_accepted = "SELECT COUNT(*) AS accepted_count FROM requests_tb WHERE Status = 'Approve'"; //AND DATE(appointment_date) = CURDATE();
                            $result_accepted = $conn->query($sql_accepted);
                            $row_accepted = $result_accepted->fetch_assoc();
                            echo $row_accepted['accepted_count'];
                            ?>
                        </h4>
                        <p class="m-b-0"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center order-visitor-card">
                    <div class="card-block">
                        <h6 class="m-b-0">Pending Requests</h6>
                        <h4 class="m-t-15 m-b-15"><i class="fas fa-clock m-r-15 text-c-green"></i>
                            <?php
                            $sql_pending = "SELECT COUNT(*) AS pending_count FROM requests_tb WHERE Status = 'Pending';";
                            $result_pending = $conn->query($sql_pending);
                            $row_pending = $result_pending->fetch_assoc();
                            echo $row_pending['pending_count'];
                            ?>
                        </h4>
                        <p class="m-b-0"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center order-visitor-card">
                    <div class="card-block">
                        <h6 class="m-b-0">Patients Statistics</h6>
                        <h4 class="m-t-15 m-b-15"><i class="fas fa-users m-r-15 text-c-red"></i>
                            <?php
                            $sql_patients = "SELECT COUNT(*) AS patients_count FROM patient_tb;";
                            $result_patients = $conn->query($sql_patients);
                            $row_patients = $result_patients->fetch_assoc();
                            echo $row_patients['patients_count'];
                            ?>
                        </h4>
                        <p class="m-b-0"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center order-visitor-card">
                    <div class="card-block">
                        <h6 class="m-b-0">Top Services</h6>
                        <h4 class="m-t-15 m-b-15"><i class="fas fa-star m-r-15 text-c-green"></i>Tooth Extraction</h4>
                        <p class="m-b-0"></p>
                    </div>
                </div>
            </div>
            <!-- sale card end -->
        </div>
        <div class="calendarContainer">
            <?php
            include('./calendar/index.php');
            ?>
            <!-- jQuery -->
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
            <script src="./calendar/evo-calendar/js/evo-calendar.min.js"></script>
            <script src="./calendar/demo/demo.js"></script>
            <script>
                $(document).ready(function () {
                    $('#calendar').evoCalendar({
                        theme: 'Midnight Blue',
                        calendarEvents: [

                            <?php
                            $sqlCalendar = mysqli_query($conn, "SELECT r.*, s.service_name FROM requests_tb r INNER JOIN services_tb s ON r.service_id = s.service_id ORDER BY r.appointment_date ASC");
                            while ($row = mysqli_fetch_array($sqlCalendar)) {
                                echo "{";
                                echo "id: '" . $row['request_id'] . "',";
                                echo "badge: '" . date('g:i a', strtotime($row['appointment_date'])) . "', ";
                                echo "name: '" . $row['firstName'] . " " . $row['lastName'] . "',";
                                echo "description: '" . $row['service_name'] . "<br>" . "',";
                                echo "date: '" . $row['appointment_date'] . "',";
                                echo "type: 'event',";
                                echo "color: ";

                                $status = $row['status'];
                                if ($status === "Approve") {
                                    echo "'#198754'";
                                } elseif ($status === "Reject") {
                                    echo "'#dc3545'";
                                } elseif ($status === "Done") {
                                    echo "'lightseagreen'";
                                } else {
                                    echo "'#fd7e14'";
                                }
                                echo "},";
                            }
                            ?>
                        ]
                    });
                });
            </script>
        </div>
    </div>
    <style>
        .margin {
            margin-top: 2%;
            /* background-color: pink; */
        }

        .order-visitor-card {
            /* -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out; */
            text-align: center !important;
            background-color: #fff;
            padding: 10px 0;
            color: rgb(100, 100, 100);
        }

        .card-block h4,
        p {
            color: lightseagreen;
        }

        .order-visitor-card:hover .card-block h4,
        .order-visitor-card:hover .card-block h6,
        .order-visitor-card:hover p {
            color: #fff;
        }

        .order-visitor-card:hover {
            background-color: lightseagreen;
        }
    </style>
</body>

</html>