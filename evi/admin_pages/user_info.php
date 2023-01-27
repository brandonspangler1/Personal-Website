<?php

require('../db_connection.php');
session_start();

# If Administrator has not logged in yet, direct the user to the index/login page 
if (isset($_SESSION['admin_login_successful']) == null && $_SESSION['admin_login_successful'] == false) {

    echo "
        <script>
            alert('Please Login To Access This Page'); 
            window.location.href='../index.php'; 
        </script>
        ";
}

$username = $_SESSION['username'];

# Get user information
$query = "SELECT * FROM user_information WHERE username = '$username'";

$result = mysqli_query($con, $query);

$row = mysqli_fetch_assoc($result);

$email = $row['email'];
$uni_id = $row['uni_id'];
$admin_name = $row['name'];

# Get user's corresponding university
$query = "SELECT * FROM `universities` WHERE `id` = '$uni_id'";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$uni_name = $row["name"];
$picture_link = $row['picture_link'];
$_SESSION['current_uni'] = $uni_name;

#Get user's owned RSOs and store in array
$query = "SELECT * FROM rso_active WHERE admin_email = '$email'";
$result = mysqli_query($con, $query);

$rso_names = array();

$num_rows = mysqli_num_rows($result);

for ($x = 0; $x < $num_rows; $x++)
{
    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];

    array_push($rso_names, $name);
}

$events = array();
array_push($events, 'public');
array_push($events, 'private');
array_push($events, 'rso');
?>