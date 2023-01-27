<?php

require('../db_connection.php');
session_start();

# If Student has not logged in yet, direct the user to the index/login page 
if (isset($_SESSION['student_login_successful']) == null && $_SESSION['student_login_successful'] == false) {

    echo "
        <script>
            alert('Please Login To Access This Page'); 
            window.location.href='../index.php'; 
        </script>
        ";
}


if (isset($_GET['name']) && isset($_GET['university'])) {

    $query = "SELECT * FROM `rso_active` WHERE `name`='$_GET[name]' AND `university`='$_GET[university]'";
    $result = mysqli_query($con, $query);

    if ($result) {

        $fetch_result = mysqli_fetch_assoc($result);

        $rso_name = $fetch_result['name'];
        $rso_admin = $fetch_result['admin_name'];
        $rso_university = $fetch_result['university'];
        $rso_description = $fetch_result['description'];
        $rso_super_id = $fetch_result['super_admin_id'];
        $rso_admin_email = $fetch_result['admin_email'];
    }
    
    $query = "SELECT * FROM `rso_active` WHERE `name`='$_GET[name]' AND `university`='$_GET[university]'";
    $result = mysqli_query($con, $query);
    if($result)
    {
        $fetch_result = mysqli_fetch_assoc($result);
        $status = $fetch_result['status'];
        if ($status === '0')
        {
            $status = 'A';
        }
        else
            $status = "IA";
    }
}

$rso_query = "SELECT * FROM `rso_members` WHERE `rso_name`='$rso_name' AND `university`='$rso_university'";
$rso_result = mysqli_query($con, $rso_query);

if ($rso_result) {

    $num_rows = mysqli_num_rows($rso_result);

    $index = 0;

    while ($email = mysqli_fetch_assoc($rso_result)) {

        $member[$index] = $email['member_email'];
        $index++;
    }
}

$user_info = "SELECT * FROM `user_information` WHERE `username`='$_SESSION[username]'";
$user_query = mysqli_query($con, $user_info);

if ($user_query) {

    $fetch_user = mysqli_fetch_assoc($user_query);

    $user_email = $fetch_user['email'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View RSO Information</title>
    <link rel="stylesheet" href="css/student_RSO_information.css" />
</head>

<body>
        <header>
            <div class="header">
                <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

                <div class="title">
                    <h1>RSO Information</h1>
                    <h3><?php echo $rso_name." (".$status.")" ?></h3>
                </div>

                <button onClick="location.href = 'student_home.php'"><img src="../images/home.png"></button>
            </div>
        </header>
    

    <div class="rso_request">

    
        <div class="names">
            <label for="rso_name">RSO Name</label><br>
            <h4 id="rso_name">
                <?php echo $rso_name ?>
            </h4>
            <br>
            <label for="rso_admin">Admin Information</label><br>
            <h3 id="rso_admin">
                <?php echo "$rso_admin - $rso_admin_email" ?>
            </h3>
            <br>
            <label for="rso_members">Member Emails</label><br>
            <h2 id="rso_members">
                <?php

                for ($i = 0; $i < $num_rows; $i++) {

                    echo $member[$i];
                    echo "<br>";
                }
                ?>
            </h2>

        </div>

        <div class="description">

            <label for="rso_description">Description</label><br>
            <h3 id="rso_description" rows="4" cols="50">
                <?php echo $rso_description ?>
            </h3>
            <div class="join_rso">
                <form style="text-align: center;" method="POST">
                    <!-- <input type="text" placeholder="Please enter the RSO name to join" name="join" required /><br> -->
                    <input type="submit" name="join" value="JOIN" />
                </form>
            </div>
            <div class="join_rso">
                <form style="text-align: center;" method="POST">
                    <!-- <input type="text" placeholder="Please enter the RSO name to join" name="join" required /><br> -->
                    <input type="submit" name="leave" value="LEAVE" />
                </form>
            </div>
            <div class="buttons">
                <a href="student_find_RSO.php?name=<?php echo $rso_university; ?>&super=<?php echo $rso_super_id; ?>">
                    Search for more RSOs
                </a>
            </div>
    <?php
    if (isset($_POST['leave'])) {
        $rso_to_join = $rso_name;
        $rso_query = "SELECT * FROM `rso_active` WHERE `university`='$rso_university' AND `name`='$rso_to_join'";
        $rso_query_result = mysqli_query($con, $rso_query);
        $rso_info = mysqli_fetch_assoc($rso_query_result);
        $rso_join_query = "DELETE FROM `rso_members` WHERE `member_email`='$user_email' AND `rso_name`='$rso_name'";
        $join_result = mysqli_query($con, $rso_join_query);

        $query = "SELECT * FROM `rso_members` WHERE `rso_name` = '$rso_name'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) < 5)
        {
            $query = "UPDATE `rso_active` SET `status`='1' WHERE `name` = '$rso_name'";
            $result = mysqli_query($con, $query);
        }

        echo "
            <script>
                alert('You have left $rso_name ~'); 
                window.location.href='student_find_RSO.php';
            </script>";
    }
    
    if (isset($_POST['join'])) {

    $rso_to_join = $rso_name;

    $rso_query = "SELECT * FROM `rso_active` WHERE `university`='$rso_university' AND `name`='$rso_to_join'";
    $rso_query_result = mysqli_query($con, $rso_query);

    if ($rso_query_result) {
        # RSO Names does not exist
        if (mysqli_num_rows($rso_query_result) == 0) {

            echo "
                <script>
                    alert('Unable to join RSO. Please Try Again Later'); 
                </script>";
        } else {

            $rso_info = mysqli_fetch_assoc($rso_query_result);

            $check_query = "SELECT * FROM `rso_members` WHERE `rso_name`='$rso_info[name]' AND `university`='$rso_university' AND `member_email`='$user_email'";
            $check_result = mysqli_query($con, $check_query);

            # If the user already joined the RSO
            if (mysqli_num_rows($check_result) > 0) {

                echo "You are already a member of $rso_info[name] ~~";

            } else {

                $rso_join_query = "INSERT INTO `rso_members`(`member_email`, `rso_name`, `university`) VALUES ('$user_email','$rso_info[name]','$rso_university')";
                $join_result = mysqli_query($con, $rso_join_query);

                if ($join_result) {

                    $member_query = "SELECT * FROM `rso_members` WHERE `rso_name`='$rso_info[name]' AND `university`='$rso_university'";
                    $member_result = mysqli_query($con, $member_query);

                    if ($member_result) {

                        $num_members = mysqli_num_rows($member_result);

                        if ($num_members >= 5) {

                            $update_active_status = "UPDATE `rso_active` SET `status`='0' WHERE `name`='$rso_info[name]' AND `university`='$rso_university'";
                            $update_result = mysqli_query($con, $update_active_status);

                            if ($update_result) {

                                echo "
                                    <script>
                                        alert('You have joined $rso_info[name] ~'); 
                                        window.location.href='student_find_RSO.php';
                                    </script>";
                            } else {

                                echo "
                                    <script>
                                        alert('Server Is Down. Please Try Again ~'); 
                                        window.location.href='SA_home.php'; 
                                    </script>";
                            }
                        } else {

                            echo "
                                <script>
                                    alert('You have joined $rso_info[name] ~'); 
                                    window.location.href='student_find_RSO.php';
                                </script>";
                        }
                    }
                }
            }
        }
    }
}

?>
        </div>
    </div>

</body>

</html>