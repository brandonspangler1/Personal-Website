<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\OAuth;
    use League\OAuth2\Client\Provider\Google;

    date_default_timezone_set('America/New_York');

    require 'vendor/autoload.php';

    // $from_email = $_POST['email'];
    // $subject = $_POST['subject'];
    // $name = $_POST['name'];
    // $message = $_POST['message'];

    $mail = new PHPMailer();

    // try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP

        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption

        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->AuthType = 'XOAUTH2';

        // $mail->Username   = 'brandonspanglerwebsite@gmail.com';                     //SMTP username
        // $mail->Password   = 'hyjjyv-gisjop-7feknY';                               //SMTP password
        
        


        $email = 'brandonspanglerwebsite@gmail.com';
        $clientId = '653475083162-jfrcfqlfe9qhm86nh5f89if3hktoh2e2.apps.googleusercontent.com';
        $clientSecret = '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';

        $refreshToken = '1//0f8OY7DrRxCqdCgYIARAAGA8SNwF-L9IrZrnshlxvRXnoUeu9iClG-r-xP_zoIUspM9qxPw2wmf4RfCU3JjDwptQk5fMEHYI_gmc';

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

        $mail->setFrom($email, 'Jane Doe');
        $mail->addAddress($email, 'John Doe');

        // $mail->isHTML(true);   
        $mail->Subject = 'PHPMailer GMail XOAUTH2 SMTP test';

        // //Recipients
        // $mail->setFrom('brandonspanglerwebsite@gmail.com', 'EVI');
        // $mail->addAddress('brandonspanglerwebsite@gmail.com');                                      //Add a recipient

        //Content
                                       //Set email format to HTML
                                       $mail->CharSet = PHPMailer::CHARSET_UTF8;
                                       $mail->Body = 'Hello';

        // $mail->Subject = 'TEST';
        $mail->AltBody = 'This is a plain-text message body';

        

        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
        // echo "Message has been sent";
    // } catch (Exception $e) {
    //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // }


    // ini_set( 'display_errors', 1 );
    // error_reporting( E_ALL );
    // $from = "brandons0207@gmail.com";
    // $to = "brandons0207@gmail.com";
    // $subject = "Checking PHP mail";
    // $message = "PHP mail works just fine";
    // $headers = "From:" . $from;
    // if(mail($to,$subject,$message, $headers)) {
    //     echo "The email message was sent.";
    // } else {
    //     echo "The email message was not sent.";
    // }


   

    // echo "<br>", $from_email, "<br>", $subject, "<br>", $name, "<br>", $message, "<br>"; 

    
    // $location = $_POST['event_location'];
    // $start_time = $_POST['event_start'];
    // $end_time = $_POST['event_end'];
    // $date = $_POST['event_date'];
    // $cat = $_POST['event_cat'];
    
    // $phone = $_POST['contact_phone'];
    // $des = $_POST['event_des'];
    // $rso_name = $_SESSION['current_rso'];

    #echo "$name <br> $time <br> $date <br> $cat <br> $email <br> $phone <br> $des <br>";

    // $query = "INSERT INTO `rso_events`(`rso_name`, `name`, `date`, `time_from`, `time_to`, `category`, `description`, `location`, `email`, `phone`) VALUES ('$rso_name', '$name', '$date', '$start_time', '$end_time', '$cat', '$des', '$location', '$email', '$phone')";
    // mysqli_query($con, $query);
    // echo "<script>
    //         window.location.href='index.html'; 
    //         </script> ";

    // header("Location: index.html");
?>