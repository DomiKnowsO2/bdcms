<?php
$targetDate = $_POST['formattedDate'];

// Query the database
$sql = "SELECT TIME(appointment_date) AS time_only FROM requests_tb WHERE DATE(appointment_date) = '$targetDate'";
$result = $conn->query($sql);

$reservedTimeSlots = array(); // Initialize an empty array

if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
      $time = $row['time_only'];
      $reservedTimeSlots[] = $time; // Add the time value to the array
   }
}

echo json_encode($reservedTimeSlots);
?>
