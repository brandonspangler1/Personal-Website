const date = new Date();

const rendCalendar = () => {

    const monthDays = document.querySelector(".days");

    const month = date.getMonth();

    const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate()

    const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate()

    console.log(date.getDay());

    const firstDayIndex = date.getDay();

    const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDay();

    const nextDays = 7 - lastDayIndex - 1;

    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    document.querySelector(".date h1").innerHTML = months[date.getMonth()];

    document.querySelector(".date p").innerHTML = new Date().toDateString();

    let days = "";

    for (let j = firstDayIndex; j > 0; j--) {
        days += `<div class="prev-date">${prevLastDay - j + 1}</div>`;
    }

    for (let i = 1; i <= lastDay; i++) {
        if (i === new Date().getDate() && date.getMonth() === new Date().getMonth()) {
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



    if (document.getElementById("today"))
        document.querySelector('.today').addEventListener('click', () => {
            console.log("Today: " + date.getDate());
            document.querySelector('.eventType p').innerHTML = "";
            document.querySelector('.timeList p').innerHTML = "";
            for (let i = 0; i < eventList1.length; i++) {
                document.querySelector('.eventType p').innerHTML += eventList1[i] + "</br></br>";
                document.querySelector('.timeList p').innerHTML += timeList1[i] + "</br></br>";
            }
        })

    if (document.getElementById("day1"))
        document.querySelector('.day1').addEventListener('click', () => {
            console.log(date.getMonth() + ", " + 1);
            document.querySelector('.eventType p').innerHTML = "Brandons a bitch";
        })

    if (document.getElementById("day2"))
        document.querySelector('.day2').addEventListener('click', () => {
            console.log(2);
        })

    if (document.getElementById("day3"))
        document.querySelector('.day3').addEventListener('click', () => {
            console.log(3);
        })

    if (document.getElementById("day4"))
        document.querySelector('.day4').addEventListener('click', () => {
            console.log(4);
        })

    if (document.getElementById("day5"))
        document.querySelector('.day5').addEventListener('click', () => {
            console.log(5);
        })

    if (document.getElementById("day6"))
        document.querySelector('.day6').addEventListener('click', () => {
            console.log(6);
        })

    if (document.getElementById("day7"))
        document.querySelector('.day7').addEventListener('click', () => {
            console.log(7);
        })

    if (document.getElementById("day8"))
        document.querySelector('.day8').addEventListener('click', () => {
            console.log(8);
        })

    if (document.getElementById("day9"))
        document.querySelector('.day9').addEventListener('click', () => {
            console.log(9);
        })

    if (document.getElementById("day10"))
        document.querySelector('.day10').addEventListener('click', () => {
            console.log(10);
        })

    if (document.getElementById("day11"))
        document.querySelector('.day11').addEventListener('click', () => {
            console.log(11);
        })

    if (document.getElementById("day12"))
        document.querySelector('.day12').addEventListener('click', () => {
            console.log(12);
        })

    if (document.getElementById("day13"))
        document.querySelector('.day13').addEventListener('click', () => {
            console.log(13);
        })

    if (document.getElementById("day14"))
        document.querySelector('.day14').addEventListener('click', () => {
            console.log(14);
        })

    if (document.getElementById("day15"))
        document.querySelector('.day15').addEventListener('click', () => {
            console.log(15);
        })

    if (document.getElementById("day16"))
        document.querySelector('.day16').addEventListener('click', () => {
            console.log(16);
        })

    if (document.getElementById("day17"))
        document.querySelector('.day17').addEventListener('click', () => {
            console.log(17);
        })

    if (document.getElementById("day18"))
        document.querySelector('.day18').addEventListener('click', () => {
            console.log(18);
        })

    if (document.getElementById("day19"))
        document.querySelector('.day19').addEventListener('click', () => {
            console.log(19);
        })

    if (document.getElementById("day20"))
        document.querySelector('.day20').addEventListener('click', () => {
            console.log(20);
        })

    if (document.getElementById("day21"))
        document.querySelector('.day21').addEventListener('click', () => {
            console.log(21);
        })

    if (document.getElementById("day22"))
        document.querySelector('.day22').addEventListener('click', () => {
            console.log(22);
        })

    if (document.getElementById("day23"))
        document.querySelector('.day23').addEventListener('click', () => {
            console.log(23);
        })

    if (document.getElementById("day24"))
        document.querySelector('.day24').addEventListener('click', () => {
            console.log(24);
        })

    if (document.getElementById("day25"))
        document.querySelector('.day25').addEventListener('click', () => {
            console.log(25);
        })

    if (document.getElementById("day26"))
        document.querySelector('.day26').addEventListener('click', () => {
            console.log(26);
        })

    if (document.getElementById("day27"))
        document.querySelector('.day27').addEventListener('click', () => {
            console.log(27);
        })

    if (document.getElementById("day28"))
        document.querySelector('.day28').addEventListener('click', () => {
            console.log(28);
        })

    if (document.getElementById("day29"))
        document.querySelector('.day29').addEventListener('click', () => {
            console.log(29);
        })

    if (document.getElementById("day30"))
        document.querySelector('.day30').addEventListener('click', () => {
            console.log(30);
        })

    if (document.getElementById("day31"))
        document.querySelector('.day31').addEventListener('click', () => {
            console.log(31);
        })
};

rendCalendar();

document.querySelector('.prev-month').addEventListener('click', () => {
    console.log("prev month change");
    date.setMonth(date.getMonth() - 1);
    date.setFullYear(date.getFullYear());
    rendCalendar();
});

document.querySelector('.next-month').addEventListener('click', () => {
    console.log("next month change");
    date.setMonth(date.getMonth() + 1);
    date.setFullYear(date.getFullYear());
    rendCalendar();
});