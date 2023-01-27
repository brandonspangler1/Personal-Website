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
    <title>Private Events</title>
    <link rel="stylesheet" href="css/student_private_events.css?2" />
</head>


<body>
    <div class="public">
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>Private Events</h1>
            </div>

            <button onClick="location.href = 'student_home.php'"><img src="../images/home.png"></button>
        </div>
        <div class="lists">
            <table border="1px">
                <?php

                $university_query = "SELECT * FROM `user_information` WHERE `username` = '$_SESSION[username]'";
                $result = mysqli_query($con, $university_query);
                $university_result = mysqli_fetch_assoc($result);
                $university = $university_result['uni_id'];

                
                $uni_name_query = "SELECT * FROM `universities` WHERE `id` = '$university'";
                $result = mysqli_query($con, $uni_name_query);
                $university_result = mysqli_fetch_assoc($result);
                $uni_name = $university_result['name'];
                $query = "SELECT * FROM `private_events` WHERE `university` = '$uni_name'";
                $result = mysqli_query($con, $query);

                if ($result) {

                    if (mysqli_num_rows($result) > 0) {

                        while ($name = mysqli_fetch_assoc($result)) {

                            $new_university = str_replace(' ', '+', $name['university']);
                            $out_university = str_replace(' ', '%20', $name['university']);
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
                                    <a href="https://www.google.com/calendar/render?action=TEMPLATE&text=<?php echo $new_name; ?>+:+<?php echo $new_category; ?>&dates=<?php echo $new_date; ?>T<?php echo $new_time_from; ?>/<?php echo $new_date; ?>T<?php echo $new_time_to; ?>&details=<?php echo $new_description; ?>.+For+details,+please+contact+at:+Email:+<?php echo $admin_email; ?>+Phone:+<?php echo $admin_phone; ?>+at+<?php echo $new_university; ?>&location=<?php echo $new_location; ?>&sf=true&output=xml" target="_blank" rel="noopener noreferrer">
                                        Add To Google Calendar
                                    </a>
                                    <a href="https://outlook.office.com/calendar/0/deeplink/compose?&subject=<?php echo $out_name; ?>%3A%20<?php echo $out_category; ?>&body=<?php echo $out_description; ?>%2e%20For%20details%20please%20contact%3A%20<?php echo $admin_email; ?>%20or%20<?php echo $admin_phone; ?>%20at%20<?php echo $out_university; ?>&startdt=<?php echo $name['date']; ?>T<?php echo $name['time_from']; ?>&enddt=<?php echo $name['date']; ?>T<?php echo $name['time_to']; ?>&location=<?php echo $out_location; ?>&path=%2Fcalendar%2Faction%2Fcompose&rru=addevent" target="_blank" rel="noopener noreferrer">
                                        Add To Outlook Calendar
                                    </a>

                                    <button class="event_info" onclick="location.href = 'student_private_info.php?name=<?php echo $name['name']; ?>&university=<?php echo $name['university']; ?>'">
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
                    }
                }
                ?>
            </table>
        </div>

        <div class="profile_buttons">
        <div class="view">
            <button onclick="location.href = 'student_public_events.php'">
                View Public Events
            </button>
        </div>
    </div>
    </div>

    

</body>

</html>