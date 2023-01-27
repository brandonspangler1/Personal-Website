<?php
require('db_connection.php');
session_start();

// if (date("H", filemtime($file_name)) !== )
$url = 'https://events.ucf.edu/feed.json';
$file_name = basename($url);

file_put_contents($file_name, file_get_contents($url));
// echo $file_name;

$months = array("Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec");
// echo $months[0]."<br>";


$myfile = fopen($file_name, "r");

while(!feof($myfile)) {
    $line = fgets($myfile);
    if (strpos($line, "\"title\":") !== false)
    {
        $length = strlen($line);
        $pos = strpos($line, '"', 10);
        $string = substr($line, $pos, $length);
        $line = str_replace('"', '', $string);
        $line = str_replace(',', '', $line);
        // echo strcmp($line, "Events at UCF");
        if (strcmp($line, "Events at UCF") != 1)
        {
            $event_name = $line;
            $event_name = substr($event_name, 0, strlen($event_name)-1);
            // echo $event_name."<br>";
            while (strpos($event_name, "\u0027") !== false)
            {
                $pos = strpos($event_name, "\u0027");
                $first_part = substr($event_name, 0, $pos);
                $second_part = substr($event_name, $pos+6, strlen($event_name));
                $event_name = $first_part.$second_part;
                // echo $event_name."<br>";
            }

            while (strpos($event_name, "\u002") !== false)
            {
                $pos = strpos($event_name, "\u002");
                $first_part = substr($event_name, 0, $pos);
                $second_part = substr($event_name, $pos+6, strlen($event_name));
                $event_name = $first_part."-".$second_part;
                // echo $event_name."<br>";
            }

            while (strpos($event_name, "\u0026") !== false)
            {
                $pos = strpos($event_name, "\u0026");
                $first_part = substr($event_name, 0, $pos);
                $second_part = substr($event_name, $pos+6, strlen($event_name));
                $event_name = $first_part.$second_part;
                // echo $event_name."<br>";
            }

            

            // echo $event_name."<br>";
        }

    }
    else if (strpos($line, "\"starts\":") !== false)
    {
        $length = strlen($line);

        $pos = strpos($line, '"', 10);

        $date = substr($line, $pos, 18);
        $date = str_replace('"', '', $date);
        // echo $date."<br>";

        $year = substr($date, 12, strlen($date));
        $year = str_replace(' ', '', $year);
        // echo "year: ".$year;

        $month = substr($date, 8, strlen($date)-14);
        $month_int = array_search($month, $months) + 1;
        if ($month_int < 10)
        {
            $month_int = "0".$month_int;
        }
        // echo " month: ".$month;

        $day = substr($date, 5, strlen($date)-15);
        // echo " day: ".$day."<br>";

        $date = $year."-".$month_int."-".$day;
        // echo "date: ".$date."<br>";

        $time_from = substr($line, $pos+18, $length);
        
        $time_from = str_replace('-0400', '', $time_from);
        $time_from = str_replace(',', '', $time_from);
        $time_from = str_replace('"', '', $time_from);

        // echo $time_from."<br>";
    }
    else if (strpos($line, "\"ends\":") !== false)
    {
        $length = strlen($line);
        $pos = strpos($line, '"', 8);

        $time_to = substr($line, $pos+18, $length);
        
        $time_to = str_replace('-0400', '', $time_to);
        $time_to = str_replace(',', '', $time_to);
        $time_to = str_replace('"', '', $time_to);

        // echo $time_to."<br>";
    }
    else if (strpos($line, "\"category\":") !== false)
    {
        $length = strlen($line);
        $pos = strpos($line, '"', 11);
        $string = substr($line, $pos, $length);
        $line = str_replace('"', '', $string);
        $line = str_replace(',', '', $line);
        if (strpos($line, "\u0026") !== false)
        {
            $pos = strpos($line, "\u0026");
            $first_part = substr($line, 0, $pos);
            $line = $first_part;
        }
        // echo strcmp($line, "Events at UCF");
        // echo $line;
        $cat = $line;
        $cat = substr($cat, 0, strlen($cat)-1);
        // if (strcmp($line, "Events at UCF") != 1)
        //     $event_name = $line;
    }
    else if (strpos($line, "\"contact_phone\":") !== false)
    {
        $length = strlen($line);
        $pos = strpos($line, '"', 15);
        $string = substr($line, $pos, $length);
        $line = str_replace('"', '', $string);
        $line = str_replace(',', '', $line);
        $line = str_replace(':', '', $line);
        $line = str_replace(' ', '', $line);
        while (strpos($line, "\u002") !== false)
        {
            $pos = strpos($line, "\u002");
            $first_part = substr($line, 0, $pos);
            $second_part = substr($line, $pos+6, $length);
            $line = $first_part."-".$second_part;
        }
        // echo $line;

        
        $phone = $line;
        if (strcmp($phone, "null") === 1)
        {
            $phone = "No Contact Phone";
        }
    }
    else if (strpos($line, "\"contact_email\":") !== false)
    {
        $length = strlen($line);
        $pos = strpos($line, '"', 16);
        $string = substr($line, $pos, $length);
        $line = str_replace('"', '', $string);
        $line = str_replace(',', '', $line);
        if (strpos($line, "\u002") !== false)
        {
            $pos = strpos($line, "\u002");
            $first_part = substr($line, 0, $pos);
            $second_part = substr($line, $pos+6, $length);
            $line = $first_part."-".$second_part;
        }
        // echo $line;
        $email = $line;
        $select = "SELECT * FROM `private_events` WHERE `name` = '$event_name'";
        $result = mysqli_query($con, $select);
        $email = substr($email, 0, strlen($email)-1);
        if (mysqli_num_rows($result) === 0)
        {
            $query = "INSERT INTO `private_events`(`university`, `name`, `date`, `time_from`, `time_to`, `category`, `description`, `location`, `email`, `phone`) VALUES ('University of Central Florida', '$event_name', '$date', '$time_from', '$time_to', '$cat', '$des', '$location', '$email', '$phone')";
            mysqli_query($con, $query);
        }
    }
    else if (strpos($line, "\"location\":") !== false)
    {
        $length = strlen($line);
        $pos = strpos($line, '"', 11);
        $string = substr($line, $pos, $length);
        $line = str_replace('"', '', $string);
        $line = str_replace(',', '', $line);
        $location = $line;
        $location = substr($location, 0, strlen($location)-1);
        // echo $line . "<br>";
    }
    else if (strpos($line, "\"url\":") !== false)
    {
        $length = strlen($line);
        $pos = strpos($line, '"', 7);
        $string = substr($line, $pos, $length);
        $line = str_replace('"', '', $string);
        $line = str_replace(',', '', $line);
        $url = $line;
        // echo $url;
        // echo $line . "<br>";
        $des = "Check description at ".$url;
        $des = substr($des, 0, strlen($des)-1);
    }
    
    // $location
    // des

    
}
fclose($myfile);
?>