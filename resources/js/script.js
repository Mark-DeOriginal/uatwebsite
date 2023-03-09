window.onload = function () {
    
    //When this function is called, adjust the position and width of the Bottom 
    //Bar to be same with the element in the parameter
    function adjustBottomBar(item) {

        var bottomBar = document.querySelector(".bottom-bar");
        //  Run this code block if we've confirmed that the Bottom Bar is actually showing
        if (window.getComputedStyle(bottomBar).display !== 'none') {
            bottomBar.style.width = item.offsetWidth + "px";
            bottomBar.style.transform = "translateX(" + item.offsetLeft + "px)";
        }
        
    }


    //Get the currently active Nav Item
    var activeNavItem = document.querySelector(".nav-bar ul li a.active");
    //Call this function and pass the currently active Nav Item
    //as an argument, to adjust and make the width and position 
    //of our bottom bar same as the active Nav Item
    adjustBottomBar(activeNavItem);

    //Get all the Nav Items,
    var navItems = document.querySelectorAll("nav ul li a");

    //Attach some event listeners to them
    navItems.forEach(navItem => {

        //When any of the item is hovered on, call the 
        //adjustBottomBar() function and pass the currently
        //hovered item as an argument, to enable us set the
        //position and width property of the Bottom Bar to 
        //be same as the currently hovered element.
        navItem.addEventListener('mouseenter', ()=> {
            adjustBottomBar(navItem);
        });

        //When the mouse pointer leaves the currently hovered item,
        //make the width and position of the Bottom Bar to be 
        //same as the Nav Item with the active class
        navItem.addEventListener('mouseleave', ()=> {
            adjustBottomBar(activeNavItem);
        });
    });

    var hamburgerMenu = document.querySelector(".hamburger-menu");
    var navBar = document.querySelector(".nav-bar");

    hamburgerMenu.addEventListener("click", ()=> {
        navBar.classList.toggle("active");
    });

    window.addEventListener("resize", ()=> {
        if (window.innerWidth > 1065) {
            navBar.classList.remove("active");
        } 
    });
           
    
}