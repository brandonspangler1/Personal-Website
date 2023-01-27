<?php

require('../db_connection.php');
session_start();

# If Student has not logged in yet, direct the user to the index/login page 
if (isset($_SESSION['student_login_successful']) == null && $_SESSION['student_login_successful'] == false) {

    echo "
        <script>
            alert('Please Login To Access This Page'); 
            window.location.href='../index.php'; 
        </script>
        ";

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/student_account_page.css" />
    <title>Document</title>
</head>
<body>

    <header>
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>Account</h1>
            </div>

            <button onClick="location.href = 'student_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>
    <div class="container">
        <h1>Personal:</h1>
        <div class="accountButtons">
            <button onClick="location.href = '../account_settings/student_account_security.php'">Account Settings</button>
            <button onClick="location.href = 'student_registered_university.php'">Registered University</button>
            <button onClick="location.href = 'student_registered_RSO.php'">Registered RSO's</button>
        </div>
        <h1>RSOs and Events:</h1>
        <div class="miscButtons">
            <button onClick="location.href = 'student_find_RSO.php'">Search RSO's</button>
            <button onClick="location.href = 'student_public_events.php'">Search Public Events</button>
            <button onClick="location.href = 'student_private_events.php'">Search Private Events</button>
        </div>

    </div>
</body>
</html>