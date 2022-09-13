var flag = true;
function menuTransform(x) {
    x.classList.toggle("change");
    document.getElementById("hamburgerMenuWrapper").classList.toggle("change");
    if (flag)
        hamburgerMenu.style.transform = "translate(0," + (-headerHeight/2) + "px)";
    else 
        hamburgerMenu.style.transform = "translate(250%," + (-headerHeight/2) + "px)";

    flag = !flag;
}

document.addEventListener('DOMContentLoaded', () => {
    var headerHeight = document.getElementById("header").offsetHeight;
    // console.log(headerHeight);

    const hamburgerMenu = document.getElementById("hamburgerMenu");
    const firstHamburgerButton = document.getElementById("firstHamburgerButton");

    hamburgerMenu.style.transform = "translate(250%," + (-headerHeight/2) + "px)";
    firstHamburgerButton.style.marginTop = headerHeight + "px";
});

window.addEventListener('resize', function(){
    headerHeight = document.getElementById("header").offsetHeight;
    firstHamburgerButton.style.marginTop = headerHeight + "px";
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

gsap.to("#headerName", {
    scrollTrigger: {
        trigger: "#headerPic",
        start: "center top",
        scrub: 1,
        toggleActions: "restart none reverse none",
    },
    y: 150,
});

headerNameTween = gsap.to("#headerName", {
    scrollTrigger: {
        trigger: "#headerPic",
        start: "bottom top",
        end: "+=20",
        // markers: true,
        scrub: 1,
        toggleActions: "restart none reverse none",
    },
    x: function getWidth(){
            const headerName = document.getElementById('headerName');
            const headerPic = document.getElementById('headerPic');
        
            var windowWidth, sideMargin, headerPicWidth;
        
            windowWidth = window.innerWidth;
            sideMargin = windowWidth * 0.02;
            
            
            headerNameWidth = headerName.offsetWidth;
            console.log(headerNameWidth);  
            
            
            headerPicWidth = headerPic.clientWidth + 6;
            console.log(headerPicWidth); 
            
            console.log(sideMargin);
        
            return -(headerPicWidth + sideMargin*2)
    },
});

window.addEventListener('resize', () => {
    headerNameTween.invalidate();
})

