<?php
// get_date.php
include('./db-connect.php');

$targetDate = $_GET['date'];

$sql = "SELECT * FROM noappointment_tb WHERE date = '$targetDate'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Target date exists in the database
  $response = true;
} else {
  // Target date does not exist in the database
  $response = false;
}

header('Content-Type: application/json');
echo json_encode($response);
?>
