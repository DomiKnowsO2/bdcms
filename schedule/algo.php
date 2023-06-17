<?php 
require_once('db-connect.php');
include ('trap_schedcon.php');
 $Semployee_counter = "";
  $employee_counter = "";
  $Gemployee_counter = "";
$queue = new SplQueue(); //for FCFS
$priorityQueue = new SplPriorityQueue(); //for Priority Scheduling

$sql = mysqli_query($conn,"SELECT `request_id`,`designation`,`start_datetime`,`status`,`facility`,`arrival_time`,COUNT(`request_id`) as number FROM tblrequests  where status= 'Pending' GROUP BY `designation`, `facility`,`start_datetime`");
while ($row = mysqli_fetch_array($sql))
{
      $designation1 =  $row['designation'];
     $start_datetime =  $row['start_datetime'];
    if ($designation1 == "Student")
    {
        $Semployee_counter =  $row['number'];
        $etime = $row['arrival_time'];
        $stud_id = $row['request_id'];
    }elseif ($designation1=="Employee")
    {
        $employee_counter =  $row['number'];
        $stime = $row['arrival_time'];
        $emp_id = $row['request_id'];
    }
    elseif ($designation1=="Guest")
    {
        $Gemployee_counter =  $row['number'];
        $gtime = $row['arrival_time'];
        $Guest_id = $row['request_id'];
    }
    $facility =  $row['facility'];
    $status =  $row['status'];
     if (@$employee_counter>1 and $designation1=="Employee" and @$Semployee_counter == "" and @$Gemployee_counter=="")
     {
        $sql1 = mysqli_query($conn,"SELECT `designation`,`start_datetime`,`request_id`FROM tblrequests where status='Pending'  and designation='Employee' GROUP by start_datetime ,facility ;");
        while ($row1 = mysqli_fetch_array($sql1))
        {
            $designation =  $row1['designation'];
           
             $prior_id = $row1['request_id'];
            $update= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Approved' WHERE request_id='$prior_id'");
            if ($update==true)
            {
                $update1= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Rejected' WHERE status='Pending' and start_datetime='$start_datetime'and designation ='Employee' and facility ='$facility'");
                if ($update1==true)
                {
                    
                }
            }
        }
     }
      if (@$Semployee_counter>1 and $designation1=="Student" and @$Gemployee_counter == "" and @$employee_counter=="")
     {
        $sql1 = mysqli_query($conn,"SELECT `designation`,`start_datetime`,`request_id`FROM tblrequests where status='Pending'  and designation='Student' GROUP by start_datetime ,facility ;");
        while ($row1 = mysqli_fetch_array($sql1))
        {
            $designation =  $row1['designation'];
         
            echo $prior_id = $row1['request_id'];
            $update= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Approved' WHERE request_id='$prior_id'");
            if ($update==true)
            {
                $update1= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Rejected' WHERE status='Pending' and start_datetime='$start_datetime'and designation ='Student' and facility ='$facility'");
                if ($update1==true)
                {
                    
                }
            }
        }
     }
      if (@$Gemployee_counter>1 and $designation1=="Guest" and @$Semployee_counter == "" and @$employee_counter=="")
     {
        $sql1 = mysqli_query($conn,"SELECT `designation`,`start_datetime`,`request_id`FROM tblrequests where status='Pending'  and designation='Guest' GROUP by start_datetime ,facility ;");
        while ($row1 = mysqli_fetch_array($sql1))
        {
            $designation =  $row1['designation'];
           
             $prior_id = $row1['request_id'];
            $update= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Approved' WHERE request_id='$prior_id'");
            if ($update==true)
            {
                $update1= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Rejected' WHERE status='Pending' and start_datetime='$start_datetime'and designation ='Guest' and facility ='$facility'");
                if ($update1==true)
                {
                     
                }
            }
        }
     }
}
    
    if (@$emp_id<@$stud_id)
    {
        $update= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Approved' WHERE request_id='$emp_id'");
            if ($update==true)
            {
                $update1= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Rejected' WHERE status='Pending' and start_datetime='$start_datetime' and facility ='$facility'");
                if ($update1==true)
                {
                     
                }
            }
    }
    if (@$emp_id>@$stud_id and @$Guest_id>@$stud_id)
    {
        @$etime = new DateTime(@$etime);
        @$stime = new DateTime(@$stime);
        @$interval = @$etime->diff(@$stime);
        echo @$tims =  $interval->format('%h');
        if ($tims>=1)
        {
            $update= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Approved' WHERE request_id='$stud_id'");
            if ($update==true)
            {
                $update1= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Rejected' WHERE status='Pending' and start_datetime='$start_datetime'and facility ='$facility'");
                if ($update1==true)
                {
                    $update1= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Rejected' WHERE status='Pending' and start_datetime='$start_datetime' and facility ='$facility'");
                    if ($update1==true)
                    {
                       
                    }
                }
            }
        }else{
            $sql1ss = mysqli_query($conn,"SELECT `designation`,`start_datetime`,`request_id`FROM tblrequests where status='Pending' GROUP by start_datetime ,facility ;");
            while ($row1 = mysqli_fetch_array($sql1ss))
            {
                $designation =  $row1['designation'];
             
                echo $prior_id = $row1['request_id'];
                $update= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Approved' WHERE request_id='$emp_id'");
                if ($update==true)
                {
                    $update1= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Rejected' WHERE status='Pending' and start_datetime='$start_datetime'and facility ='$facility'");
                    if ($update1==true)
                    {
                        
                    }
                }
            }
        }
    }
    if (@$emp_id>@$Guest_id and @$stud_id>@$Guest_id)
    {
        @$etime = new DateTime(@$etime);
        @$gtime = new DateTime(@$stime);
        @$interval = @$etime->diff(@$gtime);
        echo @$tims =  $interval->format('%h');
        if ($tims>=1)
        {
            $update= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Approved' WHERE request_id='$Guest_id'");
            if ($update==true)
            {
                $update1= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Rejected' WHERE status='Pending' and start_datetime='$start_datetime' and facility ='$facility'");
                if ($update1==true)
                {
                    $update1= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Rejected' WHERE status='Pending' and start_datetime='$start_datetime' and facility ='$facility'");
                    if ($update1==true)
                    {
                        
                    }
                }
            }
        }else{
            $sql1ss = mysqli_query($conn,"SELECT `designation`,`start_datetime`,`request_id`FROM tblrequests where status='Pending' GROUP by start_datetime ,facility ;");
            while ($row1 = mysqli_fetch_array($sql1ss))
            {
                $designation =  $row1['designation'];
             
                echo $prior_id = $row1['request_id'];
                $update= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Approved' WHERE request_id='$emp_id'");
                if ($update==true)
                {
                    $update1= mysqli_query($conn,"UPDATE `tblrequests` SET `status`='Rejected' WHERE status='Pending' and start_datetime='$start_datetime'and facility ='$facility'");
                    if ($update1==true)
                    {
                       
                    }
                }
            }
        }

    }
header('Location: admin/requests.php');
 

