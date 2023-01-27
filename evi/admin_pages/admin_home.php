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
    <link rel="stylesheet" href="css/admin_home.css">
</head>

<body>
    <header class="content-wrap">
        <div>
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>
            
            <div class="head">
                <h1><?= $username ?> - <?= $uni_name ?></h1>
            </div>
            
            <button onClick="location.href = 'admin_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <section class="picture_wrap">
        <img class="picture" src="../super_admin_pages/<?=$picture_link?>">
    </section>

    <section class="section-wrap">
        <div class="row">
            <div class="column first_column">
                <h2>Registered Student Organizations</h2>
                <form class='rso_form' action='rso_redirect.php' method='POST'>
                    <?php 
                        for ($i = 0; $i < $num_rows; $i++)
                        {
                            echo "<button type='submit' value='$i' class=\"btns rso_btn\" name='inputbox'>$rso_names[$i]</button>";
                        }
                    ?>
                </form>
            </div>  

            <div class="column">
                <form action='event_type_redirect.php' method='POST' class='event_form'>
                    <button class="btns event_btns" type='submit' value='1' name='events'>Private Events</button>
                    <button class="btns event_btns" type='submit' value='0' name='events'>Public Events</button>
                </form>
                <button class="btns event_btns" onClick="location.href = '../account_settings/admin_account_security.php'">Account Settings</button>
            </div>
        </div>
    </section>

</body>

</html>