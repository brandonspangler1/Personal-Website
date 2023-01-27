<?php

require('user_info.php');
date_default_timezone_set('EST');

$uni_name = $_SESSION['current_uni'];

$query = "SELECT * FROM `private_events` WHERE `university` = '$uni_name' ORDER BY `date` DESC";
$result = mysqli_query($con, $query);

$num_rows = mysqli_num_rows($result);

$events = array();
$years = array();
$months = array();
$days = array();

$current_day = date('j');
$current_month = date('m');
$current_year = date('Y');

$current_date = date('Y')."-".date('m')."-".date('j');

for ($x = 0; $x < $num_rows; $x++)
{
    $row = mysqli_fetch_assoc($result);
    
    $name = $row['name'];
    $date = $row['date'];
    $year = substr($date, 0, 4);
    $month = substr($date, 5, 2);
    $day = substr($date, 8, 2);
    // echo $year."-".$month."-".$day."<br>";

    if ($year >= $current_year)
    {
        if ($year > $current_year)
        {
            array_push($events, $name);
            array_push($years, $year);
            array_push($months, $month);
            array_push($days, $day);
        }
        else if ($month > $current_month)
        {
            array_push($events, $name);
            array_push($years, $year);
            array_push($months, $month);
            array_push($days, $day);
        }
        else if ($month === $current_month)
        {
            if ($day >= $current_day)
            {
                array_push($events, $name);
                array_push($years, $year);
                array_push($months, $month);
                array_push($days, $day);
            }
        }
    }

    if ($year <= date('Y'))
    {
        if ($month < date('m'))
        {
            break;
        }
        else if ($month === date('m'))
        {
            if ($day < date('j'))
            {
                break;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVI Admin Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Solway:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin_private.css">
</head>

<body>
    <header class="content-wrap">
        <div>
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="head">
                <h1><?= $username ?> - <?= $uni_name ?></h1>
                <h1>Private Events</h1>
            </div>

            <button onClick="location.href = 'admin_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <section class="content-wrap">
        <div class="row">
            <div class="column first_column">
                <h2>Upcoming Events:</h2>
                <form class="event_form" action='event_redirect.php' method='POST'>
                    <?php 
                            $length = count($events)-1;
                            for ($i = $length; $i >= 0; $i--)
                            {
                                echo "<button type='submit' value='$events[$i]' class='btns' name='event'>$events[$i]</button> <br>";
                            }
                    ?>
                </form>
            </div>  

            <div class="column">
                <button class="btns" onClick="location.href = 'create_private.php'">Host New Private Event</button>
            </div>
        </div>
    </section>

</body>

</html>