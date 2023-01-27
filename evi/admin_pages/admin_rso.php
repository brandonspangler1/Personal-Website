<?php

require("user_info.php");

$rso_name = $_SESSION['current_rso'];

$query = "SELECT * FROM `rso_events` WHERE `rso_name` = '$rso_name'";
$result = mysqli_query($con, $query);

$num_rows = mysqli_num_rows($result);

$events = array();

for ($x = 0; $x < $num_rows; $x++)
{
    $row = mysqli_fetch_assoc($result);
    
    $name = $row['name'];

    array_push($events, $name);
}

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSO Events</title>
    <link href="https://fonts.googleapis.com/css2?family=Solway:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin_rso.css">
</head>
<body>
    <header class="content-wrap">
        <div>
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1><?= $rso_name ?> - <?= $uni_name ?></h1>
            </div>

            <button onClick="location.href = 'admin_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <section class="content-wrap">
        <div class="row">
            <div class="column first_column">
                <h2>RSO Planned Events</h2>
                <form class="event_form" action='event_redirect.php' method='POST'>
                    <?php 
                            for ($i = 0; $i < $num_rows; $i++)
                            {
                                echo "<button type='submit' class='btns' value=\"$events[$i]\" name='event'>$events[$i]</button>";
                            }
                    ?>
                </form>
            </div>  

            <div class="column">
                <button class="btns" onClick="location.href = 'create_rso.php'">Host New RSO Event</button>
            </div>
        </div>
    </section>

</body>

</html>