<!DOCTYPE html>
<html lang="en">
<?php
include('../db-connect.php');

if (isset($_POST['history'])) {
    $request_id = $_POST['request_id'];
    $patient_id = $_POST['patient_id'];
    $service_id = $_POST['service_id'];
    $newStatus = $_POST['statusSelect'];
    $careForm = $_POST['careForm'];
    $appointment_date = $_POST['appointment_date'];

    $updateQuery = "UPDATE requests_tb SET status = '$newStatus' WHERE request_id = $request_id";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Create the SQL query to copy data and insert into history_tb
        $historyQuery = "INSERT INTO history_tb (patient_id, service_id, service_details, appointment_date) VALUES ('$patient_id', '$service_id', '$careForm', '$appointment_date')";
        $historyResult = mysqli_query($conn, $historyQuery);

        if ($historyResult) {
            header('location:./index.php');
            exit();
        } else {
            // Handle the scenario when the history insertion fails
            header('location:./index.php');
            exit();
        }
    } else {
        // Handle the scenario when the update query fails
        header('location:./index.php');
        exit();
    }
}
?>
<style>
    <?php
    include("./admin.css");
    ?>
</style>

<body>
    <div class="col py-1">
        <div class="container-fluid bg-light edges">
            <div class="col py-1">
                <div>
                    <h4 style="text-align:center">History Record</h4>
                </div>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>History No.</th>
                            <th>Patient No.</th>
                            <th>Appointment</th>
                            <th>Services</th>
                            <th>Services Details</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $data = mysqli_query($conn, "SELECT* FROM history_tb");

                        while ($row = mysqli_fetch_array($data)) {
                            echo "<tr>";
                            echo "<td>" . $row['history_id'] . "</td>";
                            echo "<td>" . $row['patient_id'] . "</td>";
                            echo "<td>" . $row['service_id'] . "</td>";
                            echo "<td>" . $row['appointment_date'] . "</td>";
                            echo "<td class='service_details'><span>" . $row['service_details'] . "</span></td>";
                            echo "</tr>";
                        }
                        ?>


                    </tbody>
                </table>
                <div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
                </div>
            </div>
        </div>

    </div>




</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();

        // $(document).on('click', '.btn', function () {
        //     var button = $(this);
        //     var requestId = button.data('bs-request-id'); // Extract request ID from data attribute

        //     alert(requestId);

        //    
        // });

    });
</script>
<style>
    .service_details {
        max-width: 200px;
        overflow: hidden;
    }

    .service_details span {
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
    }
</style>


</html>