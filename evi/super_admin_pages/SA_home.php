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

$query = "SELECT * FROM `user_information` WHERE `username`= '$_SESSION[username]'";
$result = mysqli_query($con, $query);

if ($result) {

    $result_fetch = mysqli_fetch_assoc($result);

    if ($result_fetch['university_status'] == 1) {
    } else {
        echo "
            <script>
                alert('You have not created a profile for a University yet. Please create a University profile to continue to the home page'); 
                window.location.href='create_university.php'; 
            </script>
            ";
    }

    $super_admin_id = $result_fetch['id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVI EVENT PLANNER</title>
    <link rel="stylesheet" href="css/SA_home.css" />
</head>

<body>

    <header>

        <div class='user_logout'>
            <a href='../logout.php'>LOGOUT</a>
        </div>
        <div class="title">
            <h1>EVI</h1>
            <h2>SUPER ADMINISTRATOR</h2>
        </div>
        <div class='donate'>
            <button type='button' onclick="popup('donate-popup')">
                DONATE
            </button>
        </div>

        <div class="popup-container" id="donate-popup">
            <div class="donation popup">
                <div>
                    <button type="reset" onclick="popup('donate-popup')">
                        X
                    </button>
                    <div>
                        <div>
                            WE DON'T NEED YOUR MONEY
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function popup(popup_type) {
                get_popup = document.getElementById(popup_type);

                if (get_popup.style.display == "flex") {
                    get_popup.style.display = "none";
                } else {
                    get_popup.style.display = "flex";
                }
            }
        </script>

    </header>

    <!-- Universities List  -->
    <div class="head_title">
        <h3>
            Your Universities
        </h3>
    </div>
    <div class="universities">
        <div class="lists">
            <table border="1px">
                <?php

                $query = "SELECT * FROM `user_information` WHERE `username`='$_SESSION[username]'";
                $result = mysqli_query($con, $query);

                if ($result) {

                    # User Exists
                    if (mysqli_num_rows($result) > 0) {

                        # Fetch the details of the user with username
                        $fetch_user = mysqli_fetch_assoc($result);

                        $uni_query = "SELECT * FROM `universities` WHERE `super_admin_id`='$fetch_user[id]'";
                        $uni_result = mysqli_query($con, $uni_query);

                        if ($uni_result) {

                            while ($name = mysqli_fetch_assoc($uni_result)) {
                ?>
                                <tr class="names">
                                    <td>
                                        <button onclick="location.href = 'university_profile.php?name=<?php echo $name['name']; ?>'">
                                            <?php
                                            echo $name['name'];
                                            ?>
                                        </button>
                                    </td>
                                </tr>
                <?php
                            }
                        }
                    }
                }
                ?>
            </table>
        </div>
        <div class="user_buttons">
            <div class="create_university">
                <a href="create_university.php">
                    Create New University Profile
                </a>
            </div>
            <div class="account">
                <a href="../account_settings/SA_account_security.php">
                    Account Settings
                </a>
            </div>
            <div class="view_public">
                <a href="view_public_events.php">
                    View Public Events
                </a>
            </div>
        </div>
    </div>

    <div class="requests">
        <div class="rso">
            <!-- RSO Requests List  -->
            <div class="second_title">
                <h3>
                    RSO Creation Requests
                </h3>
            </div>
            <div class="rso_lists">
                <table border="1px">
                    <?php

                    $query = "SELECT * FROM `rso_requests` WHERE `super_admin_id`='$super_admin_id'";
                    $result = mysqli_query($con, $query);

                    while ($name = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr class="names">
                            <td>
                                <button onclick="location.href = 'rso_request.php?name=<?php echo $name['name']; ?>&university=<?php echo $name['university']; ?>';">
                                    <?php
                                    echo $name['name'];
                                    echo "<br>";
                                    echo $name['university'];
                                    ?>
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <div class="public">
            <!-- Public Event Requests List  -->
            <div class="third_title">
                <h3>
                    Public Event Requests
                </h3>
            </div>

            <div class="public_lists">
                <table border="1px">
                    <?php

                    $query = "SELECT * FROM `public_requests`";
                    $result = mysqli_query($con, $query);

                    while ($name = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr class="names">
                            <td>
                                <button onclick="location.href = 'public_request.php?name=<?php echo $name['name']; ?>&university=<?php echo $name['university']; ?>';">
                                    <?php
                                    echo $name['name'];
                                    echo "<br>";
                                    echo $name['university'];
                                    ?>
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>

    </div>


</body>

</html>