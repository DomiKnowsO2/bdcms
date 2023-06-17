<?php 
require_once('db-connect.php');
if($_SERVER['REQUEST_METHOD'] !='POST'){
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}
extract($_POST);
$allday = isset($allday);

if($end_datetime>$start_datetime){
    if($designation == "Employee" && $typeOfEvent == "Meeting"){
        $priorityLevel = 1;
    }
    elseif($designation == "Employee" && $typeOfEvent == "Seminar/Training/Workshop"){
        $priorityLevel = 2;
    }
    elseif($designation == "Employee" && $typeOfEvent == "Celebrations"){
        $priorityLevel = 3;
    }
    else{
        $priorityLevel = 0;
    }

        $sql = "INSERT INTO `tblrequests` (`request_id`, `title`, `designation`, `type_of_event`, `guests`, `facility`, `description`, `email`, `phone`, `start_datetime`, `end_datetime`, `priority_level`, `status`) VALUES ('','$title','$designation','$typeOfEvent','$capacity','$facility','$description','$email','$phone','$start_datetime','$end_datetime','$priorityLevel','$status')";
        $save = $conn->query($sql);
        if($save){
            echo "<script> alert('Schedule request has been successfully submitted for Approval'); location.replace('./') </script>";
        }else{
            echo "<pre>";
            echo "An Error occured.<br>";
            echo "Error: ".$conn->error."<br>";
            echo "SQL: ".$sql."<br>";
            echo "</pre>";
        }
}else{
    echo "<script> alert('Invalid date and time!'); history.go(-1);</script>";
}
$conn->close();
?>