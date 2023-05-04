window.onload = ()=> {
    //  Get the Bottom Bar
    var bottomBar = document.querySelector(".bottom-bar");
    //  When this function is called, adjust the position and width of the Bottom 
    //  Bar to be same with the element in the parameter
    function adjustBottomBar(item) {
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

    //  Let's get necessary elements in the Nav Section
    var hamburgerMenu = document.querySelector(".hamburger-menu");
    var navBar = document.querySelector(".nav-bar");
    var header = document.querySelector("header");
    var navListItems = document.querySelectorAll(".nav-bar ul li");

    //  When the hamburger menu is clicked,
    hamburgerMenu.addEventListener("click", ()=> {
        //  Toggle the Nav Bar active class to slide it down or up
        navBar.classList.toggle("active");
        //  Change the hamburger menu icon to an X or back to how it was
        hamburgerMenu.classList.toggle("active");
        //  Check if our Nav Bar items are showing. If yes,
        if (navListItems[0].classList.contains("show")) {            
            //  Remove the class 'show' from each of the items to hide them
            navListItems.forEach(item => {
                item.classList.remove("show");
            });
        } else {
            //  Otherwise, call this function to show the Nav Bar items
            showNavListItems();
        }
    });

    function showNavListItems() {
        //  Initialize some variables
        var remItems = navListItems.length;
        //  This will help us keep track of the Nav item to show next
        var currItemNo = 0;
        
        //  This setInterval() function helps us show the Nav list 
        //  items one after the other when opened on mobile devices
        var interval = setInterval(()=> {
            if (currItemNo < remItems) {
                //  Show the first Nav item using the 'currItemNo' as an index
                navListItems[currItemNo].classList.add("show");                
                //  Increment this variable afterwards to help us
                //  show the other Nav items
                currItemNo += 1;

            }
            else {
                //  When we're done showing all the nav items, 
                //  clear the interval
                clearInterval(interval);
            }
        }, 100);
    }

    //  When User clicks on the page and not the header element, 
    //  the Nav Bar should slide back up
    document.onclick = function(event) {        
        var isClickInsideHeader = header.contains(event.target);
        if (isClickInsideHeader !== true){
            navBar.classList.remove("active");
            hamburgerMenu.classList.remove("active");
            
            if (navListItems[0].classList.contains("show")) {            
                navListItems.forEach(item => {
                    item.classList.remove("show");
                });
            }
        }    
    }

    window.onscroll = function() {
        //  Call this function to add a shrink or expand effect to our
        //  header, when the page is scrolled
        shrinkHeader();
    }


    function shrinkHeader() { 
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            header.classList.add("shrinked");
        } else {
            header.classList.remove("shrinked");
        }
    }

    var browserWidth;
    //  When the Browser is resized, perform these actions
    window.addEventListener("resize", ()=> {
            
        //  If the bottom bar is not in the correct position, or does
        //  not have same width as the active Nav item, then adjust it
        if (bottomBar.style.width !== activeNavItem.style.offsetWidth) {
            adjustBottomBar(activeNavItem);
        }

        //  Update the browserWidth variable with the browser's current width
        browserWidth = window.innerWidth;

        //  If the browser width is greater than 1065px, that means it's
        //  wide enough to contain all our nav items
        if (browserWidth > 1065) {
            //  So, remove the active class from the Nav Bar to turn it
            //  from mobile styled Nav to desktop style
            navBar.classList.remove("active");
            //  Do same to the Hamburger Menu to turn it to a
            //  three stacked horizontal line instead of an X 
            hamburgerMenu.classList.remove("active");

            //  Remove the class 'show' from each of the Nav items to hide them
            navListItems.forEach(item => {
                item.classList.remove("show");
            });
        }
        
    });
}                  