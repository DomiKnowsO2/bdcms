<?php
include('../db-connect.php');

$id = $_POST['requestId'];

$query = "SELECT status FROM requests_tb WHERE request_id = $id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $currentStatus = $row['status'];
} else {
    // Handle the scenario when the query doesn't return any results or an error occurs
    $currentStatus = '';
}


?>

<form action="patients_record.php" method="post">
    <div class="modal-header">
        <h5 class="modal-title" id="changeStatusModalLabel">Change Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <input type="hidden" name="request_id" value='<?php echo $id; ?>'>
        <label for="statusSelect">Select Status:</label>
        <select id="statusSelect" name="statusSelect" class="form-select">
            <?php
            $statuses = array('Pending', 'Approve', 'Reject');
            foreach ($statuses as $status) {
                $selected = ($status == $currentStatus) ? 'selected' : '';
                echo "<option value='$status' $selected>$status</option>";
            }
            ?>
        </select>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="Savechanges">Save changes</button>
    </div>
</form>