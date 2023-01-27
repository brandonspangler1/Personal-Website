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

    $rso = $_GET['name'];
    $uni = $_GET['university'];

    $query = "SELECT * FROM `rso_events` WHERE `rso_name`='$_GET[name]' AND `university`='$_GET[university]'";
    $result = mysqli_query($con, $query);

    if ($result) {

        $fetch_result = mysqli_fetch_assoc($result);

        $university = $fetch_result['university'];
        $rso_name = $fetch_result['rso_name'];
        $event_name = $fetch_result['name'];
        $event_date = $fetch_result['date'];
        $event_time_from = $fetch_result['time_from'];
        $event_time_to = $fetch_result['time_to'];
        $event_category = $fetch_result['category'];
        $event_description = $fetch_result['description'];
        $event_location = $fetch_result['location'];
        $event_email = $fetch_result['email'];
        $event_phone = $fetch_result['phone'];
    }
}

$user_query = "SELECT * FROM `user_information` WHERE `username`='$_SESSION[username]'";
$user_result = mysqli_query($con, $user_query);

if ($user_result) {

    $fetch_user = mysqli_fetch_assoc($user_result);

    $super = $fetch_user['id'];
    $user_email = $fetch_user['email'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View RSO Events</title>
    <link rel="stylesheet" href="css/view_rso_events.css" />
</head>

<body>

    <header>
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>View RSO Events</h1>
                <h3>For <?php echo $rso ?></h3>
                <h3>at <?php echo $uni; ?></h3>
            </div>

            <button onClick="location.href = 'SA_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <div class="rso_events">
        <div class="lists">
            <table border="1px">
                <?php

                $query = "SELECT * FROM `rso_events` WHERE `university`='$university' AND `rso_name`='$rso_name'";
                $result = mysqli_query($con, $query);

                if ($result) {

                    if (mysqli_num_rows($result) > 0) {

                        while ($name = mysqli_fetch_assoc($result)) {

                            $new_university = str_replace(' ', '+', $name['university']);
                            $out_university = str_replace(' ', '%20', $name['university']);
                            $new_rso_name = str_replace(' ', '+', $name['rso_name']);
                            $out_rso_name = str_replace(' ', '%20', $name['rso_name']);
                            $new_name = str_replace(' ', '+', $name['name']);
                            $out_name = str_replace(' ', '%20', $name['name']);
                            $new_date = str_replace('-', '', $name['date']);
                            $new_time_from = str_replace(':', '', $name['time_from']);
                            $new_time_to = str_replace(':', '', $name['time_to']);
                            $new_category = str_replace(' ', '+', $name['category']);
                            $out_category = str_replace(' ', '%20', $name['category']);
                            $new_description = str_replace(' ', '+', $name['description']);
                            $out_description = str_replace(' ', '%20', $name['description']);
                            $new_location = str_replace(' ', '+', $name['location']);
                            $out_location = str_replace(' ', '%20', $name['location']);
                            $admin_email = $name['email'];
                            $admin_phone = $name['phone'];

                ?>

                            <tr class="names">
                                <td>
                                    <a href="https://www.google.com/calendar/render?action=TEMPLATE&text=<?php echo $new_name; ?>+with+<?php echo $out_rso_name; ?>+:+<?php echo $new_category; ?>&dates=<?php echo $new_date; ?>T<?php echo $new_time_from; ?>/<?php echo $new_date; ?>T<?php echo $new_time_to; ?>&details=<?php echo $new_description; ?>.+For+details,+please+contact+at:+Email:+<?php echo $admin_email; ?>+Phone:+<?php echo $admin_phone; ?>+at+<?php echo $new_university; ?>&location=<?php echo $new_location; ?>&sf=true&output=xml" target="_blank" rel="noopener noreferrer">
                                        Add To Google Calendar
                                    </a>
                                    <a href="https://outlook.office.com/calendar/0/deeplink/compose?&subject=<?php echo $out_name; ?>%20with%20<?php echo $out_rso_name; ?>%20%3A%20<?php echo $out_category; ?>&body=<?php echo $out_description; ?>%2e%20For%20details%20please%20contact%3A%20<?php echo $admin_email; ?>%20or%20<?php echo $admin_phone; ?>%20at%20<?php echo $out_university; ?>&startdt=<?php echo $name['date']; ?>T<?php echo $name['time_from']; ?>&enddt=<?php echo $name['date']; ?>T<?php echo $name['time_to']; ?>&location=<?php echo $out_location; ?>&path=%2Fcalendar%2Faction%2Fcompose&rru=addevent" target="_blank" rel="noopener noreferrer">
                                        Add To Outlook Calendar
                                    </a>

                                    <button class="event_info" onclick="location.href = 'rso_event_information.php?name=<?php echo $name['name']; ?>&university=<?php echo $name['university']; ?>&rso=<?php echo $name['rso_name']; ?>'">
                                        <div class="first">
                                            <?php
                                            echo "$name[date]";
                                            ?>
                                        </div>
                                        <div class="second">
                                            <?php
                                            echo "$name[name]";
                                            echo "<br>";
                                            echo "$name[university]";
                                            ?>
                                        </div>
                                    </button>
                                </td>
                            </tr>


                        <?php
                        }
                    } else {

                        ?>

                        <div class="no_rso_event" style="color: black; text-align: center; font-size: 40px; padding: 20px 10px;">
                            <h3>No RSO Events Exist For <?php echo $rso; ?></h3>
                        </div>

                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <div class="buttons">
        <a href="view_rso.php?name=<?php echo $uni; ?>&super=<?php echo $super ?>">
            View RSOs
        </a>

        <a href="university_profile.php?name=<?php echo $uni; ?>">
            University Home
        </a>
    </div>

</body>

</html>