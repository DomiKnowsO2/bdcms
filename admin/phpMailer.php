<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

include('../db-connect.php');
if (isset($_POST['Savechanges'])) {
    $request_id = $_POST['request_id'];
    $newStatus = $_POST['statusSelect'];

    $updateQuery = "UPDATE requests_tb SET status = '$newStatus' WHERE request_id = $request_id";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        $mailQuery = "SELECT * FROM requests_tb WHERE request_id = '$request_id'";
        $mailResult = mysqli_query($conn, $mailQuery);

        if ($mailResult && mysqli_num_rows($mailResult) > 0) {
            $row = mysqli_fetch_assoc($mailResult);
            $email = $row['email'];
            $appointment_date = $row['appointment_date'];
            $date = date("M-d-Y", strtotime($appointment_date));
            $time = date("h:ia", strtotime($appointment_date));
            $formatted_date = date("F d, Y", strtotime($date));
            $formatted_time = date("h:ia", strtotime($time));

            if ($newStatus == 'Approve') {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'bdcmsystem@gmail.com';
                $mail->Password = 'uypzkcxonbsbtbel';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('bdcmsystem@gmail.com');// <-Password123456bdcms
                $mail->addAddress($email); //email of recipient

                $mail->isHTML(true);
                $mail->Subject = 'APPOINTMENT SCHEDULE';
                $mail->Body = 'Dear Patient,<br /><br />

                We are pleased to inform you that your appointment request has been approved by our dental clinic. Your scheduled date and time are as follows:<br /><br />
                
                Date: '.$formatted_date.'<br />
                Time: '.$formatted_time.'<br /><br />
                
                Please arrive at least 15 minutes before your appointment to complete the necessary paperwork. If you have any questions or need to reschedule, please contact us at +639706557001 or email us at bdcmsystem@gmail.com.
                
                We look forward to seeing you soon and providing you with the best dental care possible.<br /><br />
                
                Sincerely,<br />
                Balatan Dental Clinic';

                $mail->send();

                header('location:./index.php?page=requests');
            }
            exit();
        }
    } else {
        header('location:./index.php?page=requests');
        exit();
    }
}
