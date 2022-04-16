<?php
$name = $_POST["formname"];
$name = str_replace(array("\r","\n"),array(" "," "),$name);
$name = strip_tags($name);
$name = strval($name);
$email = filter_var($_POST["formemail"], FILTER_SANITIZE_EMAIL);
$email = str_replace(array("\r","\n"),array(" "," "),$email);
$email = strip_tags($email);
$email = strval($email);
$number = $_POST["formnumber"];
$number = str_replace(array("\r","\n"),array(" "," "),$number);
$number = strip_tags($number);
$number = strval($number);
$message = $_POST["formmessage"];
$message = str_replace(array("\r","\n"),array(" "," "),$message);
$message = strip_tags($message);
$message = strval($message);

require_once("PHPMailer-master/src/PHPMailer.php");
require_once("PHPMailer-master/src/SMTP.php");
require_once("PHPMailer-master/src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
$mail->setCharset = "UTF-8";

$enviar = "Nome do cliente: " . $name . "<br>Nome do email: " . $email . "<br>Número de telefone: " . $number . "<br>Pedido: " . $message;

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = "tls://smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "email@gmail.com";
    $mail->Password = "password";
    $mail->Port = 587;

    $mail->setFrom("email@gmail.com");
    $mail->addAddress("email@gmail.com");

    $mail->isHTML(true);
    $mail->Subject = "Um cliente mandou um pedido pelo site";
    $mail->Body = $enviar;
    $mail->AltBody = $enviar;

    if($mail->send()) {
        echo "email enviado com sucesso";
    } else {
        echo "email não enviado";
    }
} catch(Exception $e) {
    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}