// Header JS

const mainSection = document.getElementById('home');
const projectSection = document.getElementById('projects');
const aboutSection = document.getElementById('about');
const footerSection = document.getElementById('footer');

var flag = true;
function menuTransform(x) {
    x.classList.toggle("change");
    const headerHeight = document.getElementById("header").offsetHeight;
    // console.log(headerHeight);
    document.getElementById("hamburgerMenuWrapper").classList.toggle("change");
    if (flag)
    {
        hamburgerMenu.style.transform = "translate(0," + (-headerHeight/2) + "px)";
        mainSection.style.filter = 'blur(20px)';
        projectSection.style.filter = 'blur(20px)';
        aboutSection.style.filter = 'blur(20px)';
        footerSection.style.filter = 'blur(20px)';
    }
    else
    { 
        hamburgerMenu.style.transform = "translate(250%," + (-headerHeight/2) + "px)";
        mainSection.style.filter = 'blur(0)';
        projectSection.style.filter = 'blur(0)';
        aboutSection.style.filter = 'blur(0)';
        footerSection.style.filter = 'blur(0)';
    }

    flag = !flag;
}

document.addEventListener('DOMContentLoaded', () => {
    var headerHeight = document.getElementById("header").offsetHeight;
    // console.log(headerHeight);

    const hamburgerMenu = document.getElementById("hamburgerMenu");
    const firstHamburgerButton = document.getElementById("firstHamburgerButton");

    hamburgerMenu.style.transform = "translate(250%," + (-headerHeight/2) + "px)";
    firstHamburgerButton.style.marginTop = (headerHeight + 16) + "px";
});

window.addEventListener('resize', function(){
    headerHeight = document.getElementById("header").offsetHeight;
    firstHamburgerButton.style.marginTop = (headerHeight + 16) + "px";
    // console.log(headerHeight);
});

gsap.registerPlugin(ScrollTrigger);

gsap.to("#headerPic", {
    scrollTrigger: {
        trigger: "#headerPic",
        start: "center top",
        end: "+=150",
        scrub: 1,
        toggleActions: "restart none reverse none",
    },
    y: -200,
});

// gsap.to("#headerName", {
//     scrollTrigger: {
//         trigger: "#headerPic",
//         start: "center top",
//         scrub: 1,
//         toggleActions: "restart none reverse none",
//     },
//     y: 150,
// });

// headerNameTween = gsap.to("#headerName", {
//     scrollTrigger: {
//         trigger: "#headerPic",
//         start: "bottom top",
//         end: "+=20",
//         // markers: true,
//         scrub: 1,
//         toggleActions: "restart none reverse none",
//     },
//     x: function getWidth(){
//             const headerName = document.getElementById('headerName');
//             const headerPic = document.getElementById('headerPic');
        
//             var windowWidth, sideMargin, headerPicWidth;
        
//             windowWidth = window.innerWidth;
//             sideMargin = windowWidth * 0.04;
            
            
//             headerNameWidth = headerName.offsetWidth;
//             // console.log(headerNameWidth);  
            
            
//             headerPicWidth = headerPic.clientWidth + 6;
//             // console.log(headerPicWidth); 
            
//             // console.log(sideMargin);
        
//             return -(headerPicWidth + sideMargin*2)
//     },
// });

window.addEventListener('resize', () => {
    headerNameTween.invalidate();
})

