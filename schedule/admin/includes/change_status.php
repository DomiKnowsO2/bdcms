<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="update_status.php" method="POST">
          <select class="form-select" name="changeStatus" aria-label="Default select example">
          <option value="Pending" disabled selected>Pending</option>
          <option value="Approved">Approve</option>
          <option value="Cancelled">Cancel</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
  extract($_POST);
  $allday = isset($allday);
/*
    require('../db-connect.php');
    // When form submitted, insert values into the database.
    extract($_POST);
    $allday = isset($allday);
    if (isset($_REQUEST['submit'])) {
        $status = $_REQUEST['changeStatus'];
        $query = "UPDATE `schedule_list` SET `status`= '$status' WHERE id='$id'";
        $res = mysqli_query($conn, $query1);
        if (!$res){
          echo "<script> alert('error.'); location.replace('./') </script>";
        } else {
          echo "<script> alert('Status successfully saved.'); location.replace('./') </script>";
        }
    } else {
      echo "<script> alert('No data to save.'); location.replace('./') </script>";
    }
    $conn->close();
*/
?>