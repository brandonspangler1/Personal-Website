<?php

require('db_connection.php');
session_start();

date_default_timezone_set("EST");

$new_file = 0;

if (!file_exists('feed.json'))
{
    $url = 'https://events.ucf.edu/feed.json';
    $file_name = basename($url);
    
    file_put_contents($file_name, file_get_contents($url));
    $new_file = 1;
}

$current = date("d");
$file =  date("d", filemtime('feed.json'));

// echo $current."<br>";
// echo $file."<br>";

$same_date = strcmp($current, $file);
// echo $same_date."<br>";
// echo $new_file."<br>";


if ($same_date !== 0 || $new_file === 1)
{
    // echo "test";
   include("get_ucf_events.php");
} 




# If Super Administrator Login is successful, direct the user to the SA home page 
if (isset($_SESSION['sa_login_successful']) && $_SESSION['sa_login_successful'] == true) {

    echo "
        <script>
            alert('WELCOME TO EVI!'); 
            window.location.href='super_admin_pages/SA_home.php'; 
        </script>
        ";
}

# If Administrator Login is successful, direct the user to the Admin home page 
if (isset($_SESSION['admin_login_successful']) && $_SESSION['admin_login_successful'] == true) {

    echo "
        <script>
            alert('WELCOME TO EVI!'); 
            window.location.href='admin_pages/admin_home.php'; 
        </script>
        ";
}

# If Student Login is successful, direct the user to the Student home page 
if (isset($_SESSION['student_login_successful']) && $_SESSION['student_login_successful'] == true) {



    $query_uni_status = "SELECT DISTINCT `university_status` 
                FROM `user_information` 
                WHERE `username`= '$_SESSION[username]'";
    $result_status = mysqli_query($con, $query_uni_status);

    $status = mysqli_fetch_assoc($result_status);

    echo "
        <script>
            alert('Welcome to EVI'); 
        </script>
        ";

    if ($status['university_status'] == 1) {
        echo "
                <script>
                    window.location.href='student_pages/student_home.php';
                </script>
                ";
    } else {
        echo "
                <script>
                    window.location.href='student_pages/choose_university.php';
                </script>
                ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COP 4710: Event Calendar</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <header>
        <div class="header_description">
            <h1>EVI</h1>
            <h4>EVENT TRACKER</h4>
        </div>
    </header>

    <div class="welcome">
        <h3>Welcome to EVI</h3>
    </div>

    <!-- Create Clickable Popup Buttons  -->
    <div class="index_buttons">
        <div class="create_account">
            <button type="button" onclick="popup('create-account-popup')">
                CREATE ACCOUNT
            </button>
        </div>
        <br>
        <div class="login_users">
            <button type="button" onclick="popup('login-popup')">
                LOGIN
            </button>
        </div>
        <div class="help_users">
            <button type="button" onclick="popup('help-popup')">
                HELP
            </button>
        </div>
    </div>

    <!-- Create the Popup Containers and Popup Contents -->

    <!-- Create User Account Popup -->
    <div class="popup_container" id="create-account-popup">
        <div class="register_popup">
            <form style="text-align: center;" method="POST" action="account_actions.php">
                <h2>
                    <div>
                        <span>CREATE EVI ACCOUNT</span>
                    </div>
                    <button type="reset" onclick="popup('create-account-popup')">
                        X
                    </button>
                </h2>
                <input type="text" placeholder="Username" name="username" required />
                <br>
                <input type="password" placeholder="Password" name="password" required />
                <br>
                <input type="text" placeholder="Full Name" name="name" required />
                <br>
                <input type="email" placeholder="Email" name="email" required />
                <br>
                <input type="tel" id="phone" placeholder="123-456-7890" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required />
                <br><br>
                <button disabled type="submit" class="sa_register_btn" name="sa_register">
                    CREATE SUPER ADMIN ACCOUNT
                </button>
                <button type="submit" class="sa_register_btn" name="student_register">
                    CREATE STUDENT ACCOUNT
                </button>
            </form>
        </div>
    </div>

    <!-- Login Popup -->
    <div class="popup_container" id="login-popup">
        <div class="login_sa_popup">
            <form style="text-align: center;" method="POST" action="account_actions.php">
                <h2>
                    <span>USER LOGIN</span>
                    <button type="reset" onclick="popup('login-popup')">X</button>
                </h2>
                <input type="text" placeholder="Username" name="username" required />
                <br>
                <input type="password" placeholder="Password" name="password" required />
                <br /><br />
                <button type="submit" class="login-btn" name="sa_login">SUPER ADMIN LOGIN</button>
                <button type="submit" class="login-btn" name="admin_login">ADMINISTRATOR LOGIN</button>
                <button type="submit" class="login-btn" name="stu_login">STUDENT/USER LOGIN</button>
            </form>
            <div class="password-forgot-btn">
                <button type="button" onclick="forgotPassPopup()">
                    Forgot Password
                </button>
            </div>
        </div>
    </div>

    <div class="popup_container" id="forgot-user-popup">
        <div class="forgot user popup">
            <form style="text-align: center" method="POST" action="index_actions/forgot_password_reset.php">
                <h2>
                    <span>PASSWORD RESET</span>
                    <button type="reset" onclick="popup('forgot-user-popup')">X</button>
                </h2>
                <input type="email" placeholder="Email" name="email" required />
                <br /><br />
                <button type="submit" class="preset-btn" name="send-user-password-reset-link">CONFIRM</button>
            </form>
        </div>
    </div>

    <!-- Create User Account Popup -->
    <div class="popup_container" id="help-popup">
        <div class="help_popup">
            <h2>
                <div>
                    <span>EVI Help</span>
                </div>
                <button type="reset" onclick="popup('help-popup')">
                    X
                </button>
            </h2>
            <div class="help_description">
                Welcome to the EVI Event Planner Help Page!
                <br>
                As the user progresses through the EVI Event Planner, the user may become
                confused over the numerous functionalities.
                <br>
                Therefore, for the overall guide to the EVI Event Planner, please refer to the PDF below
                <br>
                Thank You
                <br>
                -- Developers Team
                <br>
                <a href="EVI_Guide_New.pdf" target="_blank" rel="noopener noreferrer">EVI Guide</a>
            </div>
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

        function forgotPassPopup() {

            document.getElementById('login-popup').style.display = "flex";
            document.getElementById('forgot-user-popup').style.display = "flex";

        }
    </script>

</body>

</html>

<!--
    Basically For Commenting ~~

-->