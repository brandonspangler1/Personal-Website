<?php
    require("user_info.php");
    
    $event_name = $_POST['event'];

    $_SESSION['current_event'] = $event_name;

    header("Location: event_info.php");
?>