<?php
require("phpmailer/PHPMailer.php");
require("phpmailer/SMTP.php");
require("phpmailer/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_confirmation_email($to_email, $to_name, $token) {
    $mail = new PHPMailer(true);

    // CHANGE THE MAIL SETTINGS
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "jbsazon1@gmail.com";
    $mail->Password = "uyry tkij ogct aqbl";
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";

    // Set email information (sender, recipient)
    $mail->setFrom('NO-REPLY@mail.com', "Registration Team");
    $mail->addAddress($to_email, $to_name);

    // Variable for confirmation link
    $confirm_link = "http://localhost/orig-echo/confirm.php?token=" . $token;

    // SET CHANGES TO THE EMAIL THAT WILL BE SENT
    $mail->isHTML(true);
    $mail->Subject = "Confirm Account Registration";
    $mail->Body = "
        <div style='width=75%;'>
            <p>Dear <strong>$to_name</strong>,</p>
            <p>Thank you for registering. Please click the link below to confirm your registration:</p>
            <div style='margin-top: 4rem; margin-bottom: 4rem'>
                <a href='$confirm_link' style='padding: 10px 20px; background: #198754; color: white; text-decoration: none; border-radius: 5px;'>Confirm Registration</a>
            </div>
            <p>If the button does not work, please copy and paste this link into your web browser:</p>
            <a href='$confirm_link'>$confirm_link</a>
            <p>From The Registration Team</p>
        </div>
    ";

    $mail->send();
}

?>