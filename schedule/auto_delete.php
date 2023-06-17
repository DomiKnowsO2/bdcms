<?php
require_once('db-connect.php');

$sql = "DELETE FROM tblrequests where status='Rejected'";
$conn->query($sql);

header('Location: admin/requests.php');
$conn->close();
?>