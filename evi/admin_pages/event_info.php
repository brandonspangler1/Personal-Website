<?php

require("user_info.php");

$event_name = $_SESSION['current_event'];
$event_index = $_SESSION['event_type'];

# for debugging
# echo "$event_index";

$event_type = "$events[$event_index]_events";
# for debugging
# echo "$event_type <br> $event_name";

$query = "SELECT * FROM `$event_type` WHERE `name` = '$event_name'";

# echo $query."<br";

$result = mysqli_query($con, $query);

# echo "row #s: ".mysqli_num_rows($result);

$row = mysqli_fetch_array($result);

$date = $row['date'];
$time_from = $row['time_from'];
$time_to = $row['time_to'];
$cat = $row['category'];
$des = $row['description'];
$location = $row['location'];
$admin_email = $row['email'];
$admin_phone = $row['phone'];

if ($event_index == 0 || $event_index == 1) {
    $group_name = $row['university'];
} else if ($event_index == 2) {
    $group_name = $row['rso_name'];
}

# echo "date: ".$row['date']."<br>";
# echo "time: ".$time_from;


$google_location = str_replace(' ', '+', $private_location);
$google_group_name = str_replace(' ', '+', $group_name);
$google_event_name = str_replace(' ', '+', $event_name);
$google_date = str_replace('-', '', $date);
$google_time_from = str_replace(':', '', $time_from);
$google_time_to = str_replace(':', '', $time_to);
$google_cat = str_replace(' ', '+', $cat);
$google_des = str_replace(' ', '+', $des);
$google_location = str_replace(' ', '+', $location);
$google_email = $admin_email;
$google_phone = $admin_phone;






$rate_query = "SELECT * FROM `event_rating` WHERE `event_type`='$event_index' AND `event_name`='$event_name' AND `university_name`='$uni_name' AND `username`='$_SESSION[username]'";
$result_rate_query = mysqli_query($con, $rate_query);

if ($result_rate_query) {

    $fetch_rate = mysqli_fetch_assoc($result_rate_query);

    $user_rating = $fetch_rate['rate'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVI Event Information</title>
    <link href="https://fonts.googleapis.com/css2?family=Solway:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/event_info.css">
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0" nonce="WhjTk4Tv"></script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</head>

<body class="grid_wrap">
    <header class="head">
        <div class="main_header">
            <button class="header_btns" onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div>
                <h1 class="title"><?= $username ?> - <?= $group_name ?></h1>
            </div>

            <button class="header_btns" onClick="location.href = 'admin_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <section class="info">
        <div class="information">

            <h3>Event Name</h3>
            <h4><?php echo $event_name ?></h4>

            <h3>Event Date</h3>
            <h4><?php echo $date ?></h4>

            <h3>Event Time</h3>
            <h4><?php echo "$time_from-$time_to" ?></h4>

            <h3>Event Category</h3>
            <h4><?php echo $cat ?></h4>

            <h3>Event Location</h3>
            <h4><?php echo $location ?></h4>

            <h3>Event Location Maps</h3>
            <a id="open_maps" href="https://www.google.com/maps/search/?api=1&query=<?php echo $location ?>" target="_blank" rel="noopener noreferrer">
                Open Google Maps
            </a>

            <h3>Contact Email</h3>
            <h4><?php echo $admin_email ?></h4>

            <h3>Contact Phone</h3>
            <h4><?php echo $admin_phone ?></h4>
        </div>
    </section>

    <section class="des">
        <h3>Description</h3>
        <textarea rows="4" cols="25"><?php echo $des ?></textarea>
    </section>

    <section class="social">
        <!-- <div class="add_event"> -->
        <a class="add_google" href="https://www.google.com/calendar/render?action=TEMPLATE&text=<?php echo $google_event_name; ?>+:+<?php echo $google_cat; ?>&dates=<?php echo $google_date; ?>T<?php echo $google_time_from; ?>/<?php echo $google_date; ?>T<?php echo $google_time_to; ?>&details=<?php echo $google_des; ?>.+For+details,+please+contact+at:+Email:+<?php echo $google_email; ?>+Phone:+<?php echo $google_phone; ?>+at+<?php echo $google_group_name; ?>&location=<?php echo $google_location; ?>&sf=true&output=xml" target="_blank" rel="noopener noreferrer">
            Add To Google Calendar
        </a>
        <a class="add_outlook" href="https://outlook.office.com/calendar/0/deeplink/compose?&subject=<?php echo $event_name; ?>%3A%20<?php echo $cat; ?>&body=<?php echo $des; ?>%2e%20For%20details%20please%20contact%3A%20<?php echo $admin_email; ?>%20or%20<?php echo $admin_phone; ?>%20at%20<?php echo $group_name; ?>&startdt=<?php echo $date; ?>T<?php echo $time_from; ?>&enddt=<?php echo $date; ?>T<?php echo $time_to; ?>&location=<?php echo $location; ?>&path=%2Fcalendar%2Faction%2Fcompose&rru=addevent" target="_blank" rel="noopener noreferrer">
            Add To Outlook Calendar
        </a>
        <!-- </div> -->
        <!-- <div class="social_network"> -->
        <div class="twitter_share">
            <a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large" data-text="<?php echo $event_name; ?> on <?php echo $date; ?> at <?php echo $uni; ?>." data-url="https://www.brandonspangler.com/evi" data-hashtags="EVI,EventPlanner">
                Tweet
            </a>
        </div>

        <div class="fb-share-button" data-href="https://www.brandonspangler.com/evi" data-layout="button" data-size="large">
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.brandonspangler.com%2Fevi&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                Share
            </a>
        </div>
        <!-- </div> -->
    </section>

    <section class="rate">
        <div class="rate_header">
            <div class="user_rate">
                <h3 for="rate">Rate</h3>
                <h4 id="rate">
                    <?php echo $user_rating ?> Stars
                </h4>
                <h5>*****</h5>
            </div>

            <div class="update_rate">
                <form method="POST">
                    <h3>Update Rate</h3>
                    <input type="text" placeholder="1 - 5 Stars" name="stars" pattern="[1-5]{1}" required />
                    <input type="submit" value="UPDATE" />
                    <h5>Please Refresh After UPDATE</h5>
                </form>

                <?php

                if (isset($_POST['stars'])) {

                    $updated_rate = $_POST['stars'];

                    $user_rate = "SELECT * FROM `event_rating` WHERE `event_type`='$event_index' AND `event_name`='$event_name' AND `university_name`='$uni_name' AND `username`='$_SESSION[username]'";
                    if (mysqli_query($con, $user_rate)) {

                        if (mysqli_num_rows(mysqli_query($con, $user_rate)) == 0) {

                            $add_rate = "INSERT INTO `event_rating`(`event_type`, `event_name`, `university_name`, `username`, `rate`, `status`) VALUES ('$event_index','$event_name','$uni_name','$_SESSION[username]','$updated_rate','1')";

                            if (mysqli_query($con, $add_rate)) {
                            } else {
                                echo "
                                    <script>
                                        alert('The Server Is Down. Please Try Again'); 
                                        window.location.href='SA_home.php'; 
                                    </script>";
                            }
                        } else {

                            $update_rate_query = "UPDATE `event_rating` SET `rate`='$updated_rate' WHERE `event_type`='$event_index' AND `event_name`='$event_name' AND `university_name`='$uni_name' AND `username`='$_SESSION[username]'";
                            if (mysqli_query($con, $update_rate_query)) {
                            } else {

                                echo "
                                    <script>
                                        alert('The Server Is Down. Please Try Again'); 
                                        window.location.href='SA_home.php'; 
                                    </script>";
                            }
                        }
                    } else {

                        echo "
                            <script>
                                alert('The Server Is Down. Please Try Again'); 
                                window.location.href='SA_home.php'; 
                            </script>";
                    }
                }
                ?>
            </div>

            <div class="add_comment">
                <form style="text-align: center;" method="POST">
                    <h3>Add Comment</h3>
                    <input type="text" placeholder="User Comment" name="comment" required />
                    <input type="submit" value="ADD" />
                    <h5> 255 Max Characters Please. If Not, Comment Will Not Be Made </h5>
                </form>

                <?php

                if (isset($_POST['comment'])) {

                    $comment = mysqli_real_escape_string($con, $_POST['comment']);

                    $comment_status = "SELECT * FROM `event_comments` WHERE `comment`='$comment' AND `event_type`='$event_index' AND `event_name`='$event_name' AND `university_name`='$uni_name' AND `username`='$_SESSION[username]'";

                    if (mysqli_query($con, $comment_status)) {

                        # Same comment exists. Can't add duplicate comments 
                        if (mysqli_num_rows(mysqli_query($con, $comment_status)) > 0) {

                            echo "
                                <script>
                                    alert('Duplicate Comments Cannot Be Made'); 
                                </script>";
                        } else {

                            $add_comment = "INSERT INTO `event_comments`(`event_type`, `university_name`, `event_name`, `username`, `comment`) VALUES ('$event_index','$uni_name','$event_name','$_SESSION[username]','$comment')";
                            if (mysqli_query($con, $add_comment)) {
                            } else {

                                echo "
                                    <script>
                                        alert('The Server Is Down. Please Try Again'); 
                                        window.location.href='SA_home.php'; 
                                    </script>";
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>

        <div class="comment_actions">
            <div class="comments">
                <h2>User Comments</h2>

                <div class="lists">
                    <table border="2px">
                        <?php

                        $query = "SELECT * FROM `event_comments` WHERE `event_type`='$event_index' AND `event_name`='$event_name' AND `university_name`='$uni_name' AND `username`='$_SESSION[username]'";
                        $result = mysqli_query($con, $query);

                        if ($result) {

                            # Private Events Exist
                            if (mysqli_num_rows($result) > 0) {

                                # Fetch the details of the User Comments 
                                while ($name = mysqli_fetch_assoc($result)) {
                        ?>
                                    <tr class="names">
                                        <td>
                                            <div class="user_comment">
                                                <?php
                                                echo $name['comment'];
                                                ?>
                                            </div>
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

            <div class="comment_buttons">
                <a href="update_comment.php">UPDATE</a>
                <a href="remove_comment.php">REMOVE</a>
            </div>
        </div>
    </section>

</body>

</html>