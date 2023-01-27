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

if (isset($_GET['name']) && isset($_GET['super'])) {

    $query = "SELECT * FROM `user_information` WHERE `id`='$_GET[super]' AND `username`='$_SESSION[username]'";
    $result = mysqli_query($con, $query);

    if ($result) {

        $fetch_result = mysqli_fetch_assoc($result);

        $email = $fetch_result['email'];
        $university = $_GET['name'];
        $super_id = $_GET['super'];
    }
}

$active = "(A)";
$inactive = "(IA)";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View RSO</title>
    <link rel="stylesheet" href="css/view_rso.css" />
</head>

<body>

    <header>
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>View RSOs</h1>
                <h3>For <?php echo $university; ?></h3>
            </div>

            <button onClick="location.href = 'SA_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>


    <div class="rso">
        <table border="1px">
            <?php

            $query = "SELECT * FROM `rso_members` WHERE `university`='$university' AND `member_email`='$email'";
            $result = mysqli_query($con, $query);

            if ($result) {

                if (mysqli_num_rows($result) > 0) {

                    while ($name = mysqli_fetch_assoc($result)) {

                        $active_status_query = "SELECT * FROM `rso_active` WHERE `name`='$name[rso_name]' AND `university`='$name[university]' AND `admin_name`='$name[admin_name]'";
                        $active_status_result = mysqli_query($con, $active_status_query);
                        if ($active_status_result) {

                            $fetch_active_status = mysqli_fetch_assoc($active_status_result);
                            if ($fetch_active_status['status'] == 0) {

                                $status = $active;
                            } elseif ($fetch_active_status['status'] == 1) {

                                $status = $inactive;
                            }
                        }
            ?>
                        <tr class="names">
                            <td>
                                <button class="event_info" onclick="location.href = 'rso_information.php?name=<?php echo $name['rso_name']; ?>&university=<?php echo $name['university']; ?>'">
                                    <?php
                                    echo "$name[rso_name]";
                                    echo "$status";
                                    echo "<br>";
                                    echo "Admin: $name[admin_name]";
                                    ?>
                                </button>
                                <button class="events" onclick="location.href = 'view_rso_events.php?name=<?php echo $name['rso_name']; ?>&university=<?php echo $university; ?>'">
                                    RSO Events
                                </button>
                                <button class="leave" onclick="location.href = 'leave_rso.php?name=<?php echo $name['rso_name']; ?>&university=<?php echo $university; ?>'">
                                    Leave RSO
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                } else {

                    ?>

                    <div class="no_rso_exist" style="color: black; font-size: 40px; text-align: center; margin: auto; padding: 10px 10px;">
                        <h3>You Have Not Yet Joined Any RSOs For <?php echo $university; ?></h3>
                    </div>

            <?php
                }
            }
            ?>
        </table>
    </div>

    <div class="buttons">
        <a href="find_rso.php?name=<?php echo $university; ?>&super=<?php echo $super_id; ?>">
            Find RSOs
        </a>

        <a href="university_profile.php?name=<?php echo $university; ?>">
            University Home
        </a>
    </div>



</body>

</html>