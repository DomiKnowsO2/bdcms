<?php
// get_time_options.php
include('./db-connect.php');

$targetDate = $_GET['date'];

// Test: Display the value of formattedDate
// echo "Formatted Date: ";

// $targetDate =2023-06-30;
 
$sql = "SELECT TIME(appointment_date) AS time_only FROM requests_tb WHERE DATE(appointment_date) = '$targetDate'";
$result = $conn->query($sql);
$reservedTimeSlots = array();  

if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
      $time = $row['time_only'];
      $reservedTimeSlots[] = $time;
   }
} else {
   $reservedTimeSlots = array(); // Set empty array if there are no matching records
}

// Create an associative array with the reservd etime slots
// $response = array('reservedTimeSlots' => $reservedTimeSlots);

header('Content-Type: application/json');
echo json_encode($reservedTimeSlots);

// header('Content-Type: application/json');
// echo json_encode($targetDate);
// echo json_encode($reservedTimeSlots);
?> 