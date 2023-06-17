<!DOCTYPE html>
<html lang="en">
    <?php 
    session_start();
    include '../db-connect.php';
    include 'header/header.php';
    ?>
    
<body>

    <?php include 'includes/navbar.php'; ?>
        <div class="col py-1">
            <div class="container-fluid bg-light">
                <div class="col py-1">
                    <div><h4 style="text-align:center">Requests</h4></div>
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>No. of Guests</th>
                                <th>Facility</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Arrival Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                            $data = mysqli_query($conn, "SELECT * FROM tblrequests where status='Pending'");
                            while($row = mysqli_fetch_array($data)){
                                echo "<tr>";
                                echo "<td>". $row['title'] ."</td>";
                                echo "<td>". $row['description'] ."</td>";
                                echo "<td>". $row['guests'] ."</td>";
                                echo "<td>". $row['facility'] ."</td>";
                                echo "<td>". $row['email'] ."</td>";
                                echo "<td>". $row['phone'] ."</td>";
                                echo "<td>". $row['start_datetime'] ."</td>";
                                echo "<td>". $row['end_datetime'] ."</td>";
                                echo "<td>". $row['status'] ."</td>";
                                echo "<td>". $row['arrival_time'] ."</td>";
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
                    <a href='../auto_delete.php' type='button' class='btn btn-primary'>Delete Requests</a>
                    <a href='../algo.php' type='button' class='btn btn-primary'>Run</a>
                </div>
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

</html>