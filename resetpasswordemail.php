<?php 
require_once 'vendor/autoload.php';
require_once 'files/constant.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
  ->setUsername(EMAIL)
  ->setPassword(PASSWORD);


// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

function  resetPasswordEmail($user_email,$token)
{
    global $mailer;
    $body='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Your Password</title>
    </head>
    <body>
        <div class="wrapper">
            <p>
            please reset your password by clicking on the below link.
            </p>
            <a href="http://localhost/forum/resetform.php?password-token='.$token.'">Reset Your Password</a>
        </div>
    </body>
    </html>';
// Create a message
$message = (new Swift_Message('Reset Your Password'))
->setFrom(EMAIL)
->setTo($user_email)
->setBody($body, 'text/html');


// Send the message
$result = $mailer->send($message);

}

?>