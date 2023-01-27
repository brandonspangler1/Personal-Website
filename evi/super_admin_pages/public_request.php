<?php

require('../db_connection.php');
session_start();

# If Super Administrator has not logged in yet, direct the user to the index/login page 
if (isset($_SESSION['sa_login_successful']) == null && $_SESSION['sa_login_successful'] == false) {

    echo "
        <script>
            alert('Please Login To Access This Page'); 
            window.location.href='../index.php'; 
        </script>
        ";
}

if (isset($_GET['name']) && isset($_GET['university'])) {

    $query = "SELECT * FROM `public_requests` WHERE `name`='$_GET[name]' AND `university`='$_GET[university]'";
    $result = mysqli_query($con, $query);

    if ($result) {

        $fetch_result = mysqli_fetch_assoc($result);

        $public_admin_name = $fetch_result['admin_name'];
        $public_admin_email = $fetch_result['admin_email'];
        $public_admin_phone = $fetch_result['admin_phone'];
        $public_university = $fetch_result['university'];
        $public_name = $fetch_result['name'];
        $public_date = $fetch_result['date'];
        $public_time_from = $fetch_result['time_from'];
        $public_time_to = $fetch_result['time_to'];
        $public_category = $fetch_result['category'];
        $public_description = $fetch_result['description'];
        $public_location = $fetch_result['location'];

        $new_public_location = str_replace(' ', '+', $public_location);
    }
}

use PHPMailer\PHPMailer\Exception;        #PHP Mailer Github 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

# Send Admin an Email for Public Event Accepted 
function sendUserAcceptEmail($email)
{

    require("../PHPMailer/Exception.php");
    require("../PHPMailer/PHPMailer.php");
    require("../PHPMailer/SMTP.php");

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'eviteam4710@gmail.com';                     //SMTP username
        $mail->Password   = 'cop4710evi';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('eviteam4710@gmail.com', 'EVI EVENT PLANNER');
        $mail->addAddress($email);                                      //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Public Event Accepted by Super Administrator: EVI';
        $mail->Body    = "THANK YOU FOR USING EVI AS YOUR EVENT PLANNER~
                            Your Public Event request has been approved by the Super Administrator. 
                            You may view the public event on your Admin and Student Home pages. 

                            Thank You 
                            ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

# Send Admin an Email for Public Event Rejected 
function sendUserRejectEmail($email)
{

    require("../PHPMailer/Exception.php");
    require("../PHPMailer/PHPMailer.php");
    require("../PHPMailer/SMTP.php");

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'eviteam4710@gmail.com';                     //SMTP username
        $mail->Password   = 'cop4710evi';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('eviteam4710@gmail.com', 'EVI EVENT PLANNER');
        $mail->addAddress($email);                                      //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Public Event Rejected by Super Administrator: EVI';
        $mail->Body    = "THANK YOU FOR USING EVI AS YOUR EVENT PLANNER~
                            Unfortunately, your Public Event request has been rejected by your University's Super Administrator. 
                            Reasons may include: inappropriate content, not necessary, etc. 

                            Thank You
                            ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Event Request Decision</title>
    <link rel="stylesheet" href="css/public_request.css" />
</head>

<body>

    <header>
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>Public Event Request</h1>
                <h1><?php echo $public_university ?></h1>
            </div>

            <button onClick="location.href = 'SA_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <div class="public_request">
        <div class="first">
            <label for="public_admin">Admin Name</label><br>
            <h4 id="public_admin">
                <?php echo $public_admin_name ?>
            </h4>
            <br>
            <label for="public_admin_email">Admin Email</label><br>
            <h4 id="public_admin_email">
                <?php echo $public_admin_email ?>
            </h4>
            <br>
            <label for="public_admin_phone">Admin Phone</label><br>
            <h4 id="public_admin_phone">
                <?php echo $public_admin_phone ?>
            </h4>
            <br>
            <label for="public_name">Event Name</label><br>
            <h4 id="public_name">
                <?php echo $public_name ?>
            </h4>
        </div>

        <div class="second">

            <label for="public_description">Description</label><br>
            <h3 id="public_description" rows="4" cols="50">
                <?php echo $public_description ?>
            </h3>

            <div class="third">
                <div class="date">
                    <label for="public_date">Event Date</label><br>
                    <h4 id="public_date">
                        <?php echo $public_date ?>
                    </h4>
                </div>
                <div class="time">
                    <label for="public_time">Event Time</label><br>
                    <h4 id="public_time">
                        <?php
                        echo $public_time_from;
                        echo "-";
                        echo $public_time_to;
                        ?>
                    </h4>
                </div>
            </div>
        </div>

        <div class="fourth">
            <!-- https://www.google.com/maps/search/?api=1&parameters -->
            <label for="public_category">Event Category</label><br>
            <h4 id="public_category">
                <?php echo $public_category ?>
            </h4>
            <br>
            <label for="public_location">Event Location</label><br>
            <h4 id="public_location">
                <?php echo $public_location ?>
            </h4>
            <br>
            <label for="open_maps">Event Location Maps</label><br>
            <a id="open_maps" href="https://www.google.com/maps/search/?api=1&query=<?php echo $new_public_location ?>" target="_blank" rel="noopener noreferrer">
                Open Google Maps
            </a>
        </div>
    </div>

    <div class="decision">
        <form style="text-align: center;" method="POST">
            <button type="submit" class="decision-btn" name="accept_public">ACCEPT</button>
            <button type="submit" class="decision-btn" name="reject_public">REJECT</button>
        </form>
    </div>

    <?php

    if (isset($_POST['accept_public'])) {

        # If Super Admin accepts the Public Event, the row is deleted from 'rso_requests' table 
        # and inserted into 'public_events' table 
        # An acceptance email will be sent to the admin 

        $insert_public = "INSERT INTO `public_events`(`university`, `name`, `date`, `time_from`,`time_to`, `category`, `description`, `location`, `email`, `phone`) VALUES ('$public_university','$public_name','$public_date','$public_time_from','$public_time_to','$public_category','$public_description','$public_location','$public_admin_email',' $public_admin_phone')";
        $delete_public_request = "DELETE FROM `public_requests` WHERE `name`='$public_name' && `university`='$public_university'";

        if (mysqli_query($con, $insert_public) && mysqli_query($con, $delete_public_request) && sendUserAcceptEmail($public_admin_email)) {

            echo "
                 <script>
                    alert('Public Event: $public_name Has Been Created'); 
                    window.location.href='SA_home.php'; 
                </script>
                ";
        } else {
            echo "  
                <script>
                    alert('The Server Is Down. Please Try Again'); 
                    window.location.href='SA_home.php'; 
                </script>";
        }
    } elseif (isset($_POST['reject_public'])) {

        # If Super Admin rejects the RSO, the row is deleted from 'public_requests' table 
        # and a rejection email will be sent to the admin

        $delete_request = "DELETE FROM `public_requests` WHERE `name`='$public_name' && `university`='$public_university'";

        if (mysqli_query($con, $delete_request) && sendUserRejectEmail($public_admin_email)) {

            echo "  
                <script>
                    alert('The Administrator has been notified of their Public Event request rejection'); 
                    window.location.href='SA_home.php'; 
                </script>";
        } else {
            echo "  
                <script>
                    alert('The Server Is Down. Please Try Again'); 
                    window.location.href='SA_home.php'; 
                </script>";
        }
    }


    ?>

</body>

</html>