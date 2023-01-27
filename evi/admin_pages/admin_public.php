<?php

require('user_info.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Solway:wght@300&display=swap" rel="stylesheet">
    <title>View Public Events</title>
    <link rel="stylesheet" href="css/admin_public.css" />
</head>

<body>

<header class="content-wrap">
        <div>
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>
            
            <div class="head">
                <h1>View Public Events for <?= $uni_name ?></h1>
            </div>
            
            <button onClick="location.href = 'admin_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <section class="content-wrap request">
        <button class="request_btn" onClick="location.href = 'create_public.php'">Request Public Event</button>
    </section>

    <div class="table_wrap">
        <div class="lists">
            <table border="1px">
                <?php

                $query = "SELECT * FROM `public_events`";
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
                                    <form action='event_redirect.php' method='POST'>
                                        <button type='submit' class="event_info" name='event' <?php echo "value=\"$name[name]\"" ?>>
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
                                    </form>

                                    <a href="https://www.google.com/calendar/render?action=TEMPLATE&text=<?php echo $new_name; ?>+:+<?php echo $new_category; ?>&dates=<?php echo $new_date; ?>T<?php echo $new_time_from; ?>/<?php echo $new_date; ?>T<?php echo $new_time_to; ?>&details=<?php echo $new_description; ?>.+For+details,+please+contact+at:+Email:+<?php echo $admin_email; ?>+Phone:+<?php echo $admin_phone; ?>+at+<?php echo $new_university; ?>&location=<?php echo $new_location; ?>&sf=true&output=xml" target="_blank" rel="noopener noreferrer">
                                        Add To Google Calendar
                                    </a>
                                    <a href="https://outlook.office.com/calendar/0/deeplink/compose?&subject=<?php echo $out_name; ?>%3A%20<?php echo $out_category; ?>&body=<?php echo $out_description; ?>%2e%20For%20details%20please%20contact%3A%20<?php echo $admin_email; ?>%20or%20<?php echo $admin_phone; ?>%20at%20<?php echo $out_university; ?>&startdt=<?php echo $name['date']; ?>T<?php echo $name['time_from']; ?>&enddt=<?php echo $name['date']; ?>T<?php echo $name['time_to']; ?>&location=<?php echo $out_location; ?>&path=%2Fcalendar%2Faction%2Fcompose&rru=addevent" target="_blank" rel="noopener noreferrer">
                                        Add To Outlook Calendar
                                    </a>
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