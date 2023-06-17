<?php
require_once('db-connect.php');
include ('trap_schedcon.php');

$queue = new SplQueue(); //for FCFS
$priorityQueue = new SplPriorityQueue(); //for Priority Scheduling

$query = 'SELECT * FROM `tblrequests` WHERE `designation`="Student" or `designation`="Guest" or `designation`="Employee"  GROUP BY `facility`,`start_datetime`,`end_datetime`';
$sql = $conn->query($query);


if ($sql->num_rows > 0)
{
    $data = array();
    $data2 = array();
    foreach ($sql->fetch_all(MYSQLI_ASSOC) as $row)
    {
        $data[] = $row['designation'];
        $data2[] = $row['arrival_time'];


        if ($row['priority_level'] > 0){
            // for Priority Scheduling
            $priorityQueue->insert($row, $row['priority_level']);

        }
        else {
            //for FCFS
            $queue->enqueue($row);
        }
    }
    $string = implode(',', $data);
    $string2 = implode(',', $data2);

    // Priority Scheduling
    while (!$priorityQueue->isEmpty()) {
        $pRequest = $priorityQueue->extract();

        $query2 = "SELECT * FROM schedule_list";
        $appSched = $conn->query($query2);
        $availability = trapSchedCon($appSched, $pRequest);


        if ($availability == true){
            $facility = $pRequest['facility'];
            $start = $pRequest['end_datetime'];
            $sql11 = "SELECT * FROM `schedule_list` WHERE facility ='$facility' and start_datetime='$start' ";
            $cks = $conn->query($sql11);
            if ($cks->num_rows>=1)
            {
                  $status = "Rejected";
                $sql = "INSERT INTO `tblrejected` (`request_id`, `title`, `designation`, `type_of_event`, `guests`, `facility`, `description`, `email`, `phone`, `start_datetime`, `end_datetime`, `arrival_time`,`status`) VALUES ('$pRequest[request_id]','$pRequest[title]','$pRequest[designation]','$pRequest[type_of_event]','$pRequest[guests]','$pRequest[facility]','$pRequest[description]','$pRequest[email]','$pRequest[phone]','$pRequest[start_datetime]','$pRequest[end_datetime]','$pRequest[arrival_time]','$status')";
                $save = $conn->query($sql);
                $que = "UPDATE tblrequests SET `status` = 'Rejected' WHERE request_id = $pRequest[request_id]";
                $conn->query($que);
            }
            else{
              $status = "Approved";
            $sql = "INSERT INTO `schedule_list` (`id`, `title`, `designation`, `type_of_event`, `guests`, `facility`, `description`, `email`, `phone`, `start_datetime`, `end_datetime`, `status`) VALUES ('$pRequest[request_id]','$pRequest[title]','$pRequest[designation]','$pRequest[type_of_event]','$pRequest[guests]','$pRequest[facility]','$pRequest[description]','$pRequest[email]','$pRequest[phone]','$pRequest[start_datetime]','$pRequest[end_datetime]','$status')";
            $save = $conn->query($sql);
            if ($string == "Employee") {

                if ($save) {
                    $que = "UPDATE tblrequests SET `status` = 'Approved' WHERE request_id = $pRequest[request_id]";
                    $conn->query($que);
                }
            }
        }
        }
        else
        {
            // $status = "Rejected";
            // $sql = "INSERT INTO `tblrejected` (`request_id`, `title`, `designation`, `type_of_event`, `guests`, `facility`, `description`, `email`, `phone`, `start_datetime`, `end_datetime`, `arrival_time`,`status`) VALUES ('$pRequest[request_id]','$pRequest[title]','$pRequest[designation]','$pRequest[type_of_event]','$pRequest[guests]','$pRequest[facility]','$pRequest[description]','$pRequest[email]','$pRequest[phone]','$pRequest[start_datetime]','$pRequest[end_datetime]','$pRequest[arrival_time]','$status')";
            // $save = $conn->query($sql);
            // $que = "UPDATE tblrequests SET `status` = 'Rejected' WHERE request_id = $pRequest[request_id]";
            // $conn->query($que);
        }
    }

    // FCFS
    while (!$queue->isEmpty()) {
        $request = $queue->dequeue();
        $query2 = "SELECT * FROM schedule_list";
        $appSched = $conn->query($query2);
        $availability = trapSchedCon($appSched, $request);
        // if($string2 < currentTime){
        

        if ($availability == true)
        {
            $facility = $request['facility'];
            $start = $request['end_datetime'];
            $sql11 = "SELECT * FROM `schedule_list` WHERE facility ='$facility' and start_datetime='$start' ";
            $cks = $conn->query($sql11);
            if ($cks->num_rows>=1)
            {
                $status = "Rejected";
                $sql = "INSERT INTO `tblrejected` (`request_id`, `title`, `designation`, `type_of_event`, `guests`, `facility`, `description`, `email`, `phone`, `start_datetime`, `end_datetime`, `arrival_time`,`status`) VALUES ('$request[request_id]','$request[title]','$request[designation]','$request[type_of_event]','$request[guests]','$request[facility]','$request[description]','$request[email]','$request[phone]','$request[start_datetime]','$request[end_datetime]','$request[arrival_time]','$status')";
                $save = $conn->query($sql);
                $que = "UPDATE tblrequests SET `status` = 'Rejected' WHERE request_id = $request[request_id]";
                $conn->query($que);
            }else{
                echo '<script>';
               echo 'alert("wala")';
               echo '</script>';
                $status = "Approved";
                $sql = "INSERT INTO `schedule_list` (`id`, `title`, `designation`, `type_of_event`, `guests`, `facility`, `description`, `email`, `phone`, `start_datetime`, `end_datetime`, `status`) VALUES ('$request[request_id]','$request[title]','$request[designation]','$request[type_of_event]','$request[guests]','$request[facility]','$request[description]','$request[email]','$request[phone]','$request[start_datetime]','$request[end_datetime]','$status')";
                $save = $conn->query($sql);

                if($save){
                    $que = "UPDATE tblrequests SET `status` = 'Approved' WHERE request_id = $request[request_id]";
                    $conn->query($que);
                }
            }


          
        }

    // }
    }

}else{
    echo "0 request";
}
header('Location: admin/requests.php');
$conn->close();
?>