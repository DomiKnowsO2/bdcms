<?php
require_once('../db-connect.php');

if (isset($_POST['submit'])) {
    $patient_id = mysqli_real_escape_string($conn, $_POST['patient_id']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    // $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $status = "Approve";

    $insert = mysqli_query($conn, "INSERT INTO `requests_tb` (patient_id, firstName, middleName, lastName, address, phone, service_id, appointment_date, status) VALUES ('$patient_id', '$fname', '$mname', '$lname', '$address', '$number', '$service', '$date', '$status')") or die('Query failed');

    if ($insert) {
        header('location: ./index.php?page=patients_record');
    } else {
        header('location: ./index.php?page=patients_record');
    }
}

$conn->close();
?>
