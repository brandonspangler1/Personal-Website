<?php

require('user_info.php');

if (isset($_SESSION['event_type']) && isset($_SESSION['current_event'])) {

    $event_name = $_SESSION['current_event'];
    $event_type = $_SESSION['event_type'];
    

    $query = "SELECT * FROM `event_comments` WHERE `event_name`='$event_name' AND `university_name`='$uni_name' AND `event_type`='$event_type' AND `username`='$username'";
    $result = mysqli_query($con, $query);

    if ($result) {

        $fetch_results = mysqli_fetch_assoc($result);

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event Comment</title>
    <link href="https://fonts.googleapis.com/css2?family=Solway:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/update_comment.css" />
</head>

<body>

    <header class="content-wrap">
        <div class="main_header">
            <button class="header_btns" onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>
            
            <div class="title">
                <h1>Update Comment for <?= $event_name ?> at  <?= $uni_name ?></h1>
            </div>
            
            <button class="header_btns" onClick="location.href = 'admin_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <div class="content-wrap">
        <form class="update_form" style="text-align: center;" method="POST">

            <div class="heading">
                <h3>For Security Purposes</h3>
                <h3>Please Type The Comment</h3>
                <h3>You Would Like To Update</h3>
                <h3>And Then Type The Updated Comment</h3>
            </div>


            <div class="view_comments">
                <?php

                $comments = "SELECT * FROM `event_comments` WHERE `event_type`='$event_type' AND `university_name`='$uni_name' AND `event_name`='$event_name' AND `username`='$username'";

                $comment_result = mysqli_query($con, $comments);

                if ($comment_result) {

                    while ($name = mysqli_fetch_assoc($comment_result)) {

                        $current_name = $name['comment'];
                        echo "<p>$current_name</p>";
                    }
                }
                ?>
            </div>
            <div class="inputs_section">
                <input class="inputs" type="text" placeholder="Comment to Update" name="previous" required /><br>
                <input class="inputs" type="text" placeholder="Updated Comment" name="new" required /><br>
                <input class="inputs" type="submit" name="update" value="UPDATE" />
            </div>
        </form>
    </div>

    <?php

    if (isset($_POST['update'])) {

        $previous_comment = mysqli_real_escape_string($con, $_POST['previous']);
        $new_comment = mysqli_real_escape_string($con, $_POST['new']);

        $update_query = "SELECT * FROM `event_comments` WHERE `comment`='$previous_comment' AND `event_type`='$event_type' AND `university_name`='$uni_name' AND `event_name`='$event_name' AND `username`='$username'";

        $update_result = mysqli_query($con, $update_query);

        if ($update_result) {

            # Comment does not exist (it doesn't match what it shows on the page)
            if (mysqli_num_rows($update_result) == 0) {

                echo "
                    <script>
                        alert('The comment entered does not match a comment on the screen. Please Try Again'); 
                    </script>";
            } else {

                # Now update the database with the new comment 
                $update = "UPDATE `event_comments` SET `comment`='$new_comment' WHERE `comment`='$previous_comment' AND `event_type`='$event_type' AND `university_name`='$uni_name' AND `event_name`='$event_name' AND `username`='$username'";

                $update_query_result = mysqli_query($con, $update);

                if ($update_query_result) {

                    echo "
                        <script>
                            alert('The comment has been updated~'); 
                            window.location.href='event_info.php'; 
                        </script>";
                }
            }
        }
    }

    ?>

</body>

</html>