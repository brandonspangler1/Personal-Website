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

if (isset($_GET['name']) && isset($_GET['university']) && isset($_GET['type'])) {

    $query = "SELECT * FROM `event_comments` WHERE `event_name`='$_GET[name]' AND `university_name`='$_GET[university]' AND `event_type`='$_GET[type]' AND `username`='$_SESSION[username]'";
    $result = mysqli_query($con, $query);

    if ($result) {

        $fetch_results = mysqli_fetch_assoc($result);

        $university = $_GET['university'];
        $event_type = $_GET['type'];
        $event_name = $_GET['name'];
        $username = $_SESSION['username'];
    }
}

$user_query = "SELECT * FROM `rso_events` WHERE `university`='$university' AND `name`='$event_name'";
$user_result = mysqli_query($con, $user_query);

if ($user_result) {

    $fetch_user = mysqli_fetch_assoc($user_result);

    $rso_name = $fetch_user['rso_name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Any Event's Any Comment</title>
    <link rel="stylesheet" href="css/delete_event_comment.css" />
</head>

<body>

    <header>
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>Delete Event Comment</h1>
                <h2><?php echo $university ?></h2>
                <h2><?php echo $event_name ?></h2>
            </div>

            <button onClick="location.href = 'SA_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <div class="delete_form">
        <form style="text-align: center;" method="POST">

            <div class="heading">
                <h3>For Security Purposes</h3>
                <h3>Please Type The Comment</h3>
                <h3>You Would Like To Delete</h3>
            </div>


            <div class="view_comments">
                <?php

                $comments = "SELECT * FROM `event_comments` WHERE `event_type`='$event_type' AND `university_name`='$university' AND `event_name`='$event_name' AND `username`='$username'";

                $comment_result = mysqli_query($con, $comments);

                if ($comment_result) {

                    while ($name = mysqli_fetch_assoc($comment_result)) {

                        echo $name['comment'];
                        echo "<br>";
                    }
                }
                ?>
            </div>

            <input type="text" placeholder="Comment to delete" name="delete" required /><br>
            <input type="submit" value="DELETE" />
        </form>
    </div>

    <?php

    if (isset($_POST['delete'])) {

        $delete_comment = mysqli_real_escape_string($con, $_POST['delete']);

        $delete_query = "SELECT * FROM `event_comments` WHERE `comment`='$delete_comment' AND `event_type`='$event_type' AND `university_name`='$university' AND `event_name`='$event_name' AND `username`='$username'";

        $delete_result = mysqli_query($con, $delete_query);

        if ($delete_result) {

            # Comment does not exist (it doesn't match what it shows on the page)
            if (mysqli_num_rows($delete_result) == 0) {

                echo "
                    <script>
                        alert('The comment entered does not match a comment on the screen. Please Try Again'); 
                    </script>";
            } else {

                $delete = "DELETE FROM `event_comments` WHERE `comment`='$delete_comment' AND `event_type`='$event_type' AND `university_name`='$university' AND `event_name`='$event_name' AND `username`='$username'";
                $delete_query_result = mysqli_query($con, $delete);

                if ($delete_query_result) {

                    echo "
                        <script>
                            alert('The comment has been deleted~'); 
                            window.location.href='rso_event_information.php?name=$event_name&university=$university&rso=$rso_name'; 
                        </script>";
                }
            }
        }
    }

    ?>

</body>

</html>