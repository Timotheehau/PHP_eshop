<?php


// In utilise la classe PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $subject = htmlspecialchars($_POST['subject']);
    $body = htmlspecialchars($_POST['body']);


    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = SMTP_HOST;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = SMTP_USERNAME;                     //SMTP username
    $mail->Password   = SMTP_PASSWORD;                              //SMTP password
    $mail->SMTPSecure = SMTP_ENCRYPTION;            //Enable implicit TLS encryption
    $mail->Port       = SMTP_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($email);
    $mail->addAddress($mail->Username, 'Timothée Hauser');                              
    $mail->Subject = $subject;
    $mail->Body    = $body;


    $mail->send();
    echo 'Message envoyé avec succès !';
    
} catch (Exception $e) {
    echo "Mail erreur : {$mail->ErrorInfo}";
}
    
        } else {
            $error = "L'email n'est pas au bon format";
        }
} 