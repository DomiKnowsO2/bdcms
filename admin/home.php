<!DOCTYPE html>
<html lang="en">


<body>
    <div class="col py-1">
        <div class="container-fluid bg-light">
            <div class="col py-1">
                <div>
                    <h4 style="text-align:center">Scheduled Appointment</h4>
                </div>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Appointment Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM requests_tb WHERE `status` = 'Approve'");
                        while ($row = mysqli_fetch_array($data)) {
                            echo "<tr>";
                            echo "<td>" . $row['request_id'] . "</td>";
                            echo "<td>" . $row['lastName'] . "</td>";
                            echo "<td>" . $row['firstName'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['appointment_date'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
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


</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>

<!-- <script>
    $(document).ready(function () {
        $('#list').change(function () {
            var selected = $(this).val();
            $.get("change_query.php?selected=" + selected, function (data) {
                $('.result').html(data);
            });
        });
    });
</script> -->

</html>