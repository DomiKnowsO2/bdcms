<?php
include('../db-connect.php');

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
	$id = $_GET['id'];

	$stmt = $conn->prepare("DELETE FROM `patient_tb` WHERE patient_id = ?");

	// Bind the parameters
	$stmt->bind_param("i", $id);

	// Execute the statement
	$stmt->execute();

	// Check if the update was successful
	if ($stmt->affected_rows > 0) {
		echo "Record Deleted successfully";
        header('location:./index.php?page=patients_record');
	} else {
		echo "Failed to Delete record";
        header('location:./index.php?page=patients_record');
	}

	// Close the statement
	$stmt->close();
}

if (isset($_POST['AddPatientRecord'])) {
    if (empty($_POST['patient_id'])) {
        echo "<div class='alert alert-danger'>Patient ID not found</div>";
        // Get form values
        $lastName = $_POST['lastName'];
        $middleName = $_POST['middleName'];
        $firstName = $_POST['firstName'];
        $birthdate = $_POST['birthdate'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $service = $_POST['service'];
        $status = "Approve";
        $date = date('Y-m-d H:i:s');
    
        $stmt = $conn->prepare("INSERT INTO `patient_tb`(`firstName`, `middleName`, `lastName`, `birthdate`, `address`, `phone`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstName, $middleName, $lastName, $birthdate, $address, $phone);
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            $patient_id = $conn->insert_id;
    
            $stmt2 = $conn->prepare("INSERT INTO `requests_tb` (patient_id, firstName, middleName, lastName, address, email, phone, service_id, appointment_date, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt2->bind_param("ssssssssss", $patient_id, $firstName, $middleName, $lastName, $address, $email, $phone, $service, $date, $status);
            $stmt2->execute();
    
            if ($stmt2->affected_rows > 0) {
                echo "Record added successfully";
                header('location: ./index.php?page=patients_record');
            } else {
                echo "Failed to add record";
                header('location: ./index.php?page=patients_record');
            }
    
            $stmt2->close();
        } else {
            echo "Failed to add record";
            header('location: ./index.php?page=patients_record');
        }
    
        $stmt->close();
    }   else {
        echo "<div class='alert alert-danger'>Patient ID found</div>";
        // Get form values
        $ID = $_POST['patient_id'];
        $lastName = $_POST['lastName'];
        $middleName = $_POST['middleName'];
        $firstName = $_POST['firstName'];
        $birthdate = $_POST['birthdate'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        $stmt = $conn->prepare("UPDATE `patient_tb` SET `firstName`=?, `middleName`=?, `lastName`=?, `birthdate`=?, `address`=?, `phone`=? WHERE `patient_id`=?");

        // Bind the parameters
        $stmt->bind_param("sssssss", $firstName, $middleName, $lastName, $birthdate, $address, $phone, $ID);

        // Execute the statement
        $stmt->execute();

        // Check if the insert was successful
        if ($stmt->affected_rows > 0) {
            echo "Record updated successfully";
            header('location: ./index.php?page=patients_record');
        } else {
            echo "Failed to update record";
            header('location: ./index.php?page=patients_record');
        }

        // Close the statement
        $stmt->close();
    }
}
