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

    $rso_name = $_GET['name'];
    $university = $_GET['university'];
}

$user_query = "SELECT * FROM `user_information` WHERE `username`='$_SESSION[username]'";
$user_result = mysqli_query($con, $user_query);

if ($user_result) {

    $fetch_user = mysqli_fetch_assoc($user_result);

    $user_email = $fetch_user['email'];
    $super = $fetch_user['id'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave RSO</title>
    <link rel="stylesheet" href="css/leave_rso.css" />
</head>

<body>

    <header>
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>Leave RSO</h1>
                <h3>For <?php echo $rso_name ?></h3>
                <h3>at <?php echo $university; ?></h3>
            </div>

            <button onClick="location.href = 'SA_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <div class="confirmation">
        <form style="text-align: center;" method="POST">
            <div class="message">
                <h1>Are you sure you want to leave this RSO?</h1>
            </div>
            <div>
                <button name="accept">
                    YES
                </button>

                <button name="decline">
                    NO
                </button>
            </div>
        </form>
    </div>

    <?php

    if (isset($_POST['accept'])) {

        $leave_query = "DELETE FROM `rso_members` WHERE `member_email`='$user_email' AND `rso_name`='$rso_name' AND `university`='$university'";
        $leave_result = mysqli_query($con, $leave_query);

        if ($leave_result) {

            $member_check = "SELECT * FROM `rso_members` WHERE `rso_name`='$rso_name' AND `university`='$university'";
            $member_result = mysqli_query($con, $member_check);

            if ($member_result) {

                $num_members = mysqli_num_rows($member_result);

                if ($num_members < 5) {

                    $update_active_status = "UPDATE `rso_active` SET `status`='1' WHERE `name`='$rso_name' AND `university`='$university'";
                    $update_result = mysqli_query($con, $update_active_status);

                    if ($update_result) {

                        echo "
                            <script>
                                alert('You have left the RSO ~'); 
                                window.location.href='view_rso.php?name=$university&super=$super'; 
                            </script>";
                        exit;
                    } else {

                        echo "
                            <script>
                                alert('Server Is Down. Please Try Again ~'); 
                                window.location.href='SA_home.php'; 
                            </script>";
                    }
                } else {

                    $update_active_status = "UPDATE `rso_active` SET `status`='0' WHERE `name`='$rso_name' AND `university`='$university'";
                    $update_result = mysqli_query($con, $update_active_status);

                    if ($update_result) {

                        echo "
                            <script>
                                alert('You have left the RSO ~'); 
                                window.location.href='view_rso.php?name=$university&super=$super'; 
                            </script>";
                        exit;
                    } else {

                        echo "
                            <script>
                                alert('Server Is Down. Please Try Again ~'); 
                                window.location.href='SA_home.php'; 
                            </script>";
                    }
                }
            }
        }
    }

    if (isset($_POST['decline'])) {

        echo "
        <script>
            alert('You have stayed in the RSO ~'); 
            window.location.href='view_rso.php?name=$university&super=$super'; 
        </script>";
        exit;
    }

    ?>

</body>

</html>