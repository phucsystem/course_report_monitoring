<?php

require 'PHPMailer/PHPMailerAutoload.php';
/**
 * Send an email
 *
 * @access  public
 * @return  bool
 */
if (!function_exists('send_email')) {

    function send_email($recipient, $subject, $message) {
        $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtpout.secureserver.net';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->SMTPSecure = '';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25;                                    // TCP port to connect to
        
        $mail->Username = 'info@carstenreise.com';                 // SMTP username
        $mail->Password = 'Abcd@1234';                           // SMTP password
        $mail->setFrom('no_reply@carstenreise.com', 'CRM system');
        $mail->addAddress($recipient);     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $message;

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo; exit;
        } else {
            //echo 'Message has been sent';
        }
    }

}



