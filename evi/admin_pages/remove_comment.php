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
    <title>Delete Any Event's Any Comment</title>
    <link href="https://fonts.googleapis.com/css2?family=Solway:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/remove_comment.css" />
</head>

<body>

    <header class="content-wrap">
        <div class="main_header">
            <button class="header_btns" onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>
            
            <div class="title">
                <h1>Remove Comment for <?= $event_name ?> at  <?= $uni_name ?></h1>
            </div>
            
            <button class="header_btns" onClick="location.href = 'admin_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <div class="content-wrap">
        <form class="update_form" method="POST">

            <div class="heading">
                <h3>For Security Purposes</h3>
                <h3>Please Type The Comment</h3>
                <h3>You Would Like To Delete</h3>
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
                <input type="text" placeholder="Comment to delete" name="delete" required /><br>
                <input type="submit" value="DELETE" />
            </div>
        </form>
    </div>

    <?php

    if (isset($_POST['delete'])) {

        $delete_comment = mysqli_real_escape_string($con, $_POST['delete']);

        $delete_query = "SELECT * FROM `event_comments` WHERE `comment`='$delete_comment' AND `event_type`='$event_type' AND `university_name`='$uni_name' AND `event_name`='$event_name' AND `username`='$username'";

        $delete_result = mysqli_query($con, $delete_query);

        if ($delete_result) {

            # Comment does not exist (it doesn't match what it shows on the page)
            if (mysqli_num_rows($delete_result) == 0) {

                echo "
                    <script>
                        alert('The comment entered does not match a comment on the screen. Please Try Again'); 
                    </script>";
            } else {

                $delete = "DELETE FROM `event_comments` WHERE `comment`='$delete_comment' AND `event_type`='$event_type' AND `university_name`='$uni_name' AND `event_name`='$event_name' AND `username`='$username'";
                $delete_query_result = mysqli_query($con, $delete);

                if ($delete_query_result) {

                    echo "
                        <script>
                            alert('The comment has been deleted~'); 
                            window.location.href='event_info.php'; 
                        </script>";
                }
            }
        }
    }

    ?>

</body>

</html>