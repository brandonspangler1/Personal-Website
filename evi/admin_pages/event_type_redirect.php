<?php
    require("user_info.php");
    
    $event_type = $_POST['events'];

    $_SESSION['event_type'] = $event_type;

    $event_page = $events[$event_type];

    header("Location: admin_$event_page.php");
?>