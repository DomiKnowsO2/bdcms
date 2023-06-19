<!DOCTYPE html>
<html lang="en">

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
                        <p class="m-b-0">Total Appointments</p>
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
                        <p class="m-b-0">36% From Last 6 Months</p>
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
                        <p class="m-b-0">48% From Last 24 Hours</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center order-visitor-card">
                    <div class="card-block">
                        <h6 class="m-b-0">Top Services</h6>
                        <h4 class="m-t-15 m-b-15"><i class="fas fa-star m-r-15 text-c-green"></i>6325</h4>
                        <p class="m-b-0">36% From Last 6 Months</p>
                    </div>
                </div>
            </div>
            <!-- sale card end -->
        </div>
    </div>
    <style>
        .margin {
            margin-top: 5%;
        }

        .order-visitor-card {
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            text-align: center !important;
            background-color: #448aff;
            padding: 10px 0;
        }

        .order-visitor-card:hover {
            background-color: darkblue;
            color: #fff;
        }
    </style>
</body>

</html>