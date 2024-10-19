<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer;

    // Collecting form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $lookingFor = $_POST['looking_for'] ?? '';
    $constructionType = $_POST['construction_type'] ?? '';
    $projectLocation = $_POST['project_location'] ?? '';
    $startDate = $_POST['start_date'] ?? '';
    $budget = $_POST['budget'] ?? '';
    $haveArchitect = $_POST['have_architect'] ?? '';
    $architectName = $_POST['architect_name'] ?? '';
    $referralSource = $_POST['referral_source'] ?? '';
    $referredBy = $_POST['referred_by'] ?? '';
    $message = $_POST['message'] ?? '';

    // Constructing the email body
    $mailbody = "Valluvassery - New Enquiry\n\n";
    $mailbody .= "Name: $name\n";
    $mailbody .= "Email: $email\n";
    $mailbody .= "Phone: $phone\n";
    $mailbody .= "Looking For: $lookingFor\n";
    $mailbody .= "Construction Type: $constructionType\n";
    $mailbody .= "Project Location: $projectLocation\n";
    $mailbody .= "Expected Start Date: $startDate\n";
    $mailbody .= "Budget: $budget\n";
    $mailbody .= "Have Architect/Designer: $haveArchitect\n";
    if ($haveArchitect === 'yes') {
        $mailbody .= "Architect/Designer Name: $architectName\n";
    }
    $mailbody .= "Referral Source: $referralSource\n";
    $mailbody .= "Referred By: $referredBy\n";
    $mailbody .= "Message: $message\n";

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
    $mail->Subject = 'Valluvassery - New Enquiry from Website';
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
