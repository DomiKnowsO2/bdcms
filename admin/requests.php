<!DOCTYPE html>
<html lang="en">
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
                    <h4 style="text-align:center">Appointment Requests</h4>
                </div>
                <table id="example" class="table table-striped" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Request No.</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Service</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Appointment Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $data = mysqli_query($conn, "SELECT r.*, s.service_name FROM requests_tb r INNER JOIN services_tb s ON r.service_id = s.service_id");
                        while ($row = mysqli_fetch_array($data)) {
                            if ($row['status'] != "Approve" && $row['status'] !="Done") {
                                echo "<tr>";
                                echo "<td>" . $row['request_id'] . "</td>";
                                echo "<td>" . $row['lastName'] . "</td>";
                                echo "<td>" . $row['firstName'] . "</td>";
                                echo "<td>" . $row['service_name'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>" . $row['appointment_date'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>";
                                echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#changeStatusModal' data-bs-request-id='" . $row['request_id'] . "'>Change Status</button>";
                                echo "</td>";

                                /*
                            echo "<td>";
                            echo "<a href='delete_schedule.php?id=".$row['id']."' type='button' class='btn btn-primary'>Delete";
                            echo "</a>";
                            echo "</td>";*/
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" id="modal-body">
                          
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#changeStatusModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); 
                var requestId = button.data('bs-request-id'); 

                $.ajax({
                    type: 'POST',
                    url: 'editstatus.php',
                    data: {
                        requestId: requestId
                    },
                    success: function(response) {
                        $('#modal-body').html(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle the error scenario
                        console.log(error);
                    }
                });

            });
        });
    </script>



</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();


    });
</script>

</html>