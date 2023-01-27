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

    $query = "SELECT * FROM `rso_requests` WHERE `name`='$_GET[name]' AND `university`='$_GET[university]'";
    $result = mysqli_query($con, $query);

    if ($result) {

        $fetch_result = mysqli_fetch_assoc($result);

        $rso_name = $fetch_result['name'];
        $rso_admin = $fetch_result['admin_name'];
        $rso_university = $fetch_result['university'];
        $rso_description = $fetch_result['description'];
        $rso_member_one = $fetch_result['member_one'];
        $rso_member_two = $fetch_result['member_two'];
        $rso_member_three = $fetch_result['member_three'];
        $rso_member_four = $fetch_result['member_four'];
        $rso_super_id = $fetch_result['super_admin_id'];
        $rso_admin_email = $fetch_result['admin_email'];
    }
}

use PHPMailer\PHPMailer\Exception;        #PHP Mailer Github 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

# Send Admin an Email for RSO Accepted 
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
        $mail->Subject = 'RSO Accepted by Super Administrator: EVI';
        $mail->Body    = "THANK YOU FOR USING EVI AS YOUR EVENT PLANNER~
                            Your RSO request has been approved by the Super Administrator. 
                            You may view and access your RSO on your Admin Home Page. 
                            If you are not yet an Administrator, your user status has been updated, 
                            so please log in using your same student username and password and by 
                            clicking the Administrator Login button. 

                            Thank You 
                            ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

# Send Admin an Email for RSO Rejected 
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
        $mail->Subject = 'RSO Rejected by Super Administrator: EVI';
        $mail->Body    = "THANK YOU FOR USING EVI AS YOUR EVENT PLANNER~
                            Unfortunately, your RSO request has been rejected by your University's Super Administrator. 

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
    <title>RSO Request Decision</title>
    <link rel="stylesheet" href="css/rso_request.css" />
</head>

<body>

    <header>
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>RSO Request</h1>
            </div>

            <button onClick="location.href = 'SA_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <div class="rso_request">
        <div class="names">
            <label for="rso_name">RSO Name</label><br>
            <h4 id="rso_name">
                <?php echo $rso_name ?>
            </h4>
            <br>
            <label for="rso_admin">Admin Information</label><br>
            <h3 id="rso_admin">
                <?php echo "$rso_admin - $rso_admin_email" ?>
            </h3>
            <br>
            <label for="rso_members">Member Emails</label><br>
            <h3 id="rso_members">
                <?php echo $rso_member_one ?>
            </h3>
            <h3 id="rso_members">
                <?php echo $rso_member_two ?>
            </h3>
            <h3 id="rso_members">
                <?php echo $rso_member_three ?>
            </h3>
            <h3 id="rso_members">
                <?php echo $rso_member_four ?>
            </h3>
        </div>

        <div class="description">

            <label for="rso_description">Description</label><br>
            <h3 id="rso_description" rows="4" cols="50">
                <?php echo $rso_description ?>
            </h3>

            <div class="decision">
                <form style="text-align: center;" method="POST">
                    <button type="submit" class="decision-btn" name="accept_rso">ACCEPT</button>
                    <button type="submit" class="decision-btn" name="reject_rso">REJECT</button>
                </form>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['accept_rso'])) {

        # If Super Admin accepts the RSO, the row is deleted from 'rso_requests' table and inserted into 'rso_events' table 
        # The members will be added to the members table 'rso_members' and finally an acceptance email will be sent to the admin 

        $insert_rso = "INSERT INTO `rso_active`(`super_admin_id`, `name`, `university`, `admin_name`, `admin_email`, `description`) VALUES ('$rso_super_id','$rso_name','$rso_university','$rso_admin','$rso_admin_email','$rso_description')";
        $insert_member_one = "INSERT INTO `rso_members`(`member_email`, `rso_name`, `university`, `admin_name`) VALUES ('$rso_member_one','$rso_name','$rso_university','$rso_admin')";
        $insert_member_two = "INSERT INTO `rso_members`(`member_email`, `rso_name`, `university`, `admin_name`) VALUES ('$rso_member_two','$rso_name','$rso_university','$rso_admin')";
        $insert_member_three = "INSERT INTO `rso_members`(`member_email`, `rso_name`, `university`, `admin_name`) VALUES ('$rso_member_three','$rso_name','$rso_university','$rso_admin')";
        $insert_member_four = "INSERT INTO `rso_members`(`member_email`, `rso_name`, `university`, `admin_name`) VALUES ('$rso_member_four','$rso_name','$rso_university','$rso_admin')";
        $insert_member_admin = "INSERT INTO `rso_members`(`member_email`, `rso_name`, `university`, `admin_name`) VALUES ('$rso_admin_email','$rso_name','$rso_university','$rso_admin')";
        $delete_rso_request = "DELETE FROM `rso_requests` WHERE `name`='$rso_name' && `university`='$rso_university'";

        if (
            mysqli_query($con, $insert_rso) && mysqli_query($con, $insert_member_one) && mysqli_query($con, $insert_member_two)
            && mysqli_query($con, $insert_member_three) && mysqli_query($con, $insert_member_four) && mysqli_query($con, $delete_rso_request) && mysqli_query($con, $insert_member_admin)
        ) {

            # Now check the user_status and if it is 0, promote it to 1 and if it is 1, don't update anything
            $user_check = "SELECT * FROM `user_information` WHERE `name`='$rso_admin' && `email`='$rso_admin_email'";
            $user_check_result = mysqli_query($con, $user_check);

            if ($user_check_result) {

                $fetch_user_check = mysqli_fetch_assoc($user_check_result);

                # Check if user is a student: user_status == 0
                if ($fetch_user_check['user_status'] == 0) {

                    $update_query = "UPDATE `user_information` SET `user_status`='1' WHERE `name`='$rso_admin' && `email`='$rso_admin_email'";
                    if (mysqli_query($con, $update_query) && sendUserAcceptEmail($rso_admin_email)) {

                        echo "
                        <script>
                            alert('RSO: $rso_name Has Been Created'); 
                            window.location.href='SA_home.php'; 
                        </script>
                        ";
                    }
                }
                # If user is already an administrator: user_status == 1
                else {

                    if (sendUserAcceptEmail($rso_admin_email)) {

                        echo "
                        <script>
                            alert('RSO: $rso_name Has Been Created'); 
                            window.location.href='SA_home.php'; 
                        </script>
                        ";
                    }
                }
            }
        } else {
            echo "  
                <script>
                    alert('The Server Is Down. Please Try Again'); 
                    window.location.href='SA_home.php'; 
                </script>";
        }
    } elseif (isset($_POST['reject_rso'])) {

        # If Super Admin rejects the RSO, the row is deleted from 'rso_requests' table 
        # and a rejection email will be sent to the student 

        $delete_request = "DELETE FROM `rso_requests` WHERE `name`='$rso_name' && `university`='$rso_university'";

        if (mysqli_query($con, $delete_request) && sendUserRejectEmail($rso_admin_email)) {

            echo "  
                <script>
                    alert('The Student has been notified of their RSO request rejection'); 
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