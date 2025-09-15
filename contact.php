<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$email = $_POST['email'];
$name = $_POST['name'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$m_subject = "Message:" .$subject;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';



//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


//Load Composer's autoloader


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings                     //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'gatechinfo.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '_mainaccount@gatechinfo.com';                     //SMTP username
    $mail->Password   = '4G64:trG+wYlM7';                              //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('info@gatechinfo.com','Gatech');
    $mail->addAddress('dheryhenry@gmail.com'); 

  
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->AddEmbeddedImage('assets/img/logo.png', 'image');
    $mail->Subject = $m_subject;
    $mail->Body    =  "
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    </head>
    <body style='margin: 0px;padding: 40px 0px 40px 0px;font-family:sans-serif; background-color: #f2f2f2;color: #212B36; font-weight: 300;height:auto;box-sizing: border-box;'>
        <div style='width:85vw;margin:auto'>  
            <img src='cid:image' alt='SharedSub Logo' style='width:70%;'>
            <div style='width:auto;height: auto;  background-color: #fff; padding: 30px; margin-top: 10%;'>

            <div style='margin-bottom: 20px;font-size:14px;line-height: 25px;'>
                <p>New Message from $name<br> Email: $email </p>
                <p>$message<br><br> 
                <b>Cheers</b></p>

            </div>
            </div>
            <br>
            <p style='font-size:14px;'>Support:  info@gatechinfo.com</p>
        </div>
    </body>
</html>
        ";
    $mail->AltBody = '';
    


    $mail->send();
   header("location:success.html");

} catch (Exception $e) {
    header('location:/error');
}
?>