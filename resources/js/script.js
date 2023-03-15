window.onload = function () {
    
    //  When this function is called, adjust the position and width of the Bottom 
    //  Bar to be same with the element in the parameter
    function adjustBottomBar(item) {

        var bottomBar = document.querySelector(".bottom-bar");
        //  Run this code block if we've confirmed that the Bottom Bar is actually showing
        if (window.getComputedStyle(bottomBar).display !== 'none') {
            bottomBar.style.width = item.offsetWidth + "px";
            bottomBar.style.transform = "translateX(" + item.offsetLeft + "px)";
        }
        
    }


    //  Get the currently active Nav Item
    var activeNavItem = document.querySelector(".nav-bar ul li a.active");
    //  Call this function and pass the currently active Nav Item
    //  as an argument, to adjust and make the width and position 
    //  of our bottom bar same as the active Nav Item
    adjustBottomBar(activeNavItem);

    //  Get all the Nav Items,
    var navItems = document.querySelectorAll("nav ul li a");

    //  Attach some event listeners to them
    navItems.forEach(navItem => {

        //  When any of the item is hovered on, call the 
        //  adjustBottomBar() function and pass the currently
        //  hovered item as an argument, to enable us set the
        //  position and width property of the Bottom Bar to 
        //  be same as the currently hovered element.
        navItem.addEventListener('mouseenter', ()=> {
            adjustBottomBar(navItem);
        });

        //  When the mouse pointer leaves the currently hovered item,
        //  make the width and position of the Bottom Bar to be 
        //  same as the Nav Item with the active class
        navItem.addEventListener('mouseleave', ()=> {
            adjustBottomBar(activeNavItem);
        });
    });

    var hamburgerMenu = document.querySelector(".hamburger-menu");
    var navBar = document.querySelector(".nav-bar");
    var header = document.querySelector("header");
    var navListItems = document.querySelectorAll(".nav-bar ul li");
    
    hamburgerMenu.addEventListener("click", ()=> {
        navBar.classList.toggle("active");
        hamburgerMenu.classList.toggle("active");

        if (navListItems[0].classList.contains("show")) {            
            navListItems.forEach(item => {
                item.classList.remove("show");
            });
        } else {
           showNavListItems();
        }
    });

    function showNavListItems() {
        var remItems = navListItems.length;
        var currItemNo = 0;
        
        //  This setInterval function helps us show the list items one after the other
        var interval = setInterval(()=> {
            if (currItemNo < remItems) {
                navListItems[currItemNo].classList.toggle("show");                
                currItemNo += 1;
            }
            else {
                clearInterval(interval);
            }
        }, 100);
    }

    //  When the device width is greater than 1065px, perform these actions
    window.addEventListener("resize", ()=> {
        if (window.innerWidth > 1065) {
            navBar.classList.remove("active");
            hamburgerMenu.classList.remove("active");
        } 
    });   

    //  When User clicks on the page, and not the header element, the Nav Bar slides back up
    document.onclick = function(target) {        
        var isClickInsideHeader = header.contains(event.target);
        if (isClickInsideHeader !== true){
            navBar.classList.remove("active");
            hamburgerMenu.classList.remove("active");
            
            navListItems.forEach(item => {
                item.classList.remove("show");
            });
        }    
    }

    //  Let's add a shrink effect that will be applied to our header when the page is scrolled
    window.onscroll = function() {
        shrinkHeader();
    }

    function shrinkHeader() { 
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            header.classList.add("shrinked");
        } else {
            header.classList.remove("shrinked");
        }
    }

}