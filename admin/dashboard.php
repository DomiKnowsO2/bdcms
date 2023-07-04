<!DOCTYPE html>
<html lang="en">
<style>
    <?php
    include("./admin.css");
    ?>
</style>

<head>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./calendar/evo-calendar/css/evo-calendar.min.css">
    <link rel="stylesheet" type="text/css" href="./calendar/evo-calendar/css/evo-calendar.midnight-blue.min.css">

    <link rel="stylesheet" href="./calendar/evo-calendar/css/evo-calendar.royal-navy.min.css">
    <link rel="stylesheet" type="text/css" href="./calendar/demo/demo.css">
    <link rel="stylesheet" href="admin.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Mono&display=swap" rel="stylesheet">
</head>

<body>
    <div class="col py-1 margin">

        <div class="row">
            <!-- sale card start -->

            <div class="col-md-3">
                <div class="card text-center order-visitor-card">
                    <div class="card-block">
                        <h6 class="m-b-0">Appointments</h6>
                        <h4 class="m-t-15 m-b-15"><i class="fas fa-calendar-alt"></i>
                            <?php
                            $sql_accepted = "SELECT COUNT(*) AS accepted_count FROM requests_tb WHERE Status = 'Approve'"; //AND DATE(appointment_date) = CURDATE();
                            $result_accepted = $conn->query($sql_accepted);
                            $row_accepted = $result_accepted->fetch_assoc();
                            echo $row_accepted['accepted_count'];
                            ?>
                        </h4>
                        <p class="m-b-0"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center order-visitor-card">
                    <div class="card-block">
                        <h6 class="m-b-0">Pending Requests</h6>
                        <h4 class="m-t-15 m-b-15"><i class="fas fa-clock m-r-15 text-c-green"></i>
                            <?php
                            $sql_pending = "SELECT COUNT(*) AS pending_count FROM requests_tb WHERE Status = 'Pending';";
                            $result_pending = $conn->query($sql_pending);
                            $row_pending = $result_pending->fetch_assoc();
                            echo $row_pending['pending_count'];
                            ?>
                        </h4>
                        <p class="m-b-0"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center order-visitor-card">
                    <div class="card-block">
                        <h6 class="m-b-0">Patients Statistics</h6>
                        <h4 class="m-t-15 m-b-15"><i class="fas fa-users m-r-15 text-c-red"></i>
                            <?php
                            $sql_patients = "SELECT COUNT(*) AS patients_count FROM patient_tb;";
                            $result_patients = $conn->query($sql_patients);
                            $row_patients = $result_patients->fetch_assoc();
                            echo $row_patients['patients_count'];
                            ?>
                        </h4>
                        <p class="m-b-0"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center order-visitor-card">
                    <div class="card-block">
                        <h6 class="m-b-0">Top Services</h6>
                        <h4 class="m-t-15 m-b-15"><i class="fas fa-star m-r-15 text-c-green"></i>Tooth Extraction</h4>
                        <p class="m-b-0"></p>
                    </div>
                </div>
            </div>
            <!-- sale card end -->
        </div>
        <div class="calendarContainer">
            <?php
            include('./calendar/index.php');
            ?>
            <!-- jQuery -->
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
            <script src="./calendar/evo-calendar/js/evo-calendar.min.js"></script>
            <script src="./calendar/demo/demo.js"></script>
            <script>
                $(document).ready(function () {
                    $('#calendar').evoCalendar({
                        theme: 'Midnight Blue',
                        //    theme: 'Royal Navy',
                        calendarEvents: [

                            <?php
                            $sqlCalendar = mysqli_query($conn, "SELECT r.*, s.service_name FROM requests_tb r INNER JOIN services_tb s ON r.service_id = s.service_id ORDER BY r.appointment_date ASC");
                            while ($row = mysqli_fetch_array($sqlCalendar)) {
                                echo "{";
                                echo "id: '" . $row['request_id'] . "',";
                                echo "badge: '" . date('g:i a', strtotime($row['appointment_date'])) . "', ";
                                echo "name: '" . $row['firstName'] . " " . $row['lastName'] . "',";
                                echo "description: '" . $row['service_name'] . "<br>" . "',";
                                echo "date: '" . $row['appointment_date'] . "',";
                                echo "type: 'event',";
                                echo "color: ";

                                $status = $row['status'];
                                if ($status === "Approve") {
                                    echo "'#198754'";
                                } elseif ($status === "Reject") {
                                    echo "'#dc3545'";
                                } elseif ($status === "Done") {
                                    echo "'lightseagreen'";
                                } else {
                                    echo "'#fd7e14'";
                                }
                                echo "},";
                            }
                            ?>
                        ]
                    });
                    var calendarEventsContainer = document.querySelector('.calendar-events');
                    var eventHeader = document.querySelector('.event-header');
                    var dateText = eventHeader.querySelector('p').textContent;
                    var dateObj = new Date(dateText);

                    var month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
                    var day = dateObj.getDate().toString().padStart(2, '0');
                    var year = dateObj.getFullYear();

                    var formattedDate = year + '-' + month + '-' + day;

                    var eventEmpty = document.querySelector('.event-empty');
                    var pElement = eventEmpty.querySelector('p');
                    pElement.textContent = 'No Appointments today...';
                    var addListContainer = document.createElement('div');
                    addListContainer.className = 'add-list-container';

                    var form = document.createElement('form');
                    form.action = '../save_appointment.php';
                    form.method = 'POST';

                    var input1 = document.createElement('input');
                    input1.className = 'Adate';
                    input1.type = 'hidden';
                    input1.name = 'date';
                    input1.value = formattedDate;

                    form.appendChild(input1);
                    addListContainer.appendChild(form);

                    var addListBtn = document.createElement('button');
                    addListBtn.type = 'submit';
                    addListBtn.name = 'add-list';
                    addListBtn.className = 'scheduleListBtn';

                    var textSpan = document.createElement('span');
                    textSpan.innerText = 'Disable Schedule List';
                    addListBtn.appendChild(textSpan);

                    form.appendChild(addListBtn);

                    pElement.appendChild(addListContainer);

                    var today = new Date();
                    today.setHours(0, 0, 0, 0);

                    var tomorrow = new Date(today);
                    tomorrow.setDate(tomorrow.getDate() + 1);

                    if (dateObj >= tomorrow) {
                        form.style.display = 'block';
                    } else {
                        form.style.display = 'none';
                    }

                    $('#calendar').on('selectDate', function () {
                        var selectedDate = $('#calendar').evoCalendar('getActiveDate');

                        var newDateObj = new Date(selectedDate);
                        newDateObj.setHours(0, 0, 0, 0);
                        dateObj = newDateObj;

                        month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
                        day = dateObj.getDate().toString().padStart(2, '0');
                        year = dateObj.getFullYear();
                        formattedDate = year + '-' + month + '-' + day;
                        input1.value = formattedDate;

                        var currentDay = dateObj.getDay();
                        if (currentDay === 0) {
                            form.style.display = 'none';
                            textContents = 'We kindly inform you that there is no scheduling on Sundays. Our clinic operates from Monday to Saturday. We apologize for any inconvenience and appreciate your understanding.';
                        } else if (dateObj >= tomorrow) {
                            form.style.display = 'block';
                            textContents = '';
                        } else {
                            form.style.display = 'none';
                            textContents = 'No Appointments today...';
                            addListBtn.name = 'add-list';
                        }

                        var calendarEventsContainer = document.querySelector('.calendar-events');
                        var eventEmpty = document.querySelector('.event-empty');
                        var pElement = eventEmpty.querySelector('p');
                        pElement.textContent = textContents;
                        pElement.appendChild(addListContainer);

                        var responseDataDate = false;
                        var xhr2 = new XMLHttpRequest();
                        xhr2.open('GET', '../get_date.php?date=' + formattedDate, true);
                        xhr2.onreadystatechange = function () {
                            if (xhr2.readyState === XMLHttpRequest.DONE) {
                                if (xhr2.status === 200) {

                                    console.log("Second XHR request completed");
                                    responseDataDate = JSON.parse(xhr2.responseText); // Update responseDataDate
                                    console.log(responseDataDate);
                                    if (responseDataDate === true) {
                                        textSpan.innerText = 'Enable Schedule List';
                                        addListBtn.name = 'removed-list';
                                    } else {
                                        textSpan.innerText = 'Disable Schedule List';
                                    }

                                } else {
                                    window.location.href = 'https://www.google.com';
                                }
                            }
                        };
                        xhr2.send();
                    });
                });
            </script>
        </div>
    </div>


    
    <style>
        .scheduleListBtn {
            outline: none;
            border: 1px solid lightblue;
            display: block;
            margin: auto;
            text-align: center;
            background-color: transparent !important;
            color: #fff;
            padding: 5px 10px;
        }

        .margin {
            margin-top: 2%;
            /* background-color: pink; */
        }

        .order-visitor-card {
            /* -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out; */
            text-align: center !important;
            background-color: #fff;
            padding: 10px 0;
            color: rgb(100, 100, 100);
        }

        .card-block h4,
        p {
            color: lightseagreen;
        }

        .order-visitor-card:hover .card-block h4,
        .order-visitor-card:hover .card-block h6,
        .order-visitor-card:hover p {
            color: #fff;
        }

        .order-visitor-card:hover {
            background-color: lightseagreen;
        }

        .calendar-events {
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .event-list {
            /* background-color: pink; */
            flex: 100%;
            overflow: auto;
        }

        .event-list .event-empty {
            background-color: red;
        }

        .event-list::-webkit-scrollbar,
        .form::-webkit-scrollbar {
            width: 0.3em;
        }

        .event-list::-webkit-scrollbar-track,
        .form::-webkit-scrollbar-track {
            background: transparent;
        }

        .event-list::-webkit-scrollbar-thumb,
        .form::-webkit-scrollbar-thumb {
            background: #fff;
        }

        .event-list::-webkit-scrollbar-thumb:hover.form::-webkit-scrollbar-thumb {
            background: #555;
        }

        .form {
            overflow: auto;
            width: 90%;
            /* background-color: pink; */
            background-color: rgb(33, 101, 131);
            top: 5%;
            /* padding-top: 5%; */
            height: 90%;
            position: absolute;
            z-index: 10;
            left: 5%;
            display: none;
            transition: transform 0.3s ease;
            transform: translateY(100%);
        }

        .form .title {
            position: sticky;
            top: 0;
            background-color: rgb(33, 101, 131);
            color: white;
            padding: 10px;
            font-weight: bold;
        }

        .form .content {
            padding-top: 30px;
            /* Adjust as needed to prevent content from being overlapped by title */
        }
    </style>
</body>

</html>