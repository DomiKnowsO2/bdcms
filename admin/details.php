<?php
include('../db-connect.php');

$id = $_POST['requestId'];

$query = "SELECT * FROM history_tb WHERE patient_id = $id order by history_id desc";
$result = mysqli_query($conn, $query);
?>

<div class="modal-header">
    <h5 class="modal-title" id="detailRecordLabel">Patient Records</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="textarea-container">
        <?php
        if (mysqli_num_rows($result) > 0) {
            $count = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $serviceDetails = $row['service_details'];
                echo "<textarea name='details' id='details$count' rows='25'>$serviceDetails</textarea>";
                $count++;
            }
        } else {
            echo "No history records found for the specified patient ID.";
        }
        ?>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <!-- <button type="submit" name="AddPatientRecord" class="btn btn-primary">New Record</button> -->
</div>

<style>
    .textarea-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    .textarea-container textarea {
        flex: 0 0 calc(33.33% - 10px);
        margin-right: 10px;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f8f8f8;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
        font-size: 14px;
        line-height: 1.5;
    }
</style>
