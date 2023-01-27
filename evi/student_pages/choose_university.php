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

$query = "SELECT * FROM `universities`";
$result = mysqli_query($con, $query);

$num_rows = mysqli_num_rows($result);

$uni_names = array();
$uni_ids = array();

$num_rows = mysqli_num_rows($result);

for ($x = 0; $x < $num_rows; $x++) {
    $result_fetch = mysqli_fetch_assoc($result);

    $name = $result_fetch['name'];
    $id = $result_fetch['id'];

    array_push($uni_names, $name);
    array_push($uni_ids, $id);
    
    # for debugging
    # echo "$uni_names[$x], $uni_ids[$x] <br>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose University</title>
    <link href="https://fonts.googleapis.com/css2?family=Solway:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/choose_university.css" />
</head>

<body>

    <header class="content-wrap">
        <div>
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>Choose University</h1>
            </div>

            <button onClick="location.href = 'student_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <!-- 
    User Will be Directed Here Either when they first login (university_status == 0)
    Or when they want to create a university profile from the home page (university_status == 1)
-->

    <section class="content-wrap">
        <form style="text-align: center" method="POST" enctype="multipart/form-data" id="container">

            <label for="university_choices">Choose a University:</label>
            <select name="university_choices" id="university_choices">
            <?php 

                for ($i = 0; $i < $num_rows; $i++)
                {
                    $val = $uni_ids[$i];
                    echo "<option value='$val' name='uni'>$uni_names[$i]</option>";
                }
            ?>
            </select>
            <br>
            <button type="submit" class="create-btn" name="university_create">CHOOSE</button>
        </form>
    </section>

    <?php

    if (isset($_POST['university_create']))
    {
        $id = $_POST['university_choices'];
        

        $update_status = "UPDATE `user_information` SET `university_status`='1', `uni_id`='$id' WHERE `username`='$_SESSION[username]'";
        mysqli_query($con, $update_status);

        echo "
                <script>
                    alert('University has been chosen'); 
                    window.location.href='student_home.php'; 
                </script>
             ";
    }
    ?>

</body>

</html>