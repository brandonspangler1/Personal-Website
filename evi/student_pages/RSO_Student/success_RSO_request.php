<?php

require('../../db_connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="refresh" content="3; url=../student_home.php">
    <script>
        setTimeout(function() {
            window.location.href = "../student_home.php"
        }, 8500);;
    </script>
    <title>Confirm RSO Request Student</title>
    <link rel="stylesheet" href="success_RSO_request.css" />
</head>

<body>
    <div class="container">
        <h1>RSO Request Successfully Submitted</h1>
        <h2>Your request is being reviewed by a Super Admin and you will be notified by email of your requests status change.</h2>
        <h2>Please make sure to check your email's spam folder too!</h2>
        <p>You will now be redirected to the home page</p>
    </div>
</body>

</html>