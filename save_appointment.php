<?php
require_once('db-connect.php');

if (isset($_POST['submit'])) {
    $patient_id = mysqli_real_escape_string($conn, $_POST['patient_id']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    $date = mysqli_real_escape_string($conn, $_POST['date']." ". $_POST['time']);
    $status = "Pending";

    $insert = mysqli_query($conn, "INSERT INTO `requests_tb` (patient_id, firstName, middleName, lastName, address, email, phone, service_id, appointment_date, status) VALUES ('$patient_id', '$fname', '$mname', '$lname', '$address', '$email', '$number', '$service', '$date', '$status')") or die('Query failed');

    $update = mysqli_query($conn, "UPDATE `patient_tb` SET `firstName` = '$fname', `middleName` = '$mname', `lastName` = '$lname',`birthdate`='$birthdate', `address` = '$address', `phone` = '$number' WHERE `patient_id` = '$patient_id'") or die('Query failed');

    echo $date;
    if ($insert && $update) {
        echo "<script> alert('Appointment made successfully!'); location.replace('./user1.php'); </script>";
    } else {
        echo "<script> alert('Appointment Failed!'); history.go(-1); </script>";
    }
}

$conn->close();
?>