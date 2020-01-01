<?php

require "phpmailer/vendor/autoload.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])){

$name=$_POST['name'];
$email=$_POST['email'];
$subject=$_POST['suject'];
$message=$_POST['message'];
$myemail='contact@anouarmobaraka.ma';


$messageall="<h3>Nom Complet : </br>".$name."</h3>";
$messageall.="<h3>Email : ".$email."</h3>";
$messageall.="<h3>Subject : ".$subject."</h3>";
$messageall.="<h3>Message: ".$message."</h3>";

$developmentMode = true;
$mailer = new PHPMailer($developmentMode);

try {
    $mailer->SMTPDebug = 4;
    $mailer->isSMTP();

    if ($developmentMode) {
        $mailer->SMTPOptions = [
            'ssl'=> [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];
    }


    $mailer->Host = 'www.anouarmobaraka.ma';
    $mailer->SMTPAuth = false;
    $mailer->Username = $myemail;
    $mailer->Password = '123456';
    $mailer->SMTPSecure = 'ssl';
    $mailer->Port = 587;
    $mailer->isHTML();


    $mailer->setFrom('zouhairjab2@gmail.com');
    $mailer->addAddress($myemail);

    $mailer->isHTML(true);
    $mailer->Subject=$_POST['subject'];
    $mailer->Body = $messageall;


    $mailer->send();
    $mailer->ClearAllRecipients();
    echo "MAIL HAS BEEN SENT SUCCESSFULLY";

} catch (Exception $e) {
    echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
}
header('Location: ../index.php');
exit;
}