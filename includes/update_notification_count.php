<?php
// update_notification_count.php

session_start();
include('../db-connect.php');

if (isset($_POST['patient_id'])) {
   $patient_id = $_POST['patient_id'];

   // Update the count column to 1 for the given patient_id
   $update_query = "UPDATE notification_tb SET count = 1 WHERE patient_id = '$patient_id'";
   $update_result = mysqli_query($conn, $update_query);

   if ($update_result) {
      // Return a success response if the update was successful
      echo "Count updated successfully";
   } else {
      // Return an error response if the update failed
      echo "Count update failed";
   }
} else {
   // Return an error response if the patient_id parameter is not set
   echo "Invalid request";
}
?>
