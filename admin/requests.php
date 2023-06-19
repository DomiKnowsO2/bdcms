<!DOCTYPE html>
<html lang="en">

<body>
    <div class="col py-1">
        <div class="container-fluid bg-light">
            <div class="col py-1">
                <div>
                    <h4 style="text-align:center">Appointment Requests</h4>
                </div>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Request No.</th>
                            <th>Last Name</th>
                            <th>First Name</th>
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
                        $data = mysqli_query($conn, "SELECT * FROM requests_tb");
                        while ($row = mysqli_fetch_array($data)) {
                            if ($row['status'] != "Approve") {
                                echo "<tr>";
                                echo "<td>" . $row['request_id'] . "</td>";
                                echo "<td>" . $row['lastName'] . "</td>";
                                echo "<td>" . $row['firstName'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>" . $row['appointment_date'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>";
                                echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#changeStatusModal' data-bs-request-id='" . $row['request_id'] . "'>Change</button>";
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
                            <!-- <div class="modal-header">
                                <h5 class="modal-title" id="changeStatusModalLabel">Change Status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="statusSelect">Select Status:</label>
                                <select id="statusSelect" class="form-select">
                                    <option value="Pending">Pending</option>
                                    <option value="Accept">Accept</option>
                                    <option value="Reject">Reject</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div> -->
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#changeStatusModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var requestId = button.data('bs-request-id'); // Extract request ID from data attribute

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

        // $(document).on('click', '.btn', function () {
        //     var button = $(this);
        //     var requestId = button.data('bs-request-id'); // Extract request ID from data attribute

        //     alert(requestId);

        //    
        // });

    });
</script>

</html>