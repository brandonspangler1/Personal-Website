<?php

require('../../db_connection.php');
session_start();


// $username = $_SESSION['username'];


// $query = "SELECT id.uni_id FROM user_information id, university_info id2 WHERE id.uni_id = id2.id AND id.username = '$username'";

// $result = mysqli_query($con, $query);

// $row = mysqli_fetch_assoc($result);

// $uni_id = $row["uni_id"];

// $query = "SELECT uni_name.name FROM university_info uni_name WHERE $uni_id = uni_name.id";


// $result = mysqli_query($con, $query);
// $row = mysqli_fetch_assoc($result);

// $uni_name = $row["name"];

// $query = "SELECT user.name FROM user_information user WHERE user.name = $_SESSION[username]";

// $query = "SELECT r_name.name FROM rso r_name WHERE r_name.id = 1";

// $result = mysqli_query($con, $query);

// $row = mysqli_fetch_assoc($result);

// $rso_name = $row["name"];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSO Request Decision</title>
    <link rel="stylesheet" href="request_RSO_student.css" />
</head>

<body>

    <header>
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../../images/logout.png"></button>

            <div class="title">
                <h1>RSO Request</h1>
            </div>

            <button onClick="location.href = '../student_home.php'"><img src="../../images/home.png"></button>
        </div>
    </header>

    <div class="rso_request">
        <form method="POST">
            <div class="name-admin_info">
                <label for="rso_name">RSO Name</label><br>
                <h4 id="rso_name">
                    <input type="text" id="RSO_name" name="RSO_name" placeholder="RSO Name" required>
                </h4>
                <br>
                <label for="rso_admin">Admin Information</label><br>
                <h3 id="rso_admin">
                    <input type="email" id="admin_email" name="admin_email" placeholder="Admin Email" required>
                </h3>
            </div>
            <div class="member_emails">
                <label for="rso_members">Member Emails</label><br>
                <h3 id="rso_members">
                    <input type="email" id="member_email" name="member_email1" placeholder="Email 1" required>
                </h3>
                <h3 id="rso_members">
                    <input type="email" id="member_email" name="member_email2" placeholder="Email 2" required>
                </h3>
                <h3 id="rso_members">
                    <input type="email" id="member_email" name="member_email3" placeholder="Email 3" required>
                </h3>
                <h3 id="rso_members">
                    <input type="email" id="member_email" name="member_email4" placeholder="Email 4" required>
                </h3>
            </div>
    </div>
    <div class="description">
        <label for="rso_description">Description</label><br>
        <h3 id="rso_description" rows="4" cols="50">
            <textarea id="event_des" name="event_des" placeholder="Enter description" rows="1" cols="5"></textarea>
        </h3>
    </div>
    <div class="submit">
        <button type="submit" class="create-btn" name="create_RSO_submit">Submit</button>
    </div>
    <?php
    if (isset($_POST['create_RSO_submit'])) {
        $query = "SELECT * FROM `user_information` WHERE `email`= '$_POST[admin_email]'";
        $result = mysqli_query($con, $query);
        $fetch_result = mysqli_fetch_assoc($result);
        $uni = $fetch_result['uni_id'];
        $admin_name = $fetch_result['name'];
        $admin_id = $fetch_result['id'];


        $uni_info_query = "SELECT * FROM `universities` WHERE `id` = '$uni'";
        $result = mysqli_query($con, $uni_info_query);
        $fetch_result = mysqli_fetch_assoc($result);
        $uni = $fetch_result['name'];
        $SA_id = $fetch_result['super_admin_id'];

        $insert_query = "INSERT INTO  
                `rso_requests`(`super_admin_id`, `name`, `university`, `admin_name`, `admin_email`, `description`, `member_one`, `member_two`, `member_three`, `member_four`) 
                VALUES ('$SA_id', '$_POST[RSO_name]','$uni','$admin_name','$_POST[admin_email]','$_POST[event_des]','$_POST[member_email1]',
                '$_POST[member_email2]','$_POST[member_email3]','$_POST[member_email4]')";

        if (mysqli_query($con, $insert_query)) {
            echo "
                        <script>
                            window.location.href='success_RSO_request.php'; 
                        </script>
                        ";
        } else {
            echo "  
                        <script>
                            alert('The Server Is Down. Please Try Again'); 
                            window.location.href='../student_home.php'; 
                        </script>";
        }
    }
    ?>
    </form>
</body>

</html>