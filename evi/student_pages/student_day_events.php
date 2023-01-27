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

$userQuery = "SELECT * FROM `user_information` WHERE `username` = '$_SESSION[username]'";
$userResult = mysqli_query($con, $userQuery);
$userUni = mysqli_fetch_assoc($userResult);
$uni = $userUni['uni_id'];

$uni_info_query = "SELECT * FROM `universities` WHERE `id` = '$uni'";
$result = mysqli_query($con, $uni_info_query);
$fetch_result = mysqli_fetch_assoc($result);
$uni = $fetch_result['name'];

?>

<script>
    const date = new Date();
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const dayEndings = ["st", "nd", "rd", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "st", "nd", "rd", "th", "th", "th", "th", "th", "th", "th", "st"];
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/student_day_events.css?3" />
    <title>Day Information</title>
</head>
<body>      
    <div class="container">
        <div class="navigationBar">
            <div class="logoutButton">
                <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>
            </div>
            <div class="Title">
                <button onClick="location.href = 'student_home.php'">
                <h1>EVI</h1>
                <h2>Event Tracker</h2>
                </button>
            </div>
            <div class="month">
                <div class="date">
                    <!-- <h1><script>document.querySelector('.date h1').innerHTML = months[date.getMonth()] + " " +  date.getDate() + " " +  date.getFullYear();</script></h1> -->
                    <h1><script>
                    document.querySelector('.date h1').innerHTML = months[<?php echo $_GET['month']?>] + " " +  <?php echo $_GET['date']?> + dayEndings[<?php echo $_GET['date']?> - 1] + " " +  <?php echo $_GET['year']?></script></h1>
                </div>
            </div>
            <div class="buttons">
                <div class="accountSettings">
                    <button onClick="location.href = 'student_account_page.php'">Account</button>
                </div>
                <div class="requestRSO">
                    <button onClick="location.href = 'RSO_Student/request_RSO_student.php'">Request RSO</button>
                </div>
            </div>
    </div>
        <div class="eventList">
            <h1>Public Events</h1>
            <div class="publicEvents">
                <div class="PUtimeList">
                    <p></p>
                </div>
                <div class="PUeventType">
                    <p></p>
                </div>
                <div class="PUlocationList">
                    <p></p>
                </div>
                <div class="PUmoreInfoList">
                    <p></p>
                </div>
            </div>
            <h1>Private Events</h1>
            <div class="privateEvents"> 
                <div class="PRtimeList">
                    <p></p>
                </div>
                <div class="PReventType">
                    <p></p>
                </div>
                <div class="PRlocationList">
                    <p></p>
                </div>
                <div class="PRmoreInfoList">
                    <p></p>
                </div>
            </div>
            <h1>RSO Events</h1>
            <div class="privateEvents">
                <div class="RSOtimeList">
                    <p></p>
                </div>
                <div class="RSOeventType">
                    <p></p>
                </div>
                <div class="RSOlocationList">
                    <p></p>
                </div>
                <div class="RSOmoreInfoList">
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    require('../db_connection.php');
    $date = $_COOKIE["date"];
    $event_names = array();
    $event_times = array();
    $event_locations = array();
    $event_info = array();

    $public_event_query = "SELECT * FROM `public_events` WHERE `date` = '$date'";
    $result = mysqli_query($con, $public_event_query);
    $numRows = mysqli_num_rows($result);
    for ($i = 0; $i < $numRows; $i++){
        $event = mysqli_fetch_assoc($result);
        array_push($event_names, $event['name']);
        array_push($event_times, $event['time_from']);
        array_push($event_locations, $event['university']);
    }
?>;
    <script>
    document.querySelector('.PUeventType p').innerHTML = "";
    document.querySelector('.PUtimeList p').innerHTML = "";
    document.querySelector('.PUlocationList p').innerHTML = "";
    document.querySelector('.PUmoreInfoList p').innerHTML = "";
    const event_names = new Array();
    <?php $i = 0?>;
    for (let i = 0; i < <?php echo mysqli_num_rows($result) ?>; i++){
        event_names.push("<?php echo $event_names[$i]?>");
        <?php $i += 1?>;
    }
    document.querySelector('.PUeventType p').innerHTML = "<?php for ($i = 0; $i < mysqli_num_rows($result); $i++)
                                                                {
                                                                    if (isset($event_names[$i])){
                                                                        
                                                                        echo $event_names[$i] . "</br></br>";
                                                                    }
                                                                }?>";
    document.querySelector('.PUtimeList p').innerHTML = "<?php for ($i = 0; $i < mysqli_num_rows($result); $i++)
                                                                {
                                                                    if (isset($event_times[$i])){
                                                                        echo date('H:i', strtotime($event_times[$i])) . "</br></br>";
                                                                    }
                                                                }?>";
    document.querySelector('.PUlocationList p').innerHTML = "<?php for ($i = 0; $i < mysqli_num_rows($result); $i++)
                                                                {
                                                                    
                                                                    if (isset($event_locations[$i]))
                                                                        echo $event_locations[$i] . "</br></br>";
                                                                }?>";    
    <?php $i = 0;?>;
    for (let i = 0; i < <?php echo mysqli_num_rows($result) ?>; i++)
    {
        document.querySelector('.PUmoreInfoList p').innerHTML += `<button onClick="location.href = 'student_public_info.php?name=<?php echo $event_names[$i]?>&university=<?php echo $event_locations[$i]?>'">→</button>` + "</br></br>"; 
        <?php $i += 1;?>;
    }


    <?php
    require('../db_connection.php');
    $event_names = array();
    $event_times = array();
    $event_locations = array();
    $event_uni = array();

    $public_event_query = "SELECT * FROM `private_events` WHERE `date` = '$date' AND `university` = '$uni'";
    $result = mysqli_query($con, $public_event_query);

    // echo "date: ".$date;
    // echo "num rows: ".mysqli_num_rows($result);

    for ($i = 0; $i < mysqli_num_rows($result); $i++){
        $event = mysqli_fetch_assoc($result);
        array_push($event_names, $event['name']);
        array_push($event_times, $event['time_from']);
        array_push($event_locations, $event['location']);
        array_push($event_uni, $event['university']);
    }
    ?>;



    document.querySelector('.PReventType p').innerHTML = "";
    document.querySelector('.PRtimeList p').innerHTML = "";
    document.querySelector('.PRlocationList p').innerHTML = "";
    document.querySelector('.PRmoreInfoList p').innerHTML = "";
    document.querySelector('.PReventType p').innerHTML = "<?php for ($i = 0; $i < mysqli_num_rows($result); $i++)
                                                                {
                                                                    if (isset($event_names[$i]))
                                                                        echo $event_names[$i] . "</br></br>";
                                                                }?>";
    document.querySelector('.PRtimeList p').innerHTML += "<?php for ($i = 0; $i < mysqli_num_rows($result); $i++)
                                                                {
                                                                    if (isset($event_times[$i])){
                                                                        echo date('H:i', strtotime($event_times[$i])) . "</br></br>";
                                                                    }
                                                                }?>";
    document.querySelector('.PRlocationList p').innerHTML += "<?php for ($i = 0; $i < mysqli_num_rows($result); $i++)
                                                                {
                                                                    
                                                                    if (isset($event_locations[$i]))
                                                                        echo $event_locations[$i] . "</br></br>";
                                                                }?>";    
    <?php $i = 0;?>;
    for (let i = 0; i < <?php echo mysqli_num_rows($result) ?>; i++)
    {
        document.querySelector('.PRmoreInfoList p').innerHTML += `<button onClick="location.href = 'student_private_info.php?name=<?php echo $event_names[$i]?>&university=<?php echo $event_uni[$i]?>'">→</button>` + "</br></br>"; 
        <?php $i += 1;?>;
    }

    



    
    <?php
    require('../db_connection.php');
    $event_names = array();
    $event_times = array();
    $event_locations = array();
    $event_uni = array();

    $public_event_query = "SELECT * FROM `rso_events` WHERE `date` = '$date' AND `university` = '$uni'";
    $result = mysqli_query($con, $public_event_query);
    for ($i = 0; $i < mysqli_num_rows($result); $i++){
        $event = mysqli_fetch_assoc($result);
        array_push($event_names, $event['name']);
        array_push($event_times, $event['time_from']);
        array_push($event_locations, $event['rso_name']);
        array_push($event_uni, $event['university']);
    }
    ?>;

    document.querySelector('.RSOeventType p').innerHTML = "";
    document.querySelector('.RSOtimeList p').innerHTML = "";
    document.querySelector('.RSOlocationList p').innerHTML = "";
    document.querySelector('.RSOmoreInfoList p').innerHTML = "";
    document.querySelector('.RSOeventType p').innerHTML = "<?php for ($i = 0; $i < mysqli_num_rows($result); $i++)
                                                                {
                                                                    if (isset($event_names[$i]))
                                                                        echo $event_names[$i] . "</br></br>";
                                                                }?>";
    document.querySelector('.RSOtimeList p').innerHTML += "<?php for ($i = 0; $i < mysqli_num_rows($result); $i++)
                                                                {
                                                                    if (isset($event_times[$i])){
                                                                        echo date('H:i', strtotime($event_times[$i])) . "</br></br>";
                                                                    }
                                                                }?>";
    document.querySelector('.RSOlocationList p').innerHTML += "<?php for ($i = 0; $i < mysqli_num_rows($result); $i++)
                                                                {
                                                                    
                                                                    if (isset($event_locations[$i]))
                                                                        echo $event_locations[$i] . "</br></br>";
                                                                }?>";    
    <?php $i = 0;?>;
    for (let i = 0; i < <?php echo mysqli_num_rows($result) ?>; i++)
    {
        document.querySelector('.RSOmoreInfoList p').innerHTML += `<button onClick="location.href = 'student_RSO_info.php?name=<?php echo $event_names[$i]?>&university=<?php echo $event_uni[$i]?>&rso=<?php echo $event_locations[$i]?>'">→</button>` + "</br></br>"; 
        <?php $i += 1;?>;
    }
    </script>        
