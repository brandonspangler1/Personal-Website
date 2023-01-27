<?php

require('../db_connection.php');
session_start();

$query = "SELECT * FROM `user_information` WHERE `username`='$_SESSION[username]'";
$result = mysqli_query($con, $query);

if ($result) {

    $info = mysqli_fetch_assoc($result);

    $name = $info["name"];
    $email = $info["email"];
    $username = $info["username"];
    $phone = $info["phone"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link rel="stylesheet" href="account_security.css" />
</head>

<body>

    <header>
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>Account</h1>
                <h1>Login & Security</h1>
            </div>

            <button onClick="location.href = '../super_admin_pages/SA_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <div class="account">
        <div class="name">
            <div class="title">
                <h3>NAME</h3>
            </div>
            <div class="change_name">
                <div class="db_name">
                    <h4><?= $name ?></h4>
                </div>
                <div class="update_name">
                    <button type="button" onclick="popup('name-popup')">
                        EDIT
                    </button>
                </div>
            </div>
        </div>

        <div class="email">
            <div class="title">
                <h3>EMAIL</h3>
            </div>
            <div class="change_email">
                <div class="db_email">
                    <h4><?= $email ?></h4>
                </div>
                <div class="update_email">
                    <button type="button" onclick="popup('email-popup')">
                        EDIT
                    </button>
                </div>
            </div>
        </div>

        <div class="username">
            <div class="title">
                <h3>USERNAME</h3>
            </div>
            <div class="change_username">
                <div class="db_username">
                    <h4><?= $username ?></h4>
                </div>
                <div class="update_username">
                    <button type="button" onclick="popup('username-popup')">
                        EDIT
                    </button>
                </div>
            </div>
        </div>

        <div class="password">
            <div class="title">
                <h3>PASSWORD</h3>
            </div>
            <div class="change_password">
                <div class="db_password">
                    <h4>HIDDEN</h4>
                </div>
                <div class="update_password">
                    <button type="button" onclick="popup('password-popup')">
                        EDIT
                    </button>
                </div>
            </div>
        </div>

        <div class="phone">
            <div class="title">
                <h3>PHONE</h3>
            </div>
            <div class="change_phone">
                <div class="db_phone">
                    <h4><?= $phone ?></h4>
                </div>
                <div class="update_phone">
                    <button type="button" onclick="popup('phone-popup')">
                        EDIT
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="popup_container" id="name-popup">
        <div class="name popup">
            <form style="text-align: center" method="POST">
                <h2>
                    <span>NAME CHANGE</span>
                    <button type="reset" onclick="popup('name-popup')">X</button>
                </h2>
                <input type="text" placeholder="FULL NAME" name="name" required />
                <br /><br />
                <button type="submit" class="change-btn" name="name_change">SUBMIT</button>
            </form>
        </div>
    </div>

    <div class="popup_container" id="email-popup">
        <div class="email popup">
            <form style="text-align: center" method="POST">
                <h2>
                    <span>EMAIL CHANGE</span>
                    <button type="reset" onclick="popup('email-popup')">X</button>
                </h2>
                <input type="email" placeholder="Email" name="email" required />
                <br /><br />
                <button type="submit" class="change-btn" name="email_change">SUBMIT</button>
            </form>
        </div>
    </div>

    <div class="popup_container" id="username-popup">
        <div class="username popup">
            <form style="text-align: center" method="POST">
                <h2>
                    <span>USERNAME CHANGE</span>
                    <button type="reset" onclick="popup('username-popup')">X</button>
                </h2>
                <input type="text" placeholder="Username" name="username" required />
                <br /><br />
                <button type="submit" class="change-btn" name="username_change">SUBMIT</button>
            </form>
        </div>
    </div>

    <div class="popup_container" id="password-popup">
        <div class="password popup">
            <form style="text-align: center" method="POST">
                <h2>
                    <span>PASSWORD CHANGE</span>
                    <button type="reset" onclick="popup('password-popup')">X</button>
                </h2>
                <input type="password" placeholder="Password" name="password" required />
                <br /><br />
                <button type="submit" class="change-btn" name="password_change">SUBMIT</button>
            </form>
        </div>
    </div>

    <div class="popup_container" id="phone-popup">
        <div class="phone popup">
            <form style="text-align: center" method="POST">
                <h2>
                    <span>PHONE CHANGE</span>
                    <button type="reset" onclick="popup('phone-popup')">X</button>
                </h2>
                <input type="tel" id="phone" placeholder="123-456-7890" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required />
                <br /><br />
                <button type="submit" class="change-btn" name="phone_change">SUBMIT</button>
            </form>
        </div>
    </div>

    <script>
        function popup(popup_type) {

            get_popup = document.getElementById(popup_type);

            if (get_popup.style.display == "flex") {
                get_popup.style.display = "none";
            } else {
                get_popup.style.display = "flex";
            }
        }
    </script>

    <?php

    use PHPMailer\PHPMailer\Exception;        #PHP Mailer Github 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    # Send User Password Reset Email
    function sendUserEmail($veri_code, $email)
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
            $mail->Subject = 'Email Verification: EVI';
            $mail->Body    = "Thank You for creating an EVI Event Planner account! 
                            Please verify your email address through the link below. 
                            <a href = 'https://brandonspangler.com/evi/index_actions/email_USER_verification.php?email=$email&veri_code=$veri_code'>Verify Email</a>
                            ";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    # For Name Change 
    if (isset($_POST['name_change'])) {

        $query = "SELECT * FROM `user_information` WHERE `username`='$_SESSION[username]'";
        $result = mysqli_query($con, $query);

        if ($result) {

            # Check if user's information exists in the server 
            if (mysqli_num_rows($result) == 1) {

                $query = "UPDATE `user_information` SET `name`='$_POST[name]' WHERE `username`='$_SESSION[username]'";

                if (mysqli_query($con, $query)) {

                    echo "<script>
                        alert('Name Change Successful'); 
                        window.location.href='SA_account_security.php'; 
                        </script>";
                } else {

                    echo "<script>
                        alert('The Server Is Currently Down. Please Try Again'); 
                        window.location.href='SA_account_security.php'; 
                        </script>";
                }
            }
            # if user's information does not already exist in the database, alert the user 
            else {

                echo "<script>
                        alert('Your Session Has Expired. Please Logout and Login'); 
                        window.location.href='SA_account_security.php'; 
                    </script>";
            }
        } else {

            echo "<script>
                alert('The Query Cannot Be Run'); 
                window.location.href='SA_account_security.php'; 
                </script>";
        }
    }

    # For Email Change 
    if (isset($_POST['email_change'])) {

        $query = "SELECT * FROM `user_information` WHERE `username`='$_SESSION[username]'";
        $result = mysqli_query($con, $query);

        if ($result) {

            # Check if user's information exists in the server 
            if (mysqli_num_rows($result) == 1) {

                # Generate a Random Verification Code (Unique for Each User) 
                $veri_code = bin2hex(random_bytes(16));

                $query = "UPDATE `user_information` SET `email`='$_POST[email]',`verification_code`='$veri_code',`verification_status`='0' WHERE `username`='$_SESSION[username]'";

                # Update User Email and send an email verification to the user 
                if (mysqli_query($con, $query) && sendUserEmail($veri_code, $_POST['email'])) {

                    echo "<script>
                        alert('Email Change Successful. Please Verify Your Email and make sure to check your spam folder too! You may continue to use the website, but may experience problems. Please log out and log back in. '); 
                        window.location.href='SA_account_security.php'; 
                        </script>";
                } else {

                    echo "<script>
                            alert('The Server Is Currently Down. Please Try Again'); 
                            window.location.href='SA_account_security.php'; 
                        </script>";
                }
            }
            # if user's information does not already exist in the database, alert the user 
            else {

                echo "<script>
                        alert('Your Session Has Expired. Please Logout and Login'); 
                        window.location.href='SA_account_security.php'; 
                    </script>";
            }
        } else {

            echo "<script>
                    alert('The Query Cannot Be Run'); 
                    window.location.href='SA_account_security.php'; 
                </script>";
        }
    }

    # For Username Change 
    if (isset($_POST['username_change'])) {

        $query = "SELECT * FROM `user_information` WHERE `username`='$_SESSION[username]'";
        $result = mysqli_query($con, $query);

        if ($result) {

            # Check if user's information exists in the server 
            if (mysqli_num_rows($result) == 1) {

                $query = "UPDATE `user_information` SET `username`='$_POST[username]' WHERE `username`='$_SESSION[username]'";

                if (mysqli_query($con, $query)) {

                    $_SESSION['username'] = $_POST['username'];

                    echo "<script>
                        alert('Username Change Successful'); 
                        window.location.href='SA_account_security.php'; 
                        </script>";
                } else {

                    echo "<script>
                        alert('The Server Is Currently Down. Please Try Again'); 
                        window.location.href='SA_account_security.php'; 
                        </script>";
                }
            }
            # if user's information does not already exist in the database, alert the user 
            else {

                echo "<script>
                        alert('Your Session Has Expired. Please Logout and Login'); 
                        window.location.href='SA_account_security.php'; 
                    </script>";
            }
        } else {

            echo "<script>
                alert('The Query Cannot Be Run'); 
                window.location.href='SA_account_security.php'; 
                </script>";
        }
    }

    # For Password Change 
    if (isset($_POST['password_change'])) {

        $query = "SELECT * FROM `user_information` WHERE `username`='$_SESSION[username]'";
        $result = mysqli_query($con, $query);

        if ($result) {

            # Check if user's information exists in the server 
            if (mysqli_num_rows($result) == 1) {

                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                $query = "UPDATE `user_information` SET `password`='$password' WHERE `username`='$_SESSION[username]'";

                if (mysqli_query($con, $query)) {

                    echo "<script>
                        alert('Password Change Successful'); 
                        window.location.href='SA_account_security.php'; 
                        </script>";
                } else {

                    echo "<script>
                        alert('The Server Is Currently Down. Please Try Again'); 
                        window.location.href='SA_account_security.php'; 
                        </script>";
                }
            }
            # if user's information does not already exist in the database, alert the user 
            else {

                echo "<script>
                        alert('Your Session Has Expired. Please Logout and Login'); 
                        window.location.href='SA_account_security.php'; 
                    </script>";
            }
        } else {

            echo "<script>
                alert('The Query Cannot Be Run'); 
                window.location.href='SA_account_security.php'; 
                </script>";
        }
    }

    # For Phone Change 
    if (isset($_POST['phone_change'])) {

        $query = "SELECT * FROM `user_information` WHERE `username`='$_SESSION[username]'";
        $result = mysqli_query($con, $query);

        if ($result) {

            # Check if user's information exists in the server 
            if (mysqli_num_rows($result) == 1) {

                $query = "UPDATE `user_information` SET `phone`='$_POST[phone]' WHERE `username`='$_SESSION[username]'";

                if (mysqli_query($con, $query)) {

                    echo "<script>
                        alert('Phone Change Successful'); 
                        window.location.href='SA_account_security.php'; 
                        </script>";
                } else {

                    echo "<script>
                        alert('The Server Is Currently Down. Please Try Again'); 
                        window.location.href='SA_account_security.php'; 
                        </script>";
                }
            }
            # if user's information does not already exist in the database, alert the user 
            else {

                echo "<script>
                        alert('Your Session Has Expired. Please Logout and Login'); 
                        window.location.href='SA_account_security.php'; 
                    </script>";
            }
        } else {

            echo "<script>
                alert('The Query Cannot Be Run'); 
                window.location.href='SA_account_security.php'; 
                </script>";
        }
    }

    ?>

</body>

</html>