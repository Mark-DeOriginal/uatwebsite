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
    var testimonialPaginationContainer = document.querySelector(".testimonial-pagination");

    //  Get the width of the Browser Window        
    var browserWidth = window.innerWidth;
    //  Based on the Browser's Window width, return the number of testimonial 
    //  cards that should be shown at once
    var noOfCardsOnFirstSlide = browserWidth <= 750 ? 1     // If device-width is <= 750px, return 1
                              : browserWidth <= 1080 ? 2  // else if it's <= 1080px, return 2
                              : 3;                       // else, return 3
    
    //  This holds how many cards we wish to slide by
    var defaultCardToSlide = 1;
    var cardsToSlide = defaultCardToSlide;
    
    const totalNoOfSlides = testimonialCards.length;
    var slidesRemaining = totalNoOfSlides - noOfCardsOnFirstSlide;

    var paginationButtons;
    var noOfPaginationBtnsToCreate;
    var activePaginationBtnID = 0;
    var previousSlideID = 0;
    var currentSlideID;
    
    //  This holds the updated translateX of the testimonial cards
    var cardsTranslateX = 0;
    var repositionX = 0;

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

    var isDraggingFromImage;

    var testimonialCardsPrevPosX;

    var canDrag = false;
    var wasDragged = false;

    //  When the Browser is resized, perform these actions
    window.addEventListener("resize", ()=> {
        browserWidth = window.innerWidth;

        if (browserWidth > 1065) {
            navBar.classList.remove("active");
            hamburgerMenu.classList.remove("active");

            //  Remove the class 'show' from each of the Nav items to hide them
            navListItems.forEach(item => {
                item.classList.remove("show");
            });
        }


        noOfPaginationBtnsToCreate = browserWidth <= 750 ? totalNoOfSlides : browserWidth <= 1080 ? totalNoOfSlides -1 : browserWidth > 1080 ? totalNoOfSlides - 2 : totalNoOfSlides;
        activePaginationBtnID = 0;
        testimonialPaginationContainer.innerHTML = "";
        createPaginationBtns(); 
        
        //  Any time user resizes the browser, go back to the 
        //  first slide
        testimonialCards.forEach(card => {
            card.style.transform = `translateX(${repositionX}px)`;
        });

        //  After that, let's update this variable and
        //  make it same with the variable, repositionX, so we
        //  will not have a problem when the forward or backward button is pressed
        cardsTranslateX = repositionX;
        //  Let's also reset this variable to its original value
        slidesRemaining = totalNoOfSlides;

        browserWidth = window.innerWidth;
        noOfCardsOnFirstSlide = browserWidth <= 750 ? 1     // If device-width is <= 750px, return 1
                              : browserWidth <= 1080 ? 2  // else if it's <= 1080px, return 2
                              : 3;
        slidesRemaining = totalNoOfSlides - noOfCardsOnFirstSlide;

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
            wasDragged = true;
            slideTestimonialCards (testimonialCards, "left", "auto");
        }        
          
    });

    //  When the testimonial slider left arrow button is clicked,
    sliderBackwardsBtn.addEventListener("click", ()=> {        

        if (sliderBackwardsBtn.classList.contains("btn-disabled") == false) {
            //  Run this function and pass preferred sliding direction as its argument
            //  to slide the testimonial cards
            wasDragged = true;
            slideTestimonialCards (testimonialCards, "right", "auto");
        }        
        
    });

    //  We will call this function to slide the testimonial cards
    function slideTestimonialCards (cards, slidingDirection, slideTo) {       

        //  Get the offsetWidth of the testimonial cards
        var cardsOffsetWidth = cards[0].offsetWidth;

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
                        : 1;

        if (slideTo == "auto") {
            //  Slide the testimonial cards using total obtained from this formula:
            //  Sliding distance = ((cardsOffsetWidth * noOfCardsOnFirstSlide) + ((cardsMargin * 2) * noOfCardsOnFirstSlide)) * direction
            //  Or we can also slide the cards using the testimonial container offsetWidth and multiply it by the direction variable value, which is either -1 or 1, to make it slide left or right
            cardsTranslateX += ((cardsOffsetWidth * cardsToSlide) + ((Number(cardsMargin.split(/[a-zA-Z]+/)[0]) * 2) * cardsToSlide)) * direction;
        } else {
            cardsTranslateX = ((cardsOffsetWidth * slideTo) + ((Number(cardsMargin.split(/[a-zA-Z]+/)[0]) * 2) * slideTo)) * -1;
        }
        
        cardsOriginalTranslateX = cardsTranslateX;

        // Testing some values using the console
        // console.log(('20.3px').split(/[a-zA-Z]+/)[0]);
        
        cards.forEach(card => {
            //  Slide the testimonial cards
            card.style.transition = "0.8s";
            card.style.transform = `translateX(${cardsTranslateX}px)`;
        });

        if (slidingDirection == "right") {
            

            
            if (wasDragged == true) {
                activePaginationBtnID -= 1;
                slidesRemaining += 1;
            } else {
                if (activePaginationBtnID == 0) {
                    slidesRemaining =  totalNoOfSlides - noOfCardsOnFirstSlide;
                } else {
                    slidesRemaining = (totalNoOfSlides - noOfCardsOnFirstSlide) - activePaginationBtnID;
                }
                
            }

            paginationButtons.forEach(all => {
                all.classList.remove("active");
            });
            paginationButtons[activePaginationBtnID].classList.add("active");

            if (sliderForwardBtn.classList.contains("btn-disabled") == true) {
                sliderForwardBtn.classList.remove("btn-disabled");
                
            }
            if (slidesRemaining == totalNoOfSlides - noOfCardsOnFirstSlide && sliderBackwardsBtn.classList.contains("btn-disabled") == false) {
                sliderBackwardsBtn.classList.add("btn-disabled");
            }
        }
        if (slidingDirection == "left") {
            

            if (wasDragged == true) {
                activePaginationBtnID += 1;
                slidesRemaining -= 1;
            } else { 
                
                slidesRemaining = (totalNoOfSlides - noOfCardsOnFirstSlide) - activePaginationBtnID;
                
                
            }
            
            paginationButtons.forEach(all => {
                all.classList.remove("active");
            });
            paginationButtons[activePaginationBtnID].classList.add("active");

            if (sliderBackwardsBtn.classList.contains("btn-disabled") == true) {
                sliderBackwardsBtn.classList.remove("btn-disabled");
                
            }
            if (slidesRemaining == 0 && sliderForwardBtn.classList.contains("btn-disabled") == false) {  
                sliderForwardBtn.classList.add("btn-disabled");           
            }
        }

        canDrag =  true;
        wasDragged =  false;
    }

    //  Let's add a feature to help users slide the
    //  testimonial cards by sliding left or right on the testimonial cards
    
    //  Let's capture Mouse events for PCs
    testimonialContainer.addEventListener("mousedown", registerDragStartPosX);
    testimonialContainer.addEventListener("mousemove", dragTestimonialCards);
    testimonialContainer.addEventListener("mouseup", registerDragEndPosX);
    testimonialContainer.addEventListener("mouseleave", handleDragLeave);

    //  Touch events for touch enabled devices
    testimonialContainer.addEventListener("touchstart", registerDragStartPosX);
    testimonialContainer.addEventListener("touchmove", dragTestimonialCards);
    testimonialContainer.addEventListener("touchend", registerDragEndPosX);
    testimonialContainer.addEventListener("touchcancel", handleDragLeave);

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

        //  Didn't like the outcome, so let me comment it out
        //  isDraggingFromImage = event.target.tagName.toLowerCase() === 'img' || event.target.nodeName.toLowerCase() === 'img';
        
        isDragInsideTestimonialContainer = testimonialContainer.contains(event.target); // Will return true or false
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

        //  Since touch screen devices depend on  
        //  sliding the screen to scroll, let's not 
        //  use preventDefault() on touch screen devices
        var isTouchScreen = event.type === "touchmove";
        if (isTouchScreen == false) {
            event.preventDefault();
        }

        if (isMouseDown == true || isTouchStart == true) {
            if (isDragInsideTestimonialContainer == true) {
                calculateDragDistance(event);

                if (currentDragPosX > dragStartPosX) { // This means user is dragging right
                    if (sliderBackwardsBtn.classList.contains("btn-disabled") == false) {
                        dragCards("no-resistance");
                        canDrag = true;
                    } else {                        
                        canDrag = false;
                        dragCards("10-percent-resistance"); // We will snap back to undo this drag, since the user isn't supposed to drag at this point
                    }
                }
                else if (dragStartPosX > currentDragPosX) { // User is sliding left
                    dragCards("no-resistance");
                    canDrag = true;
                    if (sliderForwardBtn.classList.contains("btn-disabled") == false) {
                        dragCards("no-resistance");
                        canDrag = true;
                    } else {                        
                        canDrag = false;
                        dragCards("10-percent-resistance"); // We will snap back to undo this drag, since the user isn't supposed to drag at this point
                    }
                }

            }
        }       

    }

    function dragCards(resistance) {
        var dragResistance = resistance == "no-resistance" ? "1" : resistance == "10-percent-resistance" ? "10" : "1";
        var translateDuration = dragResistance == "1" ? "0.8s" : "0.3s";
        
        testimonialCardsPrevPosX = cardsTranslateX;

        testimonialCards.forEach(card => {
            //  Slide the testimonial cards
            card.style.transition = translateDuration;
            card.style.transform = `translateX(${testimonialCardsPrevPosX + (dragDistance / parseInt(dragResistance))}px)`;
        });

        wasDragged = true;

    }

    function registerDragEndPosX(event) {
        if (event.type !== "touchend") {
            event.preventDefault();
        }
        
        if (isMouseDown == true || isTouchStart == true) {
            if (canDrag == true) {

                if (event.type === "mouseup") {
                    isMouseDown = false;
                    console.log("Drag end is " + dragEndPosX + "px from the left of the screen");
                }
    
                if (event.type === "touchend") {
                    isTouchStart = false;
                    console.log("Touch end is " + dragEndPosX + "px from the left of the screen");
                }
                
                dragDistance = currentDragPosX - dragStartPosX;
                console.log("The drag distance is " + dragDistance + "px");
                
                if (wasDragged == true) {
                    if (Math.abs(dragDistance) > 70) {

                        if (currentDragPosX > dragStartPosX) { // This means user is dragging right
                            slideTestimonialCards (testimonialCards, "right", "auto");
                        }
                        else if (dragStartPosX > currentDragPosX) { // User is sliding left
                            slideTestimonialCards (testimonialCards, "left", "auto");
                        }
                        
                    } else {
                        undoCardsDrag("auto");
                    }

                    
                }                
                
                
                console.log(cardsTranslateX);
    
    
            } else {
                
                if (sliderBackwardsBtn.classList.contains("btn-disabled") == true) {
                    undoCardsDrag("left-end");
                    isMouseDown = false;
                    isTouchStart = false;
                } else if (sliderForwardBtn.classList.contains("btn-disabled") ==  true) {
                    undoCardsDrag("right-end");
                    isMouseDown = false;
                    isTouchStart = false;
                }
            }


        }
        
    }

    function handleDragLeave() {

        if (isMouseDown == true || isTouchStart == true) {
            if (canDrag == true && isDraggingFromImage == false) {

                isMouseDown = false;
                isTouchStart = false;
    
                dragDistance = currentDragPosX - dragStartPosX;
                console.log("The drag distance is " + dragDistance + "px");

                if (Math.abs(dragDistance) > 70) {

                    if (currentDragPosX > dragStartPosX) { // This means user is dragging right
                        slideTestimonialCards (testimonialCards, "right", "auto");
                    }
                        else if (dragStartPosX > currentDragPosX) { // User is sliding left
                        slideTestimonialCards (testimonialCards, "left", "auto");
                    }
                    
                } else {
                    undoCardsDrag("auto");
                }

                
    
            } else {
                if (sliderBackwardsBtn.classList.contains("btn-disabled") == true) {
                    undoCardsDrag("left-end");
                } else if (sliderForwardBtn.classList.contains("btn-disabled") ==  true) {
                    undoCardsDrag("right-end");                
                }
    
                isMouseDown = false;
                isTouchStart = false;
            }
        }
        
        
    }

    function undoCardsDrag(toRightEndOrLeftEnd) {
        // cardsTranslateX = window.getComputedStyle(testimonialCards[0]).getPropertyValue('transform').split(',')[4];
        var snapBack = toRightEndOrLeftEnd == "left-end" ? 0 : toRightEndOrLeftEnd == "right-end" || "auto" ? cardsTranslateX : 0;
        testimonialCards.forEach(card => {
            //  Slide the testimonial cards
            card.style.transform = `translateX(${snapBack}px)`;
        });
        wasDragged = false;
    }


    function createPaginationBtns() {
        for (i = 0; i < noOfPaginationBtnsToCreate; i++) {
            testimonialPaginationContainer.innerHTML += `
            <div class="pagination-btn" data-slide-id="${i}"></div>
            `;
        }
        
        paginationButtons = document.querySelectorAll(".testimonial-pagination .pagination-btn");
        paginationButtons[0].classList.add("active");
        
        paginationButtons.forEach(paginationButton => {
            paginationButton.addEventListener('click', ()=> {
                if (paginationButton.classList.contains("active") == false) {
                    
                    currentSlideID = Number(paginationButton.dataset.slideId);
                    
                    var direction = currentSlideID > previousSlideID ? "left" : "right"; 

                    previousSlideID = currentSlideID;

                    
                    paginationButtons[activePaginationBtnID].classList.remove("active");
                
                    activePaginationBtnID = Number(paginationButton.dataset.slideId);
                
                    paginationButtons[activePaginationBtnID].classList.add("active");
                

                    if (sliderForwardBtn.classList.contains("btn-disabled") == true) {
                        sliderForwardBtn.classList.remove("btn-disabled");
                        
                    }
                    
                    if (sliderBackwardsBtn.classList.contains("btn-disabled") == true) {
                        sliderBackwardsBtn.classList.remove("btn-disabled");
                        
                    }

                    slideTestimonialCards(testimonialCards, direction, currentSlideID);
                }
            });
        });
    }
    

    noOfPaginationBtnsToCreate = browserWidth <= 750 ? totalNoOfSlides : browserWidth <= 1080 ? totalNoOfSlides -1 : browserWidth > 1080 ? totalNoOfSlides - 2 : totalNoOfSlides;
    testimonialPaginationContainer.innerHTML = "";
    createPaginationBtns(); 

    

}