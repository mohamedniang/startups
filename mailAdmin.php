<?php

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    define("PWD", "protectorblack1997");


    require_once "PHPMailer/PHPMailer/PHPMailer.php";

    // ini_set("SMTP", "smtp.gmail.com");
    // ini_set("smtp_port", "587");

    $clientMail = htmlspecialchars($_POST['ctmail']);
    $clientMsg = htmlspecialchars($_POST['cttext']);
    header("Location:javascript:history.go(-1)?er=mail.report.not.working");
    exit(); // This script ain't working for now.

    // $to = $clientMail; // Required. The recipient's email address.
    // $subject = "Rapport envoyer par un utilisateur de la plateform des startups"; // Required. The email's subject line.
    // $message = $clientMsg; // Required. The actual email body.
    // $headers = "From: $clientMail \r\n"; // Optional. Additional header fields such as "From", "Cc", "Bcc" etc.
    // $headers .= "Reply-To: $clientMail \r\n"; // Optional. Additional header fields such as "From", "Cc", "Bcc" etc.
    // $headers .= "Content-type text/html\r\n"; // Optional. Additional header fields such as "From", "Cc", "Bcc" etc.
    // $parameters = ""; // Optional. Any additional parameters.

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();
    $mail->Username = 'mouhamedniang1997@gmail.com';
    $mail->Password = PWD;
    $mail->setFrom($clientMail);
    $mail->Subject = 'mail de report depuis la plateforme';
    $mail->Body = $clientMsg;
    $mail->addAddress('mouhamedniang1997@gmail.com');
    $mail->send();

    // if (mail($to, $subject, $message, $headers)) {
    //     echo "success";
    // } else {
    //     echo "failure";
    // }
}
