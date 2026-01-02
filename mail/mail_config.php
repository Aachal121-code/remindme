
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

function getMailer() {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'remindme.alerts@gmail.com';   // your app email
    $mail->Password   = 'retk fbpg mglz fdre';        // Gmail App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    
    $mail->setFrom('remindme.alerts@gmail.com', 'RemindMe');
    $mail->isHTML(true);
    return $mail;
}
