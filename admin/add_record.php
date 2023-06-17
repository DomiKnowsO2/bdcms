<?php
include('../db-connect.php');

// $id = $_POST['requestId'];

$query = "SELECT status FROM requests_tb WHERE request_id = $id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $currentStatus = $row['status'];
} else {
    // Handle the scenario when the query doesn't return any results or an error occurs
    $currentStatus = '';
}


?>