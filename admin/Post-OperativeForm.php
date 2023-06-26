<?php
include('../db-connect.php');

$id = $_POST['requestId'];

$query = "SELECT * FROM requests_tb WHERE request_id = $id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $currentStatus = $row['status'];
    $currentRequestId = $row['request_id'];
    $currentPatientId = $row['patient_id'];
    $currentServiceId = $row['service_id'];
    $currentFirstName = $row['firstName'];
    $currentMiddleName = $row['middleName'];
    $currentLastName = $row['lastName'];
    $currentAddress = $row['address'];
    $currentEmail = $row['email'];
    $currentPhone = $row['phone'];
    $currentAppointmentDate = $row['appointment_date'];
    $formattedAppointmentDate = date("F-d-Y", strtotime($currentAppointmentDate));
    $formattedTime = date("h:ia", strtotime($currentAppointmentDate));
    $patientQuery = "SELECT birthdate FROM patient_tb WHERE patient_id = $currentPatientId";
    $patientResult = mysqli_query($conn, $patientQuery);
    $patientRow = mysqli_fetch_assoc($patientResult);
    $patientBirthdate = $patientRow['birthdate'];

    $serviceQuery = "SELECT * FROM services_tb WHERE service_id = $currentServiceId";
    $serviceResult = mysqli_query($conn, $serviceQuery);
    $serviceRow = mysqli_fetch_assoc($serviceResult);
    $service_name = $serviceRow['service_name'];
    $service_price = $serviceRow['service_price'];
} else {
    // Handle the scenario when the query doesn't return any results or an error occurs
    $currentStatus = '';
}

?>

<form action="history.php" method="post">
    <div class="modal-header">
        <h5 class="modal-title" id="changeStatusModalLabel">Post-Operative Care Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <input type="hidden" name="request_id" value='<?php echo $currentRequestId; ?>'>
        <input type="hidden" name="patient_id" value='<?php echo $currentPatientId; ?>'>
        <input type="hidden" name="service_id" value='<?php echo $currentPatientId; ?>'>
        <input type="hidden" name="appointment_date" value='<?php echo $currentAppointmentDate; ?>'>
        <input type="hidden" id="statusSelect" name="statusSelect" value='Done'
            placeholder="<?php echo $currentStatus; ?>">
        <textarea name="careForm" id="careForm" cols="30" rows="22" class="form-control">
Patient Information:
Full Name: <?php echo $currentFirstName . " " . $currentMiddleName . " " . $currentLastName; ?>

Date of Birth: <?php echo $patientBirthdate; ?>

Contact Number: <?php echo $currentPhone; ?>


Procedure Information:
Procedure Name: <?php echo $service_name; ?>

Date of Procedure: <?php echo $formattedAppointmentDate . " " . $formattedTime; ?>

Dentist: Dr. Ricardo P. Enciso

Post-Operative Care Instructions:
____________________________

Vital Signs and Observations:
____________________________

Comments for the Doctor:
____________________________

Total Payment: <?php echo "₱" . $service_price; ?>


Follow-Up Appointment:
Date: _________________________________
Time: _________________________________
        </textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="history">Save changes</button>
    </div>
</form>