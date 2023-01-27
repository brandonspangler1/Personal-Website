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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View RSO Information</title>
    <link rel="stylesheet" href="css/rso_information.css" />
</head>

<body>

    <header>
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>RSO Information</h1>
                <h3><?php echo $rso_name; ?></h3>
            </div>

            <button onClick="location.href = 'SA_home.php'"><img src="../images/home.png"></button>
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

            <div class="buttons">
                <a href="view_rso.php?name=<?php echo $rso_university; ?>&super=<?php echo $rso_super_id; ?>">
                    View RSOs
                </a>
                <a href="find_rso.php?name=<?php echo $rso_university; ?>&super=<?php echo $rso_super_id; ?>">
                    Find RSOs
                </a>
            </div>
        </div>
    </div>

</body>

</html>