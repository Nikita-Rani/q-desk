<?php 
require_once '../vendor/autoload.php';
require_once 'constant.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
  ->setUsername(EMAIL)
  ->setPassword(PASSWORD);


// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);


function sendVerificationEmail($user_email,$token)
{
    global $mailer;
    $body='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verify your email</title>
    </head>
    <body>
        <div class="wrapper">
            <p>
            Thank you for signing up on Q-Desk.please click on the link below to verify your email.
            </p>
            <a href="http://localhost/forum/home.php?token='.$token.'">Verify your email address</a>
        </div>
    </body>
    </html>';
// Create a message
$message = (new Swift_Message('Verify your email address'))
->setFrom(EMAIL)
->setTo($user_email)
->setBody($body, 'text/html');


// Send the message
$result = $mailer->send($message);

}
?>