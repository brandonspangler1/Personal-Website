<?php

require('db_connection.php');
session_start();

use PHPMailer\PHPMailer\Exception;        #PHP Mailer Github 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function sendUserEmail($veri_code, $email)
{

    require("PHPMailer/Exception.php");
    require("PHPMailer/PHPMailer.php");
    require("PHPMailer/SMTP.php");

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

# For Create SUPER ADMINISTRATOR Account 
if (isset($_POST['sa_register'])) {

    $user_exist_query = "SELECT * FROM `user_information` WHERE `username` = '$_POST[username]' OR `email` = '$_POST[email]'";
    $result = mysqli_query($con, $user_exist_query);

    if ($result) {

        # if username is already in the database when creating super admin account 
        if (mysqli_num_rows($result) > 0) {

            $result_fetch = mysqli_fetch_assoc($result);
            # Check if username already exists 
            if ($result_fetch['username'] == $_POST['username'] or $result_fetch['email'] == $_POST['email']) {

                echo "<script>
                    alert('Username And/or Email Already Exists'); 
                    window.location.href='index.php'; 
                    </script>";
            }
        }
        # if user_email does not already exist in the database, insert the user information 
        else {

            # ENCRYPT THE PASSWORD 
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            # Generate a Random Verification Code (Unique for Each User) 
            $veri_code = bin2hex(random_bytes(16));

            $query = "INSERT INTO `user_information`(`username`, `password`, `name`, `email`, `phone`,`verification_code`, `verification_status`, `user_status`) VALUES ('$_POST[username]','$password','$_POST[name]','$_POST[email]','$_POST[phone]','$veri_code','0', '2')";
            if (mysqli_query($con, $query) && sendUserEmail($veri_code, $_POST['email'])) {

                echo "<script>
                    alert('Account Creation Successful. Please check your email to verify in order to log in. Please check your emails spam folder too!'); 
                    window.location.href='index.php'; 
                    </script>";
            } else {

                echo "<script>
                    alert('The Server Is Currently Down. Please Try Again'); 
                    window.location.href='index.php'; 
                    </script>";
            }
        }
    } else {

        echo "<script>
            alert('Query Cannot Be Run'); 
            window.location.href='index.php'; 
            </script>";
    }
}

# For Create STUDENT Account 
if (isset($_POST['student_register'])) {

    $user_exist_query = "SELECT * FROM `user_information` WHERE `username` = '$_POST[username]' OR `email` = '$_POST[email]'";
    $result = mysqli_query($con, $user_exist_query);

    if ($result) {

        # if username is already in the database when creating super admin account 
        if (mysqli_num_rows($result) > 0) {

            $result_fetch = mysqli_fetch_assoc($result);
            # Check if username already exists 
            if ($result_fetch['username'] == $_POST['username'] or $result_fetch['email'] == $_POST['email']) {

                echo "<script>
                    alert('Username And/or Email Already Exists'); 
                    window.location.href='index.php'; 
                    </script>";
            }
        }
        # if user_email does not already exist in the database, insert the user information 
        else {

            # ENCRYPT THE PASSWORD 
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            # Generate a Random Verification Code (Unique for Each User) 
            $veri_code = bin2hex(random_bytes(16));

            $query = "INSERT INTO `user_information`(`username`, `password`, `name`, `email`, `phone`,`verification_code`, `verification_status`) VALUES ('$_POST[username]','$password','$_POST[name]','$_POST[email]','$_POST[phone]','$veri_code','0')";
            if (mysqli_query($con, $query) && sendUserEmail($veri_code, $_POST['email'])) {

                echo "<script>
                    alert('Account Creation Successful. Please check your email to verify in order to log in. Please check your emails spam folder too!'); 
                    window.location.href='index.php'; 
                    </script>";
            } else {

                echo "<script>
                    alert('The Server Is Currently Down. Please Try Again'); 
                    window.location.href='index.php'; 
                    </script>";
            }
        }
    } else {

        echo "<script>
            alert('Query Cannot Be Run'); 
            window.location.href='index.php'; 
            </script>";
    }
}

# For Super Administrator Login 
if (isset($_POST['sa_login'])) {

    $query = "SELECT * FROM `user_information` WHERE `username` = '$_POST[username]'";
    $result = mysqli_query($con, $query);

    if ($result) {

        # Check if user's username exists in the server 
        if (mysqli_num_rows($result) == 1) {

            $result_fetch = mysqli_fetch_assoc($result);
            # Check if username has been verified through email
            if ($result_fetch['verification_status'] == 1) {

                # If PASSWORDS match
                if (password_verify($_POST['password'], $result_fetch['password'])) {

                    # Check if user is a Super Admin
                    if ($result_fetch['user_status'] == 2) {

                        $_SESSION['sa_login_successful'] = true;
                        $_SESSION['username'] = $result_fetch['username'];
                        header("Location: index.php");
                    } else {

                        echo "
                            <script>
                                alert('You Are Not A Super Administrator. Please Login Using The Appropriate Login Button'); 
                                window.location.href='index.php'; 
                            </script>
                            ";
                    }
                }
                # If PASSWORDS do not match 
                else {

                    echo "<script>
                        alert('Password Is Incorrect. Please Check Your Password'); 
                        window.location.href='index.php'; 
                        </script>";
                }
            }
            # Else if user has not been verified through email 
            else {

                echo "<script>
                        alert('User Email Has Not Been Verified Yet. Please Verify Your Email'); 
                        window.location.href='index.php'; 
                    </script>";
            }
        }
        # Else if user's email does not exist in the server 
        else {

            echo "<script>
                alert('Username Entered Does Not Exist'); 
                window.location.href='index.php'; 
                </script>";
        }
    } else {

        echo "<script>
            alert('Query Cannot Be Run'); 
            window.location.href='index.php'; 
            </script>";
    }
}

# For Administrator Login 
if (isset($_POST['admin_login'])) {

    $query = "SELECT * FROM `user_information` WHERE `username` = '$_POST[username]'";
    $result = mysqli_query($con, $query);

    if ($result) {

        # Check if user's username exists in the server 
        if (mysqli_num_rows($result) == 1) {

            $result_fetch = mysqli_fetch_assoc($result);
            # Check if username has been verified through email
            if ($result_fetch['verification_status'] == 1) {

                # If PASSWORDS match
                if (password_verify($_POST['password'], $result_fetch['password'])) {

                    # Check if the User is an Admin (user_status = 1) 
                    if ($result_fetch['user_status'] == 1) {

                        $_SESSION['admin_login_successful'] = true;
                        $_SESSION['username'] = $result_fetch['username'];
                        header("Location: index.php");
                    } else {
                        echo "<script>
                                alert('You Are Not An Administrator. Please Login Using The Appropriate Login Button'); 
                                window.location.href='index.php'; 
                            </script>";
                    }
                }
                # If PASSWORDS do not match 
                else {

                    echo "<script>
                            alert('Password Is Incorrect. Please Check Your Password'); 
                            window.location.href='index.php'; 
                        </script>";
                }
            }
            # Else if user has not been verified through email 
            else {

                echo "<script>
                        alert('User Email Has Not Been Verified Yet. Please Verify Your Email'); 
                        window.location.href='index.php'; 
                    </script>";
            }
        }
        # Else if user's email does not exist in the server 
        else {

            echo "<script>
                alert('Username Entered Either Does Not Exist Or Is Not An Administrator'); 
                window.location.href='index.php'; 
                </script>";
        }
    } else {

        echo "<script>
            alert('Query Cannot Be Run'); 
            window.location.href='index.php'; 
            </script>";
    }
}

# For Student Login 
if (isset($_POST['stu_login'])) {

    $query = "SELECT * FROM `user_information` WHERE `username` = '$_POST[username]'";
    $result = mysqli_query($con, $query);

    if ($result) {

        # Check if user's username exists in the server 
        if (mysqli_num_rows($result) == 1) {

            $result_fetch = mysqli_fetch_assoc($result);
            # Check if username has been verified through email
            if ($result_fetch['verification_status'] == 1) {

                # If PASSWORDS match
                if (password_verify($_POST['password'], $result_fetch['password'])) {

                    # Check if the User is an Admin (user_status = 1) 
                    if ($result_fetch['user_status'] == 1 || $result_fetch['user_status'] == 0) {

                        $_SESSION['student_login_successful'] = true;
                        $_SESSION['username'] = $result_fetch['username'];
                        header("Location: index.php");
                    } else {

                        echo "<script>
                                alert('You Are Not A Student. Please Login Using The Appropriate Login Button'); 
                                window.location.href='index.php'; 
                            </script>";
                    }
                }
                # If PASSWORDS do not match 
                else {

                    echo "<script>
                        alert('Password Is Incorrect. Please Check Your Password'); 
                        window.location.href='index.php'; 
                        </script>";
                }
            }
            # Else if user has not been verified through email 
            else {

                echo "<script>
                        alert('User Email Has Not Been Verified Yet. Please Verify Your Email'); 
                        window.location.href='index.php'; 
                    </script>";
            }
        }
        # Else if user's email does not exist in the server 
        else {

            echo "<script>
                alert('Username Entered Does Not Exist'); 
                window.location.href='index.php'; 
                </script>";
        }
    } else {

        echo "<script>
            alert('Query Cannot Be Run'); 
            window.location.href='index.php'; 
            </script>";
    }
}
