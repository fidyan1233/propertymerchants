<?php

$name = $_POST["name"];
$number = $_POST["number"];
$email =$_POST["email"];

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->isSMTP(); 
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = "tls";
$mail->SMTPAuth = true;
$mail->Username = 'a3m2d1@gmail.com';
$mail->Password = 'mvesrgoxwggxdzuw';
$mail->setFrom('a3m2d1@gmail.com', 'Web-Mailer');
$mail->addAddress('fidyan.techstreat@gmail.com');
$mail->Subject = "New lead from $name via website";
$mail->Body = "  
  
  Name: $name 
  Number: $number
  Email: $email

  ";
$mail->send();


if(isset($_POST['contactFrmSubmit']) && !empty($_POST['name']) && !empty($_POST['number'])){

    $status = 'ok';
    echo $status;die;
}
