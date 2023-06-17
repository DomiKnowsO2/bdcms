<!DOCTYPE html>
<html lang="en">
<?php
include('../db-connect.php');

if (isset($_POST['Savechanges'])) {
    $serviceid = $_POST['serviceid'];
    $ServiceName = $_POST['ServiceName'];
    $ServicePrice = $_POST['ServicePrice'];

    $updateQuery = "UPDATE services_tb SET service_name = '$ServiceName', service_price = '$ServicePrice' WHERE service_id = $serviceid";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Success: redirect or display success message
    } else {
        // Error: redirect or display error message
    }
}


if (isset($_POST['add'])) {
    // Get form values
    $ServiceName = $_POST['ServiceName'];
    $ServicePrice = $_POST['ServicePrice'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO services_tb (service_name, service_price)
                           VALUES (?, ?)");
    // Bind the parameters
    $stmt->bind_param("sd", $ServiceName, $ServicePrice);

    // Execute the statement
    $stmt->execute();

    // Check if the update was successful
    // if ($stmt->affected_rows > 0) {
    // 	header('location:./index.php?page=services');
    // } else {
    // 	header('location:./index.php?page=services');
    // }

    // Close the statement
    $stmt->close();
}

?>

<body>
    <div class="col py-1">
        <div class="container-fluid bg-light">
            <div class="col py-1">
                <div style="display:flex;justify-content: space-between;">
                    <div></div>
                    <h4 style="text-align:center">Services Record</h4>
                    <?php echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#addRecord'> Add </button>"; ?>
                </div>
                <br>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Service ID</th>
                            <th>Service Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM services_tb");
                        while ($row = mysqli_fetch_array($data)) {
                            echo "<tr>";
                            echo "<td>" . $row['service_id'] . "</td>";
                            echo "<td>" . $row['service_name'] . "</td>";
                            echo "<td>" . $row['service_price'] . "</td>";
                            echo "<td>";

                            echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#changeStatusModal' data-bs-request-id='" . $row['service_id'] . "'>Edit</button>";
                            echo "<a href='delete_schedule.php?id=" . $row['service_id'] . "' type='button' class='btn btn-primary'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addRecord" tabindex="-1" aria-labelledby="addRecordLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecordLabel">Add Services</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./index.php?page=services" method="post">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="ServiceName" class="form-label">Service Name:</label>
                            <input type="text" class="form-control" id="ServiceName" name="ServiceName" required>
                        </div>
                        <div class="mb-3">
                            <label for="ServicePrice" class="form-label">Service Price:</label>
                            <input type="text" class="form-control" id="ServicePrice" name="ServicePrice" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-body">
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

        $('#changeStatusModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var requestId = button.data('bs-request-id'); // Extract request ID from data attribute

            $.ajax({
                type: 'POST',
                url: 'editservice.php',
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

</html>