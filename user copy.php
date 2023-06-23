<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>BDCMS</title>
   <link rel="stylesheet" href="./admin/calendar/evo-calendar/css/evo-calendar.min.css">
   <link rel="stylesheet" href="./admin/calendar/evo-calendar/css/evo-calendar.royal-navy.min.css">
   <link rel="stylesheet" href="./admin/calendar/demo/demo.css">
   <link rel="stylesheet" href="./admin/calendar/evo-calendar/css/evo-calendar.css">

   <!-- sample commit2 -->
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- bootstrap cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">


   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
   <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>

<body>

   <section class="contact" id="contact">
      <h1 class="heading">make appointment</h1>
      <div class="box-container container">
         <main>
            <div class="console-log">
               <div class="log-content">
                  <div class="--noshadow" id="calendar"></div>
               </div>
            </div>
         </main>
      </div>


      <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
      <script src="./admin/calendar/evo-calendar/js/evo-calendar.min.js"></script>
      <script src="./admin/calendar/demo/demo.js"></script>
      <script>
         $(document).ready(function() {
            $('#calendar').evoCalendar({
               theme: 'Royal Navy',
               calendarEvents: [{
                     id: '1', // Event's ID (required)
                     name: "New Year", // Event name (required)
                     date: "06/23/2023", // Event date (required)
                     type: "holiday", // Event type (required)
                     everyYear: true // Same event every year (optional)
                  },
                  {
                     id: '2', // Event's ID (required)
                     name: "Vacation Leave",
                     badge: "02/13 - 02/15", // Event badge (optional)
                     date: "06/23/2023", // Event date (required)
                     description: "Vacation leave for 3 days.", // Event description (optional)
                     type: "event",
                     color: "#63d867" // Event custom color (optional)
                  }
               ],
            });

            // Event listener for the button click
            $(document).on('click', '.schedule-btn', function() {
               var eventId = $(this).data('id');
               var inputHTML = '<input type="text" id="schedule-input-' + eventId + '">';
               $(this).parent().append(inputHTML);
            });


            flatpickr("#eventDate", {
               enableTime: true,
               dateFormat: "Y-m-d H:i",
            });

            // Event listener for the button click
            $(document).on('click', '.schedule-btn', function() {
               var eventId = $(this).data('id');
               var inputHTML = '<input type="text" id="schedule-input-' + eventId + '">';
               $(this).parent().append(inputHTML);

               // Function to retrieve input value
               function getInputValue() {
                  var inputValue = $('#schedule-input-' + eventId).val();
                  console.log('Input value:', inputValue);
                  // Perform further actions with the input value
               }

               // Call the getInputValue function when a button is clicked
               getInputValue();
            });

         });
      </script>
   </section>
   <script src="js/script.js"></script>

</body>

</html>