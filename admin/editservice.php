<?php
include('../db-connect.php');

$id = $_POST['requestId'];

$query = "SELECT * FROM services_tb WHERE service_id = $id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $serviceId = $row['service_id'];
    $serviceName = $row['service_name'];
    $servicePrice = $row['service_price'];
} else {
    // Handle the scenario when the query doesn't return any results or an error occurs
    $serviceId = '';
    $serviceName = '';
    $servicePrice = '';
}
?>

<div class="modal-header">
    <h5 class="modal-title" id="addRecordLabel">Edit Services</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="./index.php?page=services" method="post">
    <div class="modal-body">
        <div class="mb-3">
            <input type="hidden" name="serviceid" value="<?php echo $serviceId; ?>">
            <label for="ServiceName" class="form-label">Service Name:</label>
            <input type="text" class="form-control" id="ServiceName" name="ServiceName" value="<?php echo $serviceName; ?>" required>
        </div>
        <div class="mb-3">
            <label for="ServicePrice" class="form-label">Service Price:</label>
            <input type="text" class="form-control" id="ServicePrice" name="ServicePrice" value="<?php echo $servicePrice; ?>" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="Savechanges">Save changes</button>
    </div>
</form>
