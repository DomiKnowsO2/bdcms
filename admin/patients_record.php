<!DOCTYPE html>
<html lang="en">

<body>
    <div class="col py-1">
        <div class="container-fluid bg-light">
            <div class="col py-1">
                <div>
                    <h4 style="text-align:center">Patients Record</h4>
                </div>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <?php echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#addRecord'> Add </button>"; ?>
                        </tr>
                        <tr>
                            <th>Patient No.</th>
                            <th>Last Name</th>
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
                            echo "<td>" . $row['firstName'] . "</td>";
                            echo "<td>" . $row['birthdate'] . "</td>";
                            echo "<td>" . $age . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>";
                            echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#addRecord' data-bs-request-id='" . $row['patient_id'] . "'>Edit</button> ";
                            echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#addRecord' data-bs-request-id='" . $row['patient_id'] . "'>Delete</button>";
                            echo "</td>";
                            /*echo "<td>";
                            echo "<a href='change_status.php?id=".$row['id']."' type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>Change";
                            echo "</a>";
                            echo "</td>";
                            echo "<td>";
                            echo "<a href='delete_schedule.php?id=".$row['id']."' type='button' class='btn btn-primary'>Delete";
                            echo "</a>";
                            echo "</td>";*/
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
                    <h5 class="modal-title" id="addRecordLabel">Add Patient Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add_record.php" method="post">
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
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
                            <label for="age" class="form-label">Age:</label>
                            <input type="number" class="form-control" id="age" name="age" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
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
    });
</script>

<script>
    $(document).ready(function () {
        $('#list').change(function () {
            var selected = $(this).val();
            $.get("change_query.php?selected=" + selected, function (data) {
                $('.result').html(data);
            });
        });
    });
</script>

</html>