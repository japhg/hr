<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';

require 'special_features/vendor/phpmailer/phpmailer/src/Exception.php';
require 'special_features/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'special_features/vendor/phpmailer/phpmailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$subject = $_POST['subject'];
$email = $_POST['emails'];
$message = $_POST['message'];
$mail = new PHPMailer(true);

// try {
    //Server settings
    foreach (explode(",", $email) as $address) {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'jpgomera19@gmail.com'; //SMTP username
    $mail->Password = 'pmikvkfoyejorpgc'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // //Recipients
    $mail->setFrom('from@example.com', 'Special Features Testing');
    $mail->addAddress($email); //Add a recipient

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = $subject; 
    $mail->Body = $message;
    $mail->AltBody = $message;

    if ($mail->send()) {
        echo "success";
    } else {
        echo $mail->ErrorInfo;
    }
}

// $mail->send();
//     echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }


