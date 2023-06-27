<?php
// get_time_options.php
include('./db-connect.php');

$targetDate = $_POST['targetDate']; 
 
$sql = "SELECT TIME(appointment_date) AS time_only FROM requests_tb WHERE DATE(appointment_date) = '$targetDate'";
$result = $conn->query($sql);

$reservedTimeSlots = array();  

if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
      $time = $row['time_only'];
      $reservedTimeSlots[] = $time;
   }
} else {
   echo "No matching records found.";
}

$conn->close();

echo json_encode($reservedTimeSlots);
?>
