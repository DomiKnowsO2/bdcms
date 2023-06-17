<?php
require_once('db-connect.php');

if (isset($_POST['submit'])) {

   $fname = mysqli_real_escape_string($conn, $_POST['fname']);
   $lname = mysqli_real_escape_string($conn, $_POST['lname']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $date = $_POST['date'];
   $status = "Pending";

   $insert = mysqli_query($conn, "INSERT INTO `requests_tb`(firstName, lastName, address, email, phone, appointment_date, status) VALUES('$fname','$lname','$address','$email','$number','$date','$status')") or die('query failed');

   if ($insert) {
      echo "<script> alert ('Appointment made successfully!'); location.replace('./') </script>";
   } else {
      echo "<script> alert('Appointment Failed!'); history.go(-1); </script>";
   }

}
$conn->close();

?>