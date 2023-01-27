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

    $uni_name = $_GET['name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Public Event</title>
    <link rel="stylesheet" href="css/create_public.css" />
</head>

<body>

    <header>
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>Create Public Event</h1>
                <h1>For [<?php echo $uni_name ?>]</h1>
            </div>

            <button onClick="location.href = 'SA_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <div class="create_public_event">
        <form style="text-align: center;" method="POST">
            <div class="event_info">
                <div class="basic">
                    <label for="event_name">Event Name</label><br>
                    <input id="event_name" type="text" placeholder="Event Name" name="name" required />
                    <br>
                    <label for="event_date">Event Date</label><br>
                    <input id="event_date" type="text" placeholder="0000-00-00" name="date" required />
                    <br>
                    <label for="event_time_from">Event Time From</label><br>
                    <input id="event_time_from" type="text" placeholder="00:00:00" name="time_from" required />
                    <br>
                    <label for="event_time_to">Event Time To</label><br>
                    <input id="event_time_to" type="text" placeholder="00:00:00" name="time_to" required />
                    <br>
                    <label for="event_category">Event Category</label><br>
                    <input id="event_category" type="text" placeholder="Event Category" name="category" required />
                </div>

                <div class="describe">
                    <label for="event_description">Description</label><br><br>
                    <textarea id="event_description" name="description" placeholder="Event Description" rows="4" cols="50" required></textarea>
                </div>

                <div class="advanced">
                    <label for="event_location">Event Location</label><br><br>
                    <input id="event_location" type="text" placeholder="University Name" name="location" required />
                    <br>
                    <label for="event_email">Contact Email</label><br><br>
                    <input id="event_email" type="email" placeholder="someone@email.com" name="email" required />
                    <br>
                    <label for="event_phone">Contact Phone</label><br><br>
                    <input type="tel" id="phone" placeholder="123-456-7890" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required />
                </div>
            </div>
            <div class="create_button">
                <button type="submit" class="create-btn" name="create_public">CREATE</button>
            </div>
        </form>
    </div>

    <?php

    if (isset($_POST['create_public'])) {

        $insert_query = "INSERT INTO `public_events`(`university`, `name`, `date`, `time_from`, `time_to`, `category`, `description`, `location`, `email`, `phone`) VALUES ('$uni_name','$_POST[name]','$_POST[date]','$_POST[time_from]','$_POST[time_to]','$_POST[category]','$_POST[description]','$_POST[location]','$_POST[email]','$_POST[phone]')";

        if (mysqli_query($con, $insert_query)) {

            echo "
                 <script>
                    alert('Public Event: $_POST[name] Has Been Created'); 
                    window.location.href='university_profile.php?name=$uni_name'; 
                </script>
                ";
        } else {

            echo "  
                <script>
                    alert('The Server Is Down. Please Try Again'); 
                    window.location.href='SA_home.php'; 
                </script>";
        }
    }

    ?>

</body>

</html>