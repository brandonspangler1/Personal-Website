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

if (isset($_GET['name'])) {

    $query = "SELECT * FROM `universities` WHERE `name`='$_GET[name]'";
    $result = mysqli_query($con, $query);

    if ($result) {

        $fetch_result = mysqli_fetch_assoc($result);

        $uni_super_id = $fetch_result['super_admin_id'];
        $uni_name = $fetch_result['name'];
        $uni_location = $fetch_result['location'];
        $uni_num_students = $fetch_result['num_students'];
        $uni_description = $fetch_result['description'];
        $uni_pic_name = $fetch_result['picture_name'];
        $uni_pic_link = $fetch_result['picture_link'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Profile</title>
    <link rel="stylesheet" href="css/university_profile.css" />
</head>

<body>

    <header>
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1><?php echo $uni_name ?></h1>
                <h2><?php echo $uni_location ?> </h2>
                <h2><?php echo $uni_num_students ?> Students</h2>
            </div>

            <button onClick="location.href = 'SA_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <div class="university_info">
        <div class="description">
            <label for="uni_description">Description</label><br>
            <h3 id="uni_description" rows="4" cols="50">
                <?php echo $uni_description ?>
            </h3>
            <img alt="<?php echo $uni_pic_name ?>" src="<?php echo $uni_pic_link ?>">
        </div>

        <div class="private">
            <label for="private_events">Private Events</label><br>

            <div class="lists" id="private_events">
                <table border="1px">
                    <?php

                    $query = "SELECT * FROM `private_events` WHERE `university`='$uni_name'";
                    $result = mysqli_query($con, $query);

                    if ($result) {

                        # Private Events Exist
                        if (mysqli_num_rows($result) > 0) {

                            # Fetch the details of the Private Events with University Name
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

                                        <button class="event_info" onclick="location.href = 'private_information.php?name=<?php echo $name['name']; ?>&university=<?php echo $name['university']; ?>'">
                                            <?php
                                            echo $name['name'];
                                            echo "<br>";
                                            echo $name['date'];
                                            ?>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {

                            ?>

                            <div class="no_private">
                                <h3>No Private Events Exist Yet For <?php echo $uni_name; ?></h3>
                            </div>

                    <?php

                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="profile_buttons">
        <div class="create">
            <button onclick="location.href = 'create_public.php?name=<?php echo $uni_name; ?>'">
                Create University Public Event
            </button>
            <button onclick="location.href = 'create_private.php?name=<?php echo $uni_name; ?>'">
                Create University Private Event
            </button>
        </div>

        <div class="view">
            <button onclick="location.href = 'view_public_events.php'">
                View Public Events
            </button>
            <button onclick="location.href = 'view_rso.php?name=<?php echo $uni_name; ?>&super=<?php echo $uni_super_id; ?>'">
                View RSOs
            </button>
        </div>

        <div class="edit">
            <button onclick="location.href = 'edit_university.php?name=<?php echo $uni_name; ?>'">
                Edit University Profile
            </button>
        </div>
    </div>

</body>

</html>