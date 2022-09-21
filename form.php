<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\OAuth;
    use League\OAuth2\Client\Provider\Google;

    date_default_timezone_set('America/New_York');

    require 'vendor/autoload.php';

    $from_email = $_POST['email'];
    $subject = $_POST['subject'];
    $name = $_POST['name'];
    $message = $_POST['message'];

    // For Debugging
    // echo "<br>", $from_email, "<br>", $subject, "<br>", $name, "<br>", $message, "<br>"; 

    $mail = new PHPMailer();

    // try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP

        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption

        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->AuthType = 'XOAUTH2';

        // For Debuggin
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        
        $email = "brandonspanglerwebsite@gmail.com";
        $clientId = "653475083162-jfrcfqlfe9qhm86nh5f89if3hktoh2e2.apps.googleusercontent.com";
        $clientSecret = "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";

        $refreshToken = "1//0fhDwyd1YDINACgYIARAAGA8SNwF-L9IrxvM6IOZzMkw_ZJiMnCpOksHAf8MfnmRaTwjyeRhkW9ga4JVLeSOisvwiBCFZANN5yNQ";

        $provider = new Google(
            [
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
            ]
        );

        $mail->setOAuth(
            new OAuth(
                [
                    'provider' => $provider,
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                    'refreshToken' => $refreshToken,
                    'userName' => $email,
                ]
            )
        );

        // Add From and To
        $mail->setFrom($email, $name);
        $mail->addAddress($email, 'Website Contact Form');

        // Add Subject
        $mail->Subject = $subject;

        //Content
        $mail->CharSet = PHPMailer::CHARSET_UTF8;
        $mail->Body = $message . "<br>" . "From: " . $name . " " . $from_email;

        $mail->AltBody = 'This is a plain-text message body';


        if (!$mail->send()) {
            echo '<script> alert("Mailer Error: " . $mail->ErrorInfo) </script>';
        } else {
            echo '<script> alert("Message sent!") </script>';
        }
        
    // echo "<script> window.history.go(-1) </script>";
?>