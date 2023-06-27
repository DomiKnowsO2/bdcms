<div id="myModal" class="modal">
   <div class="modal-container">
      <div class="modal-content">
         <div class="head">
            <h1>Notification</h1>
            <span class="close">&times;</span>
         </div>
         <div class="body">
            <?php
            $notification_messages_query = "SELECT * FROM notification_tb WHERE patient_id = '$patient_id' ORDER BY `notification_tb`.`notification_id` DESC";
            $notification_messages_result = mysqli_query($conn, $notification_messages_query);

            if ($notification_messages_result && mysqli_num_rows($notification_messages_result) > 0) {
               while ($notification_row = mysqli_fetch_assoc($notification_messages_result)) {
                  $notification_message = $notification_row['notification_Message'];
            ?>
                  <textarea id="notif" row="30" readonly><?php echo $notification_message; ?></textarea>
            <?php
               }
            }
            ?>
         </div>
      </div>
   </div>
</div>
<script>
   // Get the modal element
   var modal = document.getElementById("myModal");

   // Get the button that opens the modal
   var btn = document.getElementById("myBtn");

   // Get the <span> element that closes the modal
   var span = document.getElementsByClassName("close")[0];

   // When the user clicks the button, open the modal
   btn.onclick = function() {
      modal.classList.add("fade-in");
      modal.style.display = "block";
      document.body.classList.add("modal-open");
   };

   // When the user clicks on <span> (x), close the modal
   span.onclick = function() {
      modal.classList.remove("fade-in");
      modal.classList.add("fade-out");
      setTimeout(function() {
         modal.style.display = "none";
         modal.classList.remove("fade-out");
      }, 300);
      document.body.classList.remove("modal-open");
   
   };

   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function(event) {
      if (event.target == modal) {
         modal.classList.remove("fade-in");
         modal.classList.add("fade-out");
         setTimeout(function() {
            modal.style.display = "none";
            modal.classList.remove("fade-out");
         }, 300);
         document.body.classList.remove("modal-open");
         document.body.style.overflow = "hidden";
      }
   };
</script>
<style>
   /* Modal Styling */
   .modal {
      display: none;
      position: fixed;
      z-index: 9999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100vh;
      overflow: hidden;
      background-color: rgba(0, 0, 0, 0.5);
      animation: fadeIn 0.3s ease-in-out;
   }

   .modal.fade-out {
      animation: fadeOut 0.3s ease-in-out;
   }

   .modal-container {
      overflow: auto;
      /* background-color:red; */
      margin: 0% auto;
      padding: 20px;
      width: 80%;
      max-width: 500px;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      animation: fadeInContent 0.3s ease-in-out 0.3s forwards;
   }

   .modal-content {
      height: 50%;
      overflow: auto;
      background-color: #fefefe;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 500px;
      opacity: 0;
      animation: fadeInContent 0.3s ease-in-out 0.3s forwards;
   }

   .modal-open {
      overflow: hidden;
   }

   @keyframes fadeIn {
      from {
         opacity: 0;
      }

      to {
         opacity: 1;
      }
   }

   @keyframes fadeOut {
      from {
         opacity: 1;
      }

      to {
         opacity: 0;
      }
   }

   @keyframes fadeInContent {
      from {
         opacity: 0;
         transform: translateY(-20px);
      }

      to {
         opacity: 1;
         transform: translateY(0);
      }
   }

   .head {
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid #aaa;
   }

   .body {
      font-size: 13px;
      padding-top: 10px;
      padding-bottom: 0;
   }

   .close {
      color: #aaa;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
   }

   .close:hover,
   .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
   }

   #notif {
      width: 100%;
      border-bottom: 1px solid #aaa;
      height: 100px;
      resize: none;
   }
</style>