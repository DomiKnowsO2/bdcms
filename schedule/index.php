<?php require_once('db-connect.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduling</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-family: Arial, Helvetica, sans-serif, cursive;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
        .dropdown {
            float: left;
            overflow: hidden;
        }

        .dropdown .dropbtn {
            font-size: 16px;  
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        .dropdown:hover .dropbtn {
            background-color: blue;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient" id="topNavBar">
        <div class="container">
            <a class="navbar-brand" href="https://cspc.edu.ph/">
            <img src="https://cspc.edu.ph/wp-content/uploads/2022/03/Camarines_Sur_Polytechnic_Colleges_Logo.png" alt="" width="40" height="40">
            CSPC Homepage
            </a>

            <div>
                <b class="text-light">CSPC Facilities Scheduler</b>
            </div>
            <!--<div class="dropdown">
                <button class="dropbtn">More 
                <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                <a href="">Link 1</a>
                <a href="">Link 2</a>
                <a href="">Link 3</a>
                </div>
            </div> 
            <div>
                <a class="text-light" href="./facilities.php">View Facilities</a>
            </div>-->
            
        </div>
    </nav>
    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h5 class="card-title">Schedule Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="save_schedule.php" method="post" id="schedule-form">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Title</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                </div>
                                <div class="form-group mb-2">
                                    <select class="form-select" name="designation" id="designation" required>
                                    <option value=""selected disabled hidden>User Selection</option>
                                    <option value="Employee">Employee</option>
                                    <option value="Student">Student</option>
                                    <option value="Guest">Guest</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <select class="form-select" name="typeOfEvent" id="typeOfEvent" required>
                                    <option value=""selected disabled hidden>Type of Event</option>
                                    <option value="Meeting">Meeting</option>
                                    <option value="Seminar/Training/Workshop">Seminar/Training/Workshop</option>
                                    <option value="Celebrations">Celebrations(Birthday/Wedding/Party/etc.)</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="capacity">No. of Guests</label>
                                    <input type="number" id="capacity" name="capacity" min="1" max="5000" onkeyup="keyupFunction()" required>
                                </div>
                                <br>
                                <div class="form-group mb-2">
                                    <select class="form-select" name="facility" id="facility" required>
                                    <option value=""selected disabled hidden>Select Facility</option>
                                    <option value="Gymnasium">Gymnasium (5000 max capacity)</option>
                                    <option value="Auditorium">Auditorium (500 max capacity)</option>
                                    <option value="Lecture hall">Lecture hall (300 max capacity)</option>
                                    <option value="Function hall">Function hall (200 max capacity)</option>
                                    <option value="Audio-Visual Room">Audio-Visual Room (100 max capacity)</option>
                                    <option value="Mat Laboratory">Mat Laboratory (70 max capacity)</option>
                                    </select>
                                </div>
                                
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                </div>
                                          
                                <div class="form-group mb-2">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="email" class="form-control form-control-sm rounded-0" name="email" id="email" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="phone" class="control-label">Phone Number</label>
                                    <input type="tel" class="form-control form-control-sm rounded-0" placeholder="09123456789" id="phone" name="phone" pattern="[0-9]{11}" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Start</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label">End</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                    <input type="hidden" value="Pending" id="status" name="status">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                    <!--    <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button> -->
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->

<?php
$schedules = $conn->query("SELECT * FROM `tblrequests`");
$sched_res = [];
foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row)
{
    if( $row['status']=="Approved" and $row['designation']=="Employee")
    {
        $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
        $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
        $sched_res[$row['request_id']] = $row;
    }elseif($row['status']=="Approved" and $row['designation']=="Student"){
        $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
        $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
        $sched_res[$row['request_id']] = $row;
    }elseif($row['status']=="Approved" and $row['designation']=="Guest"){
        $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
        $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
        $sched_res[$row['request_id']] = $row;
    }
   
}
?>
<?php
if(isset($conn)) $conn->close();
?>
</body>

<script>
  function keyupFunction() {
    var op = [5000, 500, 300, 200, 100, 70];
    var inputValue = event.target.value;
    var select = document.getElementById("facility");
    for (i = 0; i < select.options.length; i++) {
      if (inputValue <= op[i-1]) {
        select.options[i].style.display = 'block';
      } else {
        select.options[i].style.display = 'none';
      }
    }
  }
</script>
<!--
<script>
    capacity.oninput = changeInput;
    function changeInput(){
        guests.innerText = capacity.value;
    }
    //document.getElementById("nog").innerHTML = getvalue;

    /*getvalue.addEventListener('input', function(){
        document.getElementById("facility").innerHTML=this.value;
    });*/
</script>

<script>
    $('input[type=number]').click(function(e) {
		
        var text = $(this).val(); 
        $('.result').html(text);
		
    });
	
</script>
-->
<script>
    var scheds = jQuery.parseJSON('<?= json_encode($sched_res) ?>')
</script>
<script src="./js/script.js"></script>

</html>