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

$query = "SELECT * FROM `user_information` WHERE `username`= '$_SESSION[username]'";
$result = mysqli_query($con, $query);
$fetch_result = mysqli_fetch_assoc($result);
$uni = $fetch_result['uni_id'];
$fullName = $fetch_result['name'];

$query = "SELECT * FROM `universities` WHERE `id` = '$uni'";
$result = mysqli_query($con, $query);
$fetch_result = mysqli_fetch_assoc($result);
$uni = $fetch_result['name'];

$query = "SELECT * FROM `rso_active` WHERE `university`= '$uni'";
$result = mysqli_query($con, $query);

if ($result) {

    $fetch_result = mysqli_fetch_assoc($result);

    $name = $fetch_result['name'];
    $university = $fetch_result['university'];
    $admin_name = $fetch_result['admin_name'];
    $admin_email = $fetch_result['admin_email'];
    // $super = $_GET['super'];
}


$user_info = "SELECT * FROM `user_information` WHERE `username`='$_SESSION[username]'";
$user_query = mysqli_query($con, $user_info);

if ($user_query) {

    $fetch_user = mysqli_fetch_assoc($user_query);

    $user_email = $fetch_user['email'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered RSOs</title>
    <link rel="stylesheet" href="css/student_registered_RSO.css" />
</head>

<body>

    <div class="rso">
        <div class="navigationBar">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>Registered RSOs</h1>
                <h3>For <?php echo $fullName; ?></h3>
            </div>

            <button onClick="location.href = 'student_home.php'"><img src="../images/home.png"></button>
        </div>
        <div class="lists">
            <table border="1px">
                <?php

                $queryEmail = "SELECT `email` FROM `user_information` WHERE `username` = '$_SESSION[username]'";
                $resultEmail = mysqli_query($con, $queryEmail);
                $userEmail = mysqli_fetch_assoc($resultEmail);
                $email = $userEmail['email'];
                
                // $query = "SELECT * FROM `rso_members` WHERE `member_email` = '$email'";
                $query = "SELECT DISTINCT (`rso_name`) `member_email`, `rso_name`, `university`, `admin_name` FROM `rso_members` WHERE `member_email` = '$email'";
                $result = mysqli_query($con, $query);
                

                // $query = "SELECT * FROM `rso_active` WHERE `university`= '$uni'";
                // $result = mysqli_query($con, $query);

                if ($result) {

                    if (mysqli_num_rows($result) > 0) {

                        while ($name = mysqli_fetch_assoc($result)) {
                ?>
                            <tr class="names">
                                <td>
                                    <button class="event_info" onclick="location.href = 'student_RSO_information.php?name=<?php echo $name['rso_name']; ?>&university=<?php echo $name['university']; ?>'">
                                        <?php
                                        echo "$name[rso_name]";
                                        echo "<br>";
                                        // echo "Admin: $name[admin_name]";
                                        ?>
                                    </button>
                                </td>
                            </tr>
                <?php
                        }
                    }
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>