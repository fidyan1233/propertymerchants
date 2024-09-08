<?php

session_start();

$name = $_POST["name"];
$config = $_POST["config"];
$address = $_POST("address");
$expectation = $_POST("expectation");        
$captcha = filter_var($_POST["captcha"], FILTER_SANITIZE_STRING);

if(empty($captcha)) {
    echo 400;exit;
}

$url = 'https://www.google.com/recaptcha/api/siteverify?secret=6LcPdC8qAAAAAHNeO3f8XLtZx4O9VoaczedT_M62&response='.$captcha;

$verify = file_get_contents($url);

if(!empty($verify) && json_validator($verify)){
    $response = json_decode($verify,true);
    if(!$response['success']){
        echo 400;exit;
    }
}else{
    echo 400;exit;
}

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
$mail->setFrom('a3m2d1@gmail.com', 'Web-Mailer'); // from which email is send
$mail->addAddress('fidyan.techstreat@gmail.com');// client email
$mail->Subject = "You received a message from $name";
$mail->Body = "  

    Name: $name 
    Config: $config
    Address: $address
    Expectation:$expectation 

// $mail->send();
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: '. $mail->ErrorInfo;
} else {
    $status = 'ok';
    echo $status;die;
}

if(isset($_POST['sellFrmSubmit']) && !empty($_POST['name']) ){

    $status = 'ok';
    echo $status;die;
}

function json_validator($data) {
    if (!empty($data)) {
        return is_string($data) && 
          is_array(json_decode($data, true)) ? true : false;
    }
    return false;
}
