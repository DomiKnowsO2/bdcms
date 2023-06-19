<?php
include('../db-connect.php');
$id = $_POST['patientId'];

// Prepare the SQL statement to fetch item details
$stmt = $conn->prepare("SELECT * FROM patient_tb WHERE patient_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Prepare the JSON response
    $response = array(
        'patient_id' => $row['patient_id'],
        'firstName' => $row['firstName'],
        'middleName' => $row['middleName'],
        'lastName' => $row['lastName'],
        'birthdate' => $row['birthdate'],
        'age' => calculateAge($row['birthdate']), // Assuming you have a function to calculate age
        'address' => $row['address'],
        'phone' => $row['phone']
    );

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If no matching record is found
    $response = array(
        'error' => 'No record found'
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Function to calculate age based on birthdate
function calculateAge($birthdate) {
    $birthdateObj = new DateTime($birthdate);
    $currentDateObj = new DateTime();
    $interval = $birthdateObj->diff($currentDateObj);
    return $interval->y;
}
