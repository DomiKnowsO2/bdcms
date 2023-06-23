<?php
include('../db-connect.php');

$id = $_POST['requestId'];

$query = "SELECT * FROM patient_tb WHERE patient_id = '$id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $patient_id = $row['patient_id'];
    $firstName = $row['firstName'];
    $middleName = $row['middleName'];
    $lastName = $row['lastName'];
    $birthdate = $row['birthdate'];
    $address = $row['address'];
    $phone = $row['phone'];
}
?>

<div class="modal-header">
    <h5 class="modal-title" id="detailRecordLabel">Care Form</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="save_appointment.php" method="post">
    <div class="modal-body">
        <input type="datetime-local" id="myDatePicker" name="date" class="form-control" required>

        <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>" class="form-control" required>

        <div class="mb-3">
            <label class="form-label" class="form-label">First name :</label>
            <input type="text" name="fname" value="<?php echo $firstName; ?>" placeholder="Enter your Firstname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Middle name :</label>
            <input type="text" name="mname" value="<?php echo $middleName; ?>" placeholder="Enter your Middlename" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Last name :</label>
            <input type="text" name="lname" value="<?php echo $lastName; ?>" placeholder="Enter your Lastname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Birth Date :</label>
            <input type="date" name="birthdate" value="<?php echo $birthdate; ?>" placeholder="Enter your birthdate" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Address :</label>
            <input type="text" name="address" value="<?php echo $address; ?>" placeholder="Enter your Address" class="form-control" required>
        </div>
        <div class="mb-3">
            <!-- <label class="form-label">your email :</label>
        <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter your Email" class="form-control" required> -->
        </div>
        <div class="mb-3">
            <label class="form-label">your number :</label>
            <input type="text" name="number" value="<?php echo $phone; ?>" placeholder="Enter your Phone Number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="service">Service:</label>
            <select name="service" id="service" class="form-control" required>
                <option value="">Please Select</option>
                <?php
                $servicesquery = "SELECT * FROM services_tb";
                $servicesresult = mysqli_query($conn, $servicesquery);
                while ($servicerow = $servicesresult->fetch_assoc()) :
                ?>
                    <option value="<?php echo $servicerow['service_id']; ?>"><?php echo $servicerow['service_name']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" value="Add" name="submit" class="btn btn-primary">New Record</button>
    </div>
</form>
<script>
    // Set current date and time in the date field
    // Set current date and time in the date field
    var today = new Date();
    var year = today.getFullYear();
    var month = String(today.getMonth() + 1).padStart(2, '0');
    var day = String(today.getDate()).padStart(2, '0');
    var hours = String(today.getHours()).padStart(2, '0');
    var minutes = String(today.getMinutes()).padStart(2, '0');
    var dateString = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
    document.getElementById("myDatePicker").value = dateString;

    document.getElementById("myDatePicker").value = dateString;
</script>