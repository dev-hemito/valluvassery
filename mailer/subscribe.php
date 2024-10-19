<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer;

    // Collecting form data
    $email = $_POST['email'] ?? '';

    // Constructing the email body
    $mailbody = "Valluvassery - Subscribe \n\n";
    $mailbody .= "Email: $email\n";

    // Email configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'web.form.enquiry.123@gmail.com';
    $mail->Password = 'czfeonldeymnuftm';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('web.form.enquiry.123@gmail.com', 'Website form Enquiry');
    $mail->addAddress('info@valluvasserybuilders.com', 'valluvasserybuilders');

    $mail->isHTML(false);
    $mail->Subject = 'Valluvassery - Subscribe from Website';
    $mail->Body = $mailbody;

    // Sending the email
    if ($mail->send()) {
        echo 'Enquiry Submitted Successfully';
    } else {
        echo 'Submission Failed: ' . $mail->ErrorInfo;
    }
} else {
    echo 'Invalid Request Method';
}
?>
