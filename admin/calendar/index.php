<!DOCTYPE html>
<html lang="en">

<head>
    <title>Evo Calendar</title>

    <meta charset="utf-8">
    <meta name="description" content="Simple Modern-looking Event Calendar Plugin">
    <meta name="keywords" content="jQuery, Plugin, Event, Calendar, EvoCalendar">
    <meta name="author" content="Edlyn Villegas">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="icon" href="favicon.png">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./calendar/evo-calendar/css/evo-calendar.min.css">
    <link rel="stylesheet" type="text/css" href="./calendar/evo-calendar/css/evo-calendar.orange-coral.min.css">
    <link rel="stylesheet" type="text/css" href="./calendar/evo-calendar/css/evo-calendar.midnight-blue.min.css">
    <link rel="stylesheet" type="text/css" href="./calendar/evo-calendar/css/evo-calendar.royal-navy.min.css">

    <link rel="stylesheet" type="text/css" href="./calendar/demo/demo.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Mono&display=swap" rel="stylesheet">
</head>

<body>
    <main>
        <div class="main-container">
            <section id="demos">
                <div class="section-content">
                    <div class="action-buttons">
                        <button style="display: none;"  data-set-theme="Midnight Blue"></button>
                    </div>
                    <div class="console-log">
                        <div class="log-content">
                            <div class="--noshadow" id="demoEvoCalendar"></div>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <button class="btn-action" id="addBtn">ADD EVENT</button>
                        <button class="btn-action" id="removeBtn" disabled>REMOVE
                            EVENT</button>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <script src="./calendar/evo-calendar/js/evo-calendar.min.js"></script>
    <script src="./calendar/demo/demo.js"></script>
</body>

</html>