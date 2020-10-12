<?php

    require_once "./PHPMailer/vendor/autoload.php";
    require_once "./MailException.php";
    require_once "./Mailer.php";    

<<<<<<< HEAD
    // $to = 'matpoa3ntosacco@gmail.com';
    // $name = $_POST["name"];
    // $email= $_POST["email"];
    // $text= $_POST["message"];
    // $subject= $_POST["subject"];
    
    // $body = $name . "\n" . $email . "\n" . $text;

    try{
        $mailer = new Mailer("support");
        $mailer->sendMail(["sheelaghmem@gmail.com"],"Subject","Message itself");
=======
    $to = '@gmail.com';
    $name = $_POST["name"];
    $email= $_POST["email"];
    $text= $_POST["message"];
    $subject= $_POST["subject"];
    
    $body = $name . "\n" . $email . "\n" . $text;

    try{
        $mailer = new Mailer("support");
        $mailer->sendMail([$to],$subject,$body);
>>>>>>> 276467ee35b6b9c1f87ae977ff9da9b5debbacf7
    }catch(MailException $e){
        echo $e->getMessage();
        exit();
    }

    echo "Message sent successfully!";  


?>
