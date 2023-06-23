<!DOCTYPE html>
<html lang="en">
<?php
include('../db-connect.php');
if (isset($_POST['Savechanges'])) {
    $request_id = $_POST['request_id'];
    $newStatus = $_POST['statusSelect'];

    $updateQuery = "UPDATE requests_tb SET status = '$newStatus' WHERE request_id = $request_id";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        header('location:./index.php?page=requests');
        exit();
    } else {
        header('location:./index.php?page=requests');
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
                    <h4 style="text-align:center">Patients Record</h4>
                </div>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <?php echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#addRecord'> Add Patients Record</button>"; ?>
                        </tr>
                        <tr>
                            <th>Patient No.</th>
                            <th>Last Name</th>
                            <th>Middle Name</th>
                            <th>First Name</th>
                            <th>Birthdate</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM patient_tb");
                        while ($row = mysqli_fetch_array($data)) {
                            $birthdate = new DateTime($row['birthdate']);
                            $currentDate = new DateTime();
                            $ageInterval = $birthdate->diff($currentDate);
                            $age = $ageInterval->y;

                            echo "<tr>";
                            echo "<td>" . $row['patient_id'] . "</td>";
                            echo "<td>" . $row['lastName'] . "</td>";
                            echo "<td>" . $row['middleName'] . "</td>";
                            echo "<td>" . $row['firstName'] . "</td>";
                            echo "<td>" . $row['birthdate'] . "</td>";
                            echo "<td>" . $age . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td class='text-center'>";
                            echo "<div class='d-grid gap-2 d-sm-flex justify-content-sm-center'>";
                            echo "<button type='button' class='btn btn-primary edit-btn' data-bs-toggle='modal' data-bs-target='#addRecord' data-patient-id='" . $row['patient_id'] . "'>Edit</button>";
                            echo "<button type='button' onclick='deleteStocks(" . $row['patient_id'] . ")' class='btn btn-danger' data-bs-toggle='modal' data-bs-request-id='" . $row['patient_id'] . "'>Delete</button>";
                            echo "<button style='background-color: green;' type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#detailsmodal' data-patient-id='" . $row['patient_id'] . "'>Details</button>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Add Record Modal -->
    <div class="modal fade" id="addRecord" tabindex="-1" aria-labelledby="addRecordLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecordLabel">Patient Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="add_record.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="patient_id" name="patient_id" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                        <div class="mb-3">
                            <label for="middleName" class="form-label">Middle Name:</label>
                            <input type="middleName" class="form-control" id="middleName" name="middleName" required>
                        </div>
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Birthdate:</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="age" class="form-label">Age:</label> -->
                            <input type="hidden" class="form-control" id="age" name="age" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="service" class="form-label">Service:</label>
                            <select name="service" id="service" class="form-control" required>
                                <option value="">Please Select</option>
                                <?php
                                $servicesquery = "SELECT * FROM services_tb";
                                $servicesresult = mysqli_query($conn, $servicesquery);
                                while ($servicerow = $servicesresult->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $servicerow['service_id']; ?>"><?php echo $servicerow['service_name']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="AddPatientRecord" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="detailsmodal" tabindex="-1" aria-labelledby="detailRecordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" id="modal-body_post">

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
    });

    function deleteStocks(id) {
        if (confirm("Are you sure you want to delete this Product?")) {
            window.location.href = "add_record.php?action=delete&id=" + id;
        }
    }
</script>

<script>
    $(document).ready(function () {
        $('#list').change(function () {
            var selected = $(this).val();
            $.get("change_query.php?selected=" + selected, function (data) {
                $('.result').html(data);
            });
        });

        $('#addRecord').on('hidden.bs.modal', function () {
            $('#patient_id').val('');
            $('#patientId').val('');
            $('#lastName').val('');
            $('#middleName').val('');
            $('#firstName').val('');
            $('#birthdate').val('');
            $('#age').val('');
            $('#address').val('');
            $('#phone').val('');
        });

        $('.edit-btn').click(function () {
            var patientId = $(this).data('patient-id');

            $.ajax({
                url: './edit_patients_record.php',
                type: 'post',
                data: {
                    patientId: patientId
                },
                dataType: 'json',
                success: function (response) {
                    $('#patient_id').val(response.patient_id);
                    $('#lastName').val(response.lastName);
                    $('#middleName').val(response.middleName);
                    $('#firstName').val(response.firstName);
                    $('#birthdate').val(response.birthdate);
                    $('#age').val(response.age);
                    $('#address').val(response.address);
                    $('#phone').val(response.phone);
                }
            });
        });

        $('#detailsmodal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var requestId = button.data('patient-id');

            $.ajax({
                type: 'POST',
                url: './details.php',
                data: {
                    requestId: requestId
                },
                success: function (response) {
                    $('#modal-body_post').html(response);
                },
                error: function (xhr, status, error) {
                    // Handle the error scenario
                    console.log(error);
                }
            });
        });
    });
</script>
<style>
    .text-center .d-grid {
        align-items: center;
    }
</style>

</html>