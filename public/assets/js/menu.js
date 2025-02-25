const mobileMenuButton = document.getElementById("mobileMenuButton");
let menuFlag = false;
myWidth = window.innerWidth;

window.onresize = displayWindowSize;

restAllCss();

mobileMenuButton.addEventListener("click", function() {

    if(myWidth <= 768 && myWidth >= 576) {
        if(!menuFlag) {
            document.querySelector("nav").style.width = "25rem";
            document.querySelectorAll(".mainBox nav .menu li").forEach(element => {
                element.classList.add("openedTabletMenu");
            });
            document.querySelectorAll(".mainBox nav .menu li a").forEach(element => {
                element.style.display = "inline-block";
            });
            document.querySelector(".mainSec").style.filter = "blur(0.2rem)";
            document.querySelector(".mainBox .headerText").style.cssText = "display: inline-block; padding: 0.7rem 0rem 0rem 0rem;"
            menuFlag = !menuFlag;
        
        } else {
            document.querySelector("nav").style.width = "5.5rem";
            document.querySelectorAll(".mainBox nav .menu li").forEach(element => {
                element.classList.remove("openedTabletMenu");
            });
            document.querySelectorAll(".mainBox nav .menu li a").forEach(element => {
                element.style.display = "none";
            });
            document.querySelector(".mainSec").style.filter = "blur(0rem)";
            document.querySelector(".mainBox .headerText").style.display = "none"
            menuFlag = !menuFlag;
        }
    }  else if (myWidth <= 321) {
        if(!menuFlag) {
            document.querySelector("nav").style.cssText = "display: block; width: 25rem;";
            document.querySelectorAll(".mainBox nav .menu li").forEach(element => {
                element.classList.add("openedMobileMenu");
            });
            document.querySelectorAll(".mainBox nav .menu li a").forEach(element => {
                element.style.display = "inline-block";
            });
            document.querySelector(".mainSec").style.filter = "blur(0.2rem)";

            mobileMenuButton.style.left = "2rem";
            mobileMenuButton.style.transform = "none";

            menuFlag = !menuFlag;
        } else {
            document.querySelector(".mainSec").style.filter = "blur(0rem)";
            document.querySelector("nav").style.cssText = "display: none; width: 4rem;";
            
            mobileMenuButton.style.left = "50%";
            mobileMenuButton.style.transform = "translate(-50%, 0rem)";

            menuFlag = !menuFlag;
        }
    } else if (myWidth < 576) {
        if(!menuFlag) {
            document.querySelector("nav").style.cssText = "display: block; width: 25rem;";
            document.querySelectorAll(".mainBox nav .menu li").forEach(element => {
                element.classList.add("openedMobileMenu");
            });
            document.querySelectorAll(".mainBox nav .menu li a").forEach(element => {
                element.style.display = "inline-block";
            });
            document.querySelector(".mainSec").style.filter = "blur(0.2rem)";
            menuFlag = !menuFlag;
        } else {
            document.querySelector(".mainSec").style.filter = "blur(0rem)";
            document.querySelector("nav").style.cssText = "display: none; width: 4rem;";
            menuFlag = !menuFlag;
        }
    }
});

function displayWindowSize() {
    document.querySelector(".mainSec").style.filter = "blur(0rem)";
    myWidth = window.innerWidth;
    menuFlag = false;
    restAllCss();
};

function restAllCss() {
    if(myWidth > 768) {
        document.querySelector("nav").style.cssText = "display: block; width: 25rem;";
        document.querySelector(".menu").style.cssText = "display: flex; flex-direction: column; justify-content: space-between; min-height: calc(100% - 5rem); padding-top: 3rem; padding-left: 2rem;";

        document.querySelectorAll(".mainBox nav .menu li").forEach(element => {
            element.style.cssText = "font-size: 1.6rem; color: black; margin: 3rem 0rem; font-weight: 600; transition: 0.3s; width: fit-content;";
        });

        document.querySelectorAll(".mainBox nav .menu li svg").forEach(element => {
            element.style.cssText = "color: black; font-weight: 900; transition: 0.3s;";
        });

        document.querySelectorAll(".mainBox nav .menu li a").forEach(element => {
            element.style.display = "inline-block";
        });
    } else if(myWidth <= 768 && myWidth >= 576) {
        document.querySelector("nav").style.cssText = "width: 5.5rem; border-right: 0.11rem solid lightgray; position: absolute; height: 100vh; top: 0; left: 0; padding-left: 2rem; background-color: #f3f3f3; z-index: 1;";
        document.querySelector(".menu").style.cssText = "padding-left: 0rem;";
        document.querySelector("nav .headerText").style.cssText = "width: fit-content; padding: 1rem 0rem 0rem 2rem;";

        document.querySelectorAll(".mainBox nav .menu li").forEach(element => {
            element.style.cssText = "font-size: 1.6rem; color: black; margin: 3rem 0rem; font-weight: 600; transition: 0.3s; width: fit-content;";
        });

        document.querySelectorAll(".mainBox nav .menu li svg").forEach(element => {
            element.style.cssText = "height: 3rem; padding-left: 1rem; font-size: 3.5rem; margin-left: -1rem; padding-right: 1rem;";
        });

        document.querySelectorAll(".mainBox nav .menu li a").forEach(element => {
            element.style.display = "none";
        });
    } else if(myWidth < 321){
        mobileMenuButton.style.left = "50%";
        mobileMenuButton.style.transform = "translate(-50%, 0rem)";
    } else {
        mobileMenuButton.style.left = "2rem";
        mobileMenuButton.style.transform = "none";
    }
    document.getElementsByClassName("active")[0].style.fontWeight = "900";
}

document.getElementsByClassName("mainSec")[0].addEventListener("click", function() {
    document.querySelector(".mainSec").style.filter = "blur(0rem)";
    menuFlag = false;
    document.querySelector("nav").style.cssText = "display: none; width: 4rem;";
    restAllCss();
})