<?php

require('../db_connection.php');
session_start();

# If Student has not logged in yet, direct the user to the index/login page 
// if (isset($_SESSION['student_login_successful']) == null && $_SESSION['student_login_successful'] == false) {

//     echo "
//         <script>
//             alert('Please Login To Access This Page'); 
//             window.location.href='../index.php'; 
//         </script>
//         ";
// }


$userQuery = "SELECT * FROM `user_information` WHERE `username` = '$_SESSION[username]'";
$userResult = mysqli_query($con, $userQuery);
$userUni = mysqli_fetch_assoc($userResult);
$uni = $userUni['university_name'];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>EVI Student Page</title>
        <link rel="stylesheet" href="css/student_home.css?2" />
    </head>

    <body>
        <div class="container">
            <div class="calendar">
                <div class="navigationBar">
                    <div class="logoutButton">
                        <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>
                    </div>
                    <div class="Title">
                        <h1>EVI</h1>
                        <h2>Event Tracker</h2>
                    </div>
                    <div class="month">
                        <div class="prev-month">
                            <button>←</button>
                        </div>
                        <div class="date">
                            <h1></h1>
                            <p></p>
                        </div>
                        <div class="next-month">
                            <button>→</button>
                        </div>
                    </div>
                    <div class="buttons">
                        <div class="accountSettings">
                            <!-- <a href="../account_settings/student_account_security.php">Account Settings</a> -->
                            <button onClick="location.href = 'student_account_page.php'">Account</button>
                        </div>
                        <div class="requestRSO">
                            <!-- <a href="RSO_Student/request_RSO_student.php">Request RSO</a> -->
                            <button onClick="location.href = 'RSO_Student/request_RSO_student.php'">Request RSO</button>
                        </div>
                    </div>
                </div>
                <div class="weekdays">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="days">
                    <button></button>
                </div>
            </div>
        </div>

    <script> 
    const date = new Date();

    var curYear = date.getFullYear();

    var setMonth = date.getMonth();

    var curMonth = date.getMonth();

    var curDate = date.getDate();

    const rendCalendar = () => {

        const monthDays = document.querySelector(".days");

        const month = date.getMonth();

        const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate()

        const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate()

        const firstDayIndex = new Date(date.getFullYear(), date.getMonth(), 1).getDay();

        if (curDate == -1)
            curDate = 1;
        else
            curDate = date.getDate();

        if (curMonth == setMonth)
            curDate = date.getDate();

        const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDay();

        const nextDays = 7 - lastDayIndex - 1;

        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        const dayEndings = ["st", "nd", "rd", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th", "st", "nd", "rd", "th", "th", "th", "th", "th", "th", "th", "st"];

        const dayName = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

        document.querySelector(".date h1").innerHTML = months[curMonth];

        document.querySelector(".date p").innerHTML = "" + dayName[(firstDayIndex + curDate - 1)%7] + " " + months[curMonth] + " " + curDate + dayEndings[curDate-1] + " " + curYear;

        let days = "";

        for (let j = firstDayIndex; j > 0; j--) {
            days += `<div class="prev-date">${prevLastDay - j + 1}</div>`;
        }

        for (let i = 1; i <= lastDay; i++) {
            if (i === new Date().getDate() && date.getMonth() === new Date().getMonth() && date.getFullYear() === new Date().getFullYear()) {
                days += `<div id="today" class="today">${i}</div>`;
            } else {
                days += `<div id="day${i}" class="day${i}">${i}</div>`;
            }
        }

        for (let k = 1; k <= nextDays; k++) {
            days += `<div class="next-date">${k}</div>`;
        }
        monthDays.innerHTML = days;

        const eventList1 = ["HACK@UCF Meeting", "Coding Bootcamp", "Database Meeting", "Christine Fan Club",
            "HACK@UCF Meeting", "Coding Bootcamp", "Database Meeting", "Christine Fan Club"
        ];

        const timeList1 = ["9:00am", "10:00am", "11:00am", "12:00pm", "1:00pm", "2:00pm", "3:00pm", "4:00pm"];

        document.cookie = "date = " + curYear + "-0" + (curMonth + 1) + "-" + "01";

        const chooseMonthFormatter = (curMonth < 10) ? "-0" : "-";

        const getMonthFormatter = (date.getMonth() < 10) ? "-0" : "-";

        if (document.getElementById("today"))
            document.querySelector('.today').addEventListener('click', () => {
                document.cookie = "date = " + date.getFullYear() + getMonthFormatter + (curMonth + 1) + "-" + date.getDate();
                location.href = "student_day_events.php?month=" + setMonth + "&year=" + curYear + "&date=" + date.getDate();
            })

        if (document.getElementById("day1"))
            document.querySelector('.day1').addEventListener('click', () => {
                console.log(months[date.getMonth()] + ", " + 1 + " " + date.getFullYear());
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "01";
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=1";
                                                                                                                                                                               
            })

        if (document.getElementById("day2"))
            document.querySelector('.day2').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "02";
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=2";
            })

        if (document.getElementById("day3"))
            document.querySelector('.day3').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "03";
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=3";
            })

        if (document.getElementById("day4"))
            document.querySelector('.day4').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "04";
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=4";
            })

        if (document.getElementById("day5"))
            document.querySelector('.day5').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "05";
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=5";
            })

        if (document.getElementById("day6"))
            document.querySelector('.day6').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "06";
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=6";
            })

        if (document.getElementById("day7"))
            document.querySelector('.day7').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "07";
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=7";
            })

        if (document.getElementById("day8"))
            document.querySelector('.day8').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "08";
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=8";
            })

        if (document.getElementById("day9"))
            document.querySelector('.day9').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "09";
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=9";
            })

        if (document.getElementById("day10"))
            document.querySelector('.day10').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "10";
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=10";
            })

        if (document.getElementById("day11"))
            document.querySelector('.day11').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "11";
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=11";
            })

        if (document.getElementById("day12"))
            document.querySelector('.day12').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "12";
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=12";
            })

        if (document.getElementById("day13"))
            document.querySelector('.day13').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "13";
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=13";
            })

        if (document.getElementById("day14"))
            document.querySelector('.day14').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "14";
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=14";
            })

        if (document.getElementById("day15"))
            document.querySelector('.day15').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "15";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=15";
            })

        if (document.getElementById("day16"))
            document.querySelector('.day16').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "16";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=16";
            })

        if (document.getElementById("day17"))
            document.querySelector('.day17').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "17";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=17";
            })

        if (document.getElementById("day18"))
            document.querySelector('.day18').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "18";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=18";
            })

        if (document.getElementById("day19"))
            document.querySelector('.day19').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "19";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=19";
            })

        if (document.getElementById("day20"))
            document.querySelector('.day20').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "20";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=20";
            })

        if (document.getElementById("day21"))
            document.querySelector('.day21').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "21";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=21";
            })

        if (document.getElementById("day22"))
            document.querySelector('.day22').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "22";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=22";
            })

        if (document.getElementById("day23"))
            document.querySelector('.day23').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "23";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=23";
            })

        if (document.getElementById("day24"))
            document.querySelector('.day24').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "24";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=24";
            })

        if (document.getElementById("day25"))
            document.querySelector('.day25').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "25";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=25";
            })

        if (document.getElementById("day26"))
            document.querySelector('.day26').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "26";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=26";
            })

        if (document.getElementById("day27"))
            document.querySelector('.day27').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "27";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=27";
            })

        if (document.getElementById("day28"))
            document.querySelector('.day28').addEventListener('click', () => {
                document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "28";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=28";
            })

        if (document.getElementById("day29"))
            document.querySelector('.day29').addEventListener('click', () => {
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "29";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=29";
            })

        if (document.getElementById("day30"))
            document.querySelector('.day30').addEventListener('click', () => {
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "30";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=30";
            })

        if (document.getElementById("day31"))
            document.querySelector('.day31').addEventListener('click', () => {
                // document.cookie += "=;expires=" + new Date(0).toUTCString();
                document.cookie = "date = " + curYear + chooseMonthFormatter + (curMonth + 1) + "-" + "31";
                console.log(document.cookie);
                location.href = "student_day_events.php?month=" + curMonth + "&year=" + curYear + "&date=31";
            })
    };

rendCalendar();

document.querySelector('.prev-month').addEventListener('click', () => {
    console.log("prev month change");
    if (curMonth == 0)
    {
        curMonth = 11;
        curYear -= 1;
    }
    else if (curMonth != 0)
        curMonth -= 1;
    console.log(curMonth);
    date.setMonth(curMonth);
    date.setFullYear(curYear);
    curDate = -1;
    rendCalendar();
});

document.querySelector('.next-month').addEventListener('click', () => {
    console.log("next month change");

    if (curMonth == 11)
    {
        curMonth = 0;
        curYear += 1;
    }
    else if (curMonth != 11)
        curMonth += 1;
    date.setMonth(curMonth);
    date.setFullYear(curYear);
    curDate = -1;
    rendCalendar();
});
</script>
</body>

    </html>

    <?php 
        // echo $_COOKIE["date"];
        // grabPublicEvents($_COOKIE["date"]);
        // $date = $_COOKIE["date"];
        // grabPublicEvents($_COOKIE["date"]);
        function grabPublicEvents($date){
            require('../db_connection.php');
            echo $date;
            $event_names = array();
            $event_times = array();
            $event_locations = array();
            $event_info = array();

            $public_event_query = "SELECT * FROM `public_events` WHERE `date` = '$date'";
            $result = mysqli_query($con, $public_event_query);
            for ($i = 0; $i < mysqli_num_rows($result); $i++){
                $event = mysqli_fetch_assoc($result);
                array_push($event_names, $event['name']);
                array_push($event_times, $event['time_from']);
                array_push($event_locations, $event['location']);
            }
        }
                ?>