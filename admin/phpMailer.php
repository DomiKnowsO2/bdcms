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
                $mail->Body = '<h1>Request Approved</h1>';

                $mail->send();

                echo '
                    <script>
                        alert("This is a test ' . $email . '");
                    </script>
                ';
            }
            exit();
        }
    } else {
        header('location:./index.php?page=requests');
        exit();
    }
}
?>
