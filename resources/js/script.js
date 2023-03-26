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
            //  Otherwise, run this function to show the Nav Bar items
            showNavListItems();
        }
    });

    function showNavListItems() {
        //  Initialize some variables
        var remItems = navListItems.length;
        var currItemNo = 0;
        
        //  This setInterval function helps us show the list items one after the other
        var interval = setInterval(()=> {
            if (currItemNo < remItems) {
                navListItems[currItemNo].classList.add("show");                
                currItemNo += 1;
            }
            else {
                clearInterval(interval);
            }
        }, 100);
    }
   

    //  When User clicks on the page, and not the header element, the Nav Bar slides back up
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

    //  Let's add a shrink effect that will be applied to our header when the page is scrolled
    window.onscroll = function() {
        shrinkHeader();
    }

    function shrinkHeader() { 
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            header.classList.add("shrinked");
        } else {
            header.classList.remove("shrinked");
        }
    }

    //  Get necessary elements from the testimonial container
    var testimonialContainer = document.querySelector(".testimonial-container");
    var sliderForwardBtn = document.querySelector(".arrow-right");
    var sliderBackwardsBtn = document.querySelector(".arrow-left");
    var testimonialCards = document.querySelectorAll(".testimonial-container .card");


    //  This holds the updated translateX of the testimonial cards
    var newTranslateX = 0;
    var repositionX = 0;
    //  This holds the number of cards remaining
    var remCards = testimonialCards.length;

    //  When the Browser is resized, perform these actions
    window.addEventListener("resize", ()=> {
        if (window.innerWidth > 1065) {
            navBar.classList.remove("active");
            hamburgerMenu.classList.remove("active");

            //  Remove the class 'show' from each of the Nav items to hide them
            navListItems.forEach(item => {
                item.classList.remove("show");
            });
        }
        
        //  Any time user resizes the browser, go back to the 
        //  first slide
        testimonialCards.forEach(card => {
            card.style.transform = `translateX(${repositionX}px)`;
        });

        //  After that, let's update this variable and
        //  make it same with the variable, repositionX, so we
        //  will not have a problem when the forward or backward button is pressed
        newTranslateX = repositionX;
        //  Let's also reset this variable to its original value
        remCards = testimonialCards.length;

        //  Since we are now in the first slide,
        if (sliderBackwardsBtn.classList.contains("btn-disabled") == false) {
            sliderBackwardsBtn.classList.add("btn-disabled");            
        }
        if (sliderForwardBtn.classList.contains("btn-disabled") == true) {
            sliderForwardBtn.classList.remove("btn-disabled");
            
        }
    });


    //  When the testimonial slider right arrow button is clicked,
    sliderForwardBtn.addEventListener("click", ()=> {                
        
        if (sliderForwardBtn.classList.contains("btn-disabled") == false) {
            //  Run this function and pass preferred sliding direction as its argument
            //  to slide the testimonial cards
            slideTestimonialCards (testimonialCards, "left");
        }        
          
    });

    //  When the testimonial slider left arrow button is clicked,
    sliderBackwardsBtn.addEventListener("click", ()=> {        

        if (sliderBackwardsBtn.classList.contains("btn-disabled") == false) {
            //  Run this function and pass preferred sliding direction as its argument
            //  to slide the testimonial cards
            slideTestimonialCards (testimonialCards, "right");
        }        
        
    });

    //  We will call this function to slide the testimonial cards
    function slideTestimonialCards (cards, slidingDirection) {       

        //  Get the offsetWidth of the testimonial cards
        var cardsOffsetWidth = cards[0].offsetWidth;

        //  Get the width of the Browser Window        
        var browserWidth = window.innerWidth;
        //  Based on the Browser's Window width, return the number of testimonial 
        //  cards that should be shown at once
        var cardsPerSlide = browserWidth <= 750 ? 1     // If device-width is <= 750px, return 1
                        : browserWidth <= 1080 ? 2  // else if it's <= 1080px, return 2
                        : 3;                       // else, return 3

        //  Get one of the testimonial cards, and an array of its css styles
        var card = window.getComputedStyle(cards[0]);
        //  Get the left margin of the card
        var cardsMargin = card.marginLeft;

        //  Check the preferred sliding direction. Return '-1' if the
        //  direction is left and '1' if it's right
        //  We will multiply this by the total distance the testimonial cards
        //  will be sliding, to return either a negative or positive value.
        //  A positive value will make the testimonial cards slide right,
        //  while a negative one will make it slide left.
        var direction = slidingDirection == "left" ? -1  
                        : slidingDirection == "right" ? 1 
                        : 0;

        //  Slide the testimonial cards using total obtained from this formula:
        //  Sliding distance = ((cardsOffsetWidth * cardsPerSlide) + ((cardsMargin * 2) * cardsPerSlide)) * direction
        //  Or we can also slide the cards using the testimonial container offsetWidth and multiply it by the direction variable value, which is either -1 or 1, to make it slide left or right
        newTranslateX += ((cardsOffsetWidth * cardsPerSlide) + ((Number(cardsMargin.split(/[a-zA-Z]+/)[0]) * 2) * cardsPerSlide)) * direction;
        
        //  Testing some variable values using the console
        console.log(('20.3px').split(/[a-zA-Z]+/)[0]);
        console.log(newTranslateX);
        console.log(remCards);
        
        cards.forEach(card => {
            //  Slide the testimonial cards
            card.style.transform = `translateX(${newTranslateX}px)`;
        });

        if (slidingDirection == "right") {
            remCards += cardsPerSlide;

            if (sliderForwardBtn.classList.contains("btn-disabled") == true) {
                sliderForwardBtn.classList.remove("btn-disabled");
                
            }
            if (remCards >= testimonialCards.length && sliderBackwardsBtn.classList.contains("btn-disabled") == false) {
                sliderBackwardsBtn.classList.add("btn-disabled");
            }
        }
        if (slidingDirection == "left") {
            remCards -= cardsPerSlide;

            if (sliderBackwardsBtn.classList.contains("btn-disabled") == true) {
                sliderBackwardsBtn.classList.remove("btn-disabled");
                
            }
            if (remCards < 3 && sliderForwardBtn.classList.contains("btn-disabled") == false) {  
                sliderForwardBtn.classList.add("btn-disabled");           
            }
        }
    }

    //  Let's add a feature to help users slide the
    //  testimonial cards by sliding left or right on the testimonial cards
    
    //  Define some useful variables
    var dragStartPosX,
        dragEndPosX,
        dragDistance;
    var currentDragPosX;

    //  We will use these to check if the mousedown 
    //  or touchstart event is firing. 
    var isMouseDown = false;
    var isTouchStart = false;

    //  This will help us make sure the 
    //  drag is happening inside the testimonial container
    var isDragInsideTestimonialContainer;

    var testimonialCardsPrevPosX;
    
    //  Let's capture Mouse events for PCs
    testimonialContainer.addEventListener("mousedown", registerDragStartPosX);
    testimonialContainer.addEventListener("mousemove", dragTestimonialCards);
    testimonialContainer.addEventListener("mouseup", registerDragEndPosX);

    //  Touch events for mobile devices
    testimonialContainer.addEventListener("touchstart", registerDragStartPosX);
    testimonialContainer.addEventListener("touchmove", dragTestimonialCards);
    testimonialContainer.addEventListener("touchend", registerDragEndPosX);

    var distanceDisplayer = document.querySelector("div.distance-moved");

    function registerDragStartPosX(event) {
        
        if (event.type === "mousedown") {
            isMouseDown = true;
            dragStartPosX = event.clientX;
            console.log("Drag start is " + dragStartPosX + "px from the left of the screen");
        }

        if (event.type === "touchstart") {
            isTouchStart = true;
            dragStartPosX = event.touches[0].clientX;
            console.log("Touch start is " + dragStartPosX + "px from the left of the screen");
        }

        isDragInsideTestimonialContainer = testimonialContainer.contains(event.target); // Will return true or false
        distanceDisplayer.style.display = "block";
    }

    function calculateDragDistance(event) {
        if (isMouseDown == true) {
            currentDragPosX = event.clientX;
            dragDistance = currentDragPosX - dragStartPosX;
        }

        if (isTouchStart == true) {
            currentDragPosX = event.touches[0].clientX;
            dragDistance = currentDragPosX - dragStartPosX;
        }
    }

    function dragTestimonialCards(event) {
        
        if (isMouseDown == true || isTouchStart == true) {
            if (isDragInsideTestimonialContainer == true) {
                calculateDragDistance(event);
    
                if (dragStartPosX > currentDragPosX) { // This means the user is sliding left
    
                } else { // Else, then the user is sliding right
    
                }
    
                testimonialCardsPrevPosX = newTranslateX;
    
                testimonialCards.forEach(card => {
                    //  Slide the testimonial cards
                    card.style.transform = `translateX(${testimonialCardsPrevPosX + dragDistance}px)`;
                });
    
                distanceDisplayer.innerHTML = "<p>Distance X: " + dragDistance + "</p>";
            }
        }        

    }

    function registerDragEndPosX(event) {

        if (event.type === "mouseup") {
            isMouseDown = false;
            dragEndPosX = event.clientX;
            console.log("Drag end is " + dragEndPosX + "px from the left of the screen");
        }

        if (event.type === "touchend") {
            isTouchStart = false;
            dragEndPosX = event.changedTouches[0].clientX;
            console.log("Touch end is " + dragEndPosX + "px from the left of the screen");
        }
        
        dragDistance = dragEndPosX - dragStartPosX;
        console.log("The drag distance is " + dragDistance + "px");

        newTranslateX += dragDistance;
        testimonialCardsPrevPosX = newTranslateX;
    }
}