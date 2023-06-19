<!DOCTYPE html>
<html lang="en">
<?php
include('../db-connect.php');
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
                            <th>Patient No.</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Services</th>
                            <th>Services Details</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                      $data = mysqli_query($conn, "SELECT history_tb.*, services_tb.service_name 
                      FROM history_tb 
                      INNER JOIN services_tb 
                      ON history_tb.service_id = services_tb.service_id");

                        while ($row = mysqli_fetch_array($data)) {
                            echo "<tr>";
                            echo "<td>" . $row['patient_id'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['time'] . "</td>";
                            echo "<td>" . $row['service_name'] . "</td>";
                            echo "<td>" . $row['service_details'] . "</td>";

                            /*
                            echo "<td>";
                            echo "<a href='delete_schedule.php?id=".$row['id']."' type='button' class='btn btn-primary'>Delete";
                            echo "</a>";
                            echo "</td>";*/
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusModalLabel"
                    aria-hidden="true">
                </div>
            </div>
        </div>

    </div>




</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#example').DataTable();

        // $(document).on('click', '.btn', function () {
        //     var button = $(this);
        //     var requestId = button.data('bs-request-id'); // Extract request ID from data attribute

        //     alert(requestId);

        //    
        // });

    });
</script>

</html>