<?php
include('./db-connect.php');
$servicesquery = "SELECT * FROM services_tb";
$servicesresult = mysqli_query($conn, $servicesquery);

$serviceOptions = [];

while ($servicerow = $servicesresult->fetch_assoc()) {
    $serviceOptions[] = array(
        'value' => $servicerow['service_id'],
        'text' => $servicerow['service_name']
    );
}

header('Content-Type: application/json');
echo json_encode($serviceOptions);
