<?php

require("user_info.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVI Admin Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Solway:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/create_rso.css">
</head>

<body>
    <header class="content-wrap">
        <div>
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="head">
                <h1><?= $username ?> - <?= $_SESSION['current_rso'] ?></h1>
            </div>

            <button onClick="location.href = 'admin_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <section class="wrapper">
        <form method="POST">
            <div class="row">
                <div class="column">
                    <label for="event_name">Event Name</label>
                    <input type="text" id="event_name" name="event_name" placeholder="Lib Party" required> 

                    <label for="event_location">Event Location</label>
                    <input type="text" id="event_location" name="event_location" placeholder="University of Central Florida" required>

                    <label for="event_start">Start Time</label>
                    <input type="time" id="event_start" name="event_start" required>

                    <label for="event_end">End Time</label>
                    <input type="time" id="event_end" name="event_end" required>
                </div>  

                <div class="column">
                    <label for="event_cat">Event Category</label>
                    <input type="text" id="event_cat" name="event_cat" placeholder="Social" required>

                    <label for="contact_email">Contact Email</label>
                    <input type="email" id="contact_email" name="contact_email" placeholder="you@example.com" required> 

                    <label for="contact_phone">Contact Phone</label>
                    <input type="tel" id="contact_phone" name="contact_phone" placeholder="111-111-1111" required> 
                    
                    <label class="ed" for="event_date">Event Date</label>
                    <input class="small" type="date" id="event_date" name="event_date" required> 
                </div>
            </div>

            <div class="wrapper">
                <label for="event_des">Event Description</label>
                <br>
                <textarea id="event_des" name="event_des" placeholder="Enter description" rows="1" cols="5"></textarea>
            </div>

            <div class="wrapper">
                <div class="create">
                    <button type='submit' class="create_button" name="create">Create Event</button>
                </div>
            </div>
        </form>
    </section>

    <?php 
        if(isset($_POST['create']))
        {
            $name = $_POST['event_name'];
            $location = $_POST['event_location'];
            $start_time = $_POST['event_start'];
            $end_time = $_POST['event_end'];
            $date = $_POST['event_date'];
            $cat = $_POST['event_cat'];
            $email = $_POST['contact_email'];
            $phone = $_POST['contact_phone'];
            $des = $_POST['event_des'];
            $rso_name = $_SESSION['current_rso'];

            #echo "$name <br> $time <br> $date <br> $cat <br> $email <br> $phone <br> $des <br>";

            $query = "INSERT INTO `rso_events`(`university`, `rso_name`, `name`, `date`, `time_from`, `time_to`, `category`, `description`, `location`, `email`, `phone`) VALUES ('$uni_name', '$rso_name', '$name', '$date', '$start_time', '$end_time', '$cat', '$des', '$location', '$email', '$phone')";
            mysqli_query($con, $query);
            echo "<script>
                    window.location.href='admin_rso.php'; 
                  </script> ";
        }
    ?>

</body>

</html>