/*
    Chimaobi Testimonial Slider
    Copyright © 2023 - Chimaobi Friday
    Email: davidmarkfriday16@gmail.com
    WhatsApp: +2348072157818
*/

window.addEventListener("load", function() {
    //  Let's handle some issues that may occur when the 
    //  page scrolls, while sliding the testimonial cards
    window.addEventListener("scroll", function() {
        // This is especially useful for touch devices
        // so that the testimonial cards wont slide if
        // user holds down on it and scrolls the page
        function handleDragWhilePageScrolls() {
            if (isTouchStart == true) {
                undoCardsDrag("auto");
                isTouchStart = false;
            }
        }

        handleDragWhilePageScrolls();
    });

    //  These will hold true or false, depending on
    //  whether the user is pressing down on the screen
    var isMouseDown = false;
    var isTouchStart = false;

    //  This will indicate whether there is a 
    //  testimonial available or not
    var isTestimonialAvailable;

    //  Get necessary elements from the testimonial container
    var testimonialWrapper = document.querySelector(".testimonial-wrapper");
    var testimonialContainer = document.querySelector(".testimonial-container");
    var testimonialCards = document.querySelectorAll(".testimonial-container .card");
    var arrowBtns = document.querySelectorAll(".arrow-btn");

    //  Get the width of the Browser Window        
    var browserWidth = window.innerWidth;
    //  Based on the Browser's Window width, return the number of testimonial 
    //  cards that should be shown at once
    var noOfCardsOnFirstSlide = browserWidth <= 750 || testimonialCards.length == 1 ? 1
                                : browserWidth <= 1080 && testimonialCards.length > 1 ? 2 
                                : browserWidth > 1080 && testimonialCards.length == 2 ? 2 
                                : 3; 

    //  This holds the total number of slides in the testimonial slider
    const totalNoOfSlides = testimonialCards.length;

    window.addEventListener("resize", function() {

        noOfCardsOnFirstSlide = browserWidth <= 750 || testimonialCards.length == 1 ? 1
                            : browserWidth <= 1080 && testimonialCards.length > 1 ? 2 
                            : browserWidth > 1080 && testimonialCards.length == 2 ? 2 
                            : 3; 

        if (isTestimonialAvailable == true) {            
                                
            if (testimonialCards.length == noOfCardsOnFirstSlide) {
                arrowBtns.forEach(arrowBtn => {
                    arrowBtn.style.display = "none";
                });

                document.querySelector(".testimonial-pagination").style.display = "none";
            } else {
                if (browserWidth > 750) {
                    arrowBtns.forEach(arrowBtn => {
                        arrowBtn.style.display = "flex";
                    });
                } else {
                    arrowBtns.forEach(arrowBtn => {
                        arrowBtn.style.display = "none";
                    });
                }                

                document.querySelector(".testimonial-pagination").style.display = "flex";
            }


            if (browserWidth > 500) {
                //  Any time user resizes the browser,  
                //  go back to the first slide
                testimonialCards.forEach(card => {
                    card.style.transform = `translateX(${repositionX}px)`;
                });

                cardsTranslateX = 0;

                //  This will be updated with the correct number 
                //  of buttons to be created whenever the browser is resized
                noOfPaginationBtnsToCreate = testimonialCards.length - noOfCardsOnFirstSlide == 0 ? 0 : 1 + (testimonialCards.length - noOfCardsOnFirstSlide);
                
                //  When the browser is resized,
                //  check if the pagination buttons are complete in number
                if (testimonialCards.length > noOfCardsOnFirstSlide && noOfPaginationBtnsToCreate !== 0) {
                    //  Clear the content of the pagination container of any object in it
                    testimonialPaginationContainer.innerHTML = "";
                    //  Call this function to create the pagination buttons
                    createPaginationBtns();

                    //  This is zero by default, to help us 
                    //  select the first pagination button
                    activePaginationBtnID = 0;
                    //  Remove the active class from any pagination 
                    //  buttons that have it
                    paginationButtons.forEach(all => {
                        all.classList.remove("active");
                    });
                    //  Then add it to the pagination button the User clicked 
                    paginationButtons[activePaginationBtnID].classList.add("active"); 
                }
                

                //  If we are in the first slide, disable the 
                //  backwards button if it's not already disabled
                if (sliderBackwardsBtn.classList.contains("btn-disabled") == false) {
                    sliderBackwardsBtn.classList.add("btn-disabled");            
                }
                //  Enable the forward button if its disabled
                if (sliderForwardBtn.classList.contains("btn-disabled") == true) {
                    sliderForwardBtn.classList.remove("btn-disabled");
                    
                }    
            }
        }

    });

    //  Before we continue, let's make sure the testimonial container
    //  has at least one testimonial card in it
    if (testimonialCards.length > 0) {        
        
        isTestimonialAvailable = true;

        var sliderForwardBtn = document.querySelector(".arrow-right");
        var sliderBackwardsBtn = document.querySelector(".arrow-left");
        var testimonialPaginationContainer = document.querySelector(".testimonial-pagination");

        
        //  This holds how many cards we wish to slide by
        var defaultCardToSlide = 1;
        //  When need be, we can change this variable's value
        var cardsToSlide = defaultCardToSlide;
        
        //  This returns the number of slides remaining
        var slidesRemaining = totalNoOfSlides - noOfCardsOnFirstSlide;

        //  Let's define some useful variables for the pagination
        var paginationButtons;
        var noOfPaginationBtnsToCreate;
        var activePaginationBtnID = 0;
        var previousSlideID = 0;
        var currentSlideID;
        
        //  This holds the updated translateX of the testimonial cards
        var cardsTranslateX = 0;
        //  The value of this variable will help take us
        //  back to the beginning of our slide 
        var repositionX = 0;

        //  Let's define some more useful variables
        var dragStartPosX,
            dragDistance;
        var currentDragPosX;

        //  We will insert a value here to help us confirm if the 
        //  drag is happening inside the testimonial container
        var isDragInsideTestimonialContainer;

        //  We will keep the testimonial cards position here.
        //  It will be added with the drag distance to take the testimonial
        //  cards to the current drag position
        var testimonialCardsPrevPosX;

        //  Just as their names imply, we will use them to check if
        //  we can drag the cards to the current drag position, and to update
        //  the slides remaining
        var canDrag = false;
        var wasDragged = false;

        //  When the testimonial slider forward button is clicked,
        sliderForwardBtn.addEventListener("click", ()=> {                
            //  Be sure the button is not disabled, before proceeding
            if (sliderForwardBtn.classList.contains("btn-disabled") == false) {
                //  Run this function with the necessary arguments
                //  to slide the testimonial cards
                wasDragged = true;
                slideTestimonialCards (testimonialCards, "left", "auto");
            }        
                
        });

        //  Do same when the testimonial slider backwards button is clicked
        sliderBackwardsBtn.addEventListener("click", ()=> {
            if (sliderBackwardsBtn.classList.contains("btn-disabled") == false) {
                wasDragged = true;
                slideTestimonialCards (testimonialCards, "right", "auto");
            }
        });

        //  We will call this function to slide the testimonial cards
        //  Where the parameter: 
        //  Cards = an array of the testimonial cards
        //  slidingDirection = the direction we want to slide to
        //  slideTo = the slide we want to slide to
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

            //  If the parameter, slideTo returns "auto",
            if (slideTo == "auto") {
                //  Slide the testimonial cards using total obtained from this formula:
                //  Sliding distance = ((cardsOffsetWidth * noOfCardsOnFirstSlide) + ((cardsMargin * 2) * noOfCardsOnFirstSlide)) * direction
                //  Or we can also slide the cards using the testimonial container offsetWidth and multiply it by the direction variable value, which is either -1 or 1, to make it slide left or right
                cardsTranslateX += ((cardsOffsetWidth * cardsToSlide) + ((Number(cardsMargin.split(/[a-zA-Z]+/)[0]) * 2) * cardsToSlide)) * direction;
            //  Else, slide the cards by the slideTo value, which is the 
            //  number of the card to slide to
            } else {
                cardsTranslateX = ((cardsOffsetWidth * slideTo) + ((Number(cardsMargin.split(/[a-zA-Z]+/)[0]) * 2) * slideTo)) * -1;
            }

            // Testing some values using the console
            // console.log(('20.3px').split(/[a-zA-Z]+/)[0]);

            //  Update the browserWidth variable
            browserWidth = window.innerWidth;

            //  Return a duration for our transition based on the browserWidth
            var animationTransition = browserWidth < 1080 ? "0.5s ease" : "0.6s ease";
            
            //  Slide the testimonial cards
            cards.forEach(card => {
                card.style.transition = animationTransition;
                card.style.transform = `translateX(${cardsTranslateX}px)`;
            });

            //  If the User slides right
            if (slidingDirection == "right") {
                //  If the sliding was done through dragging the testimonial
                //  cards or pressing the forward or backwards button            
                if (wasDragged == true) {
                    //  Decrement these variables by 1
                    activePaginationBtnID -= 1;
                    slidesRemaining += 1;

                //  Otherwise, then it was done using the pagination buttons
                } else {
                    //  If the ID of the pagination button pressed is 0 
                    if (activePaginationBtnID == 0) {
                        //  That means we've slide to the beginning
                        //  So update this variable accordingly
                        slidesRemaining =  totalNoOfSlides - noOfCardsOnFirstSlide;
                    //  If the ID is other than 0,
                    } else {
                        //  Then minus the pagination button ID from the slides 
                        //  remaining, to help us know how many slides are remaining
                        slidesRemaining = (totalNoOfSlides - noOfCardsOnFirstSlide) - activePaginationBtnID;
                    }
                    
                }

                //  Remove the active class from any pagination 
                //  buttons that have it
                paginationButtons.forEach(all => {
                    all.classList.remove("active");
                });

                //  Then add it to the pagination button the User clicked 
                paginationButtons[activePaginationBtnID].classList.add("active");

                if (paginationButtons[0].classList.contains("active") == true) {
                    if (sliderBackwardsBtn.classList.contains("btn-disabled") == false) {
                        sliderBackwardsBtn.classList.add("btn-disabled");
                        
                    }
                    if (sliderForwardBtn.classList.contains("btn-disabled") == true) {
                        sliderForwardBtn.classList.remove("btn-disabled");
                        
                    }
                } else if (paginationButtons[paginationButtons.length - 1].classList.contains("active") == true) {
                    if (sliderBackwardsBtn.classList.contains("btn-disabled") == true) {
                        sliderBackwardsBtn.classList.remove("btn-disabled");
                        
                    }
                    if (sliderForwardBtn.classList.contains("btn-disabled") == false) {
                        sliderForwardBtn.classList.add("btn-disabled");
                        
                    }
                } else {
                    if (sliderBackwardsBtn.classList.contains("btn-disabled") == true) {
                        sliderBackwardsBtn.classList.remove("btn-disabled");
                        
                    }
                    if (sliderForwardBtn.classList.contains("btn-disabled") == true) {
                        sliderForwardBtn.classList.remove("btn-disabled");
                        
                    }
                }
            }

            //  If the user slides left
            if (slidingDirection == "left") {
                //  Verify that the dragging was done through dragging on the cards
                //  or pressing the forward/backwards button
                if (wasDragged == true) {
                    //  Then increment these variables by 1
                    activePaginationBtnID += 1;
                    slidesRemaining -= 1;

                //  Else, then it was done using the pagination button
                } else { 
                    //  So minus the pagination button ID, which holds the current 
                    // slide number from the remaining slides
                    slidesRemaining = (totalNoOfSlides - noOfCardsOnFirstSlide) - activePaginationBtnID;   
                }
                
                //  Remove the active class from all pagination buttons 
                paginationButtons.forEach(all => {
                    all.classList.remove("active");
                });
                //  Then add it to the currently active pagination button
                paginationButtons[activePaginationBtnID].classList.add("active");

                

                if (paginationButtons[0].classList.contains("active") == true) {
                    if (sliderBackwardsBtn.classList.contains("btn-disabled") == false) {
                        sliderBackwardsBtn.classList.add("btn-disabled");
                        
                    }
                    if (sliderForwardBtn.classList.contains("btn-disabled") == true) {
                        sliderForwardBtn.classList.remove("btn-disabled");
                        
                    }
                } else if (paginationButtons[paginationButtons.length - 1].classList.contains("active") == true) {
                    if (sliderBackwardsBtn.classList.contains("btn-disabled") == true) {
                        sliderBackwardsBtn.classList.remove("btn-disabled");
                        
                    }
                    if (sliderForwardBtn.classList.contains("btn-disabled") == false) {
                        sliderForwardBtn.classList.add("btn-disabled");
                        
                    }
                } else {
                    if (sliderBackwardsBtn.classList.contains("btn-disabled") == true) {
                        sliderBackwardsBtn.classList.remove("btn-disabled");
                        
                    }
                    if (sliderForwardBtn.classList.contains("btn-disabled") == true) {
                        sliderForwardBtn.classList.remove("btn-disabled");
                        
                    }
                }
            }

            //  Set these variables appropriately
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


        //  Call this function when the user presses or  
        //  touches the testimonial cards
        function registerDragStartPosX(event) {

            //  If it's a mousedown event, then it was done using a PC
            if (event.type === "mousedown") {
                isMouseDown = true;
                //  Set the drag start position
                dragStartPosX = event.clientX;
            }

            //  If it's a touchstart event, it was done with a touch enabled device
            if (event.type === "touchstart") {
                isTouchStart = true;
                dragStartPosX = event.touches[0].clientX;
                console.log("Touch start is " + dragStartPosX + "px from the left of the screen");
            }

            //  Didn't like the outcome, so let me comment it out
            //  = event.target.tagName.toLowerCase() === 'img' || event.target.nodeName.toLowerCase() === 'img';
            
            //  Let's return true if the drag was done 
            //  inside the testimonial container
            isDragInsideTestimonialContainer = testimonialContainer.contains(event.target); // Will return true or false
        }

        //  We will call this to calculate the drag distance
        function calculateDragDistance(event) {
            if (isMouseDown == true) {
                currentDragPosX = event.clientX;
                //  The drag distance is given by: currentDragPosX - dragStartPosX
                dragDistance = currentDragPosX - dragStartPosX;
            }

            if (isTouchStart == true) {
                currentDragPosX = event.touches[0].clientX;
                dragDistance = currentDragPosX - dragStartPosX;
            }
        }

        //  We will call this function on mouse move or touch move
        //  to enable us drag the cards accordingly 
        function dragTestimonialCards(event) {

            //  Since touch screen devices depend on  
            //  sliding the screen to scroll, let's not 
            //  use preventDefault() on touch screen devices
            var isTouchScreen = event.type === "touchmove";
            if (isTouchScreen == false) {
                event.preventDefault();
            }

            //  Verify that the user is actually pressing or touching the screen
            if (isMouseDown == true || isTouchStart == true) {
                //  Before we perform the drag operation, let's be sure the 
                //  drag is happening within the testimonial container
                if (isDragInsideTestimonialContainer == true) {
                    //  Call this function to calculate the drag distance
                    calculateDragDistance(event);

                    //  If the current drag position is greater than the 
                    //  drag start position, then User is sliding right
                    if (currentDragPosX > dragStartPosX) {
                        //  Drag the cards if the backwards button is not disabled
                        if (sliderBackwardsBtn.classList.contains("btn-disabled") == false && testimonialCards.length >  noOfCardsOnFirstSlide && paginationButtons[0].classList.contains("active") == false) {
                            dragCards("no-resistance");
                            canDrag = true;
                        
                        //  But if the backwards button is disabled, it means we are already
                        //  in the beginning, so User doesn't have to slide that way
                        } else {                        
                            canDrag = false;
                            //  Drag the cards, but with resistance, 
                            //  and then snap then back to their original position
                            dragCards("10-percent-resistance");
                        }
                    
                    //  But if the drag start position is greater than the 
                    //  current drag position, the User is sliding left
                    } else if (dragStartPosX > currentDragPosX) {
                        //  If the forward button is not disabled, drag the cards
                        if (sliderForwardBtn.classList.contains("btn-disabled") == false && testimonialCards.length >  noOfCardsOnFirstSlide && paginationButtons[paginationButtons.length -1].classList.contains("active") == false) {
                            dragCards("no-resistance");
                            canDrag = true;
                        
                        //  If it's disabled, snap the cards back to 
                        //  their original position
                        } else {                        
                            canDrag = false;
                            dragCards("10-percent-resistance"); // We will snap back to undo this drag, since the user isn't supposed to drag at this point
                        }
                    }
                }
            }       

        }

        //  Call this function to drag the cards
        function dragCards(resistance) {
            //  This returns the drag resistance, which we get by dividing by the drag distance to reduce the drag effort
            var dragResistance = resistance == "no-resistance" ? "1" : resistance == "10-percent-resistance" ? "10" : "1";
            
            //  Update this variable
            testimonialCardsPrevPosX = cardsTranslateX;

            //  Slide the cards using our defined formula
            testimonialCards.forEach(card => {
                card.style.transform = `translateX(${testimonialCardsPrevPosX + (dragDistance / parseInt(dragResistance))}px)`;
                
            });

            //  Set this variable to true, to indicate that we've dragged the cards
            wasDragged = true;

        }

        //  When the User stops dragging and releases the mouse or lifts hand
        //  off the screen, call this function to perform drag end operations
        function registerDragEndPosX(event) {
            //  Let's be sure it's not a touch enabled device, before
            //  proceeding with preventDefault()
            if (event.type !== "touchend") {
                event.preventDefault();
            }
            
            //  Be sure the mouse was pressed or that the screen 
            //  was touched, before proceeding
            if (isMouseDown == true || isTouchStart == true) {
                //  Check if the conditions to drag has been met before continuing
                if (canDrag == true) {
                    if (event.type === "mouseup") {
                        isMouseDown = false;
                    }
        
                    if (event.type === "touchend") {
                        isTouchStart = false;
                    }
                    
                    //  Calculate the drag distance
                    dragDistance = currentDragPosX - dragStartPosX;
                    
                    //  Let's check if the cards were actually dragged, 
                    //  before proceeding
                    if (wasDragged == true) {
                        //  Return an absolute (positive) value of the drag distance
                        //  and check if it's greater than 30. This will help us 
                        //  know that the User really intended dragging the cards
                        if (Math.abs(dragDistance) > 30) {
                            //  If yes, check the sliding direction using 
                            //  this method and then slide the cards accordingly
                            if (currentDragPosX > dragStartPosX) {
                                slideTestimonialCards (testimonialCards, "right", "auto");
                            }
                            else if (dragStartPosX > currentDragPosX) {
                                slideTestimonialCards (testimonialCards, "left", "auto");
                            }
                        
                        //  Else, then the User most probably didn't intend to 
                        //  drag the cards, so undo the drag
                        } else {
                            undoCardsDrag("auto");
                        }
                    }
        
                //  If the conditions to drag the cards were not met
                } else {
                        
                    undoCardsDrag("auto");                  

                    //  Then reset these variables
                    isMouseDown = false;
                    isTouchStart = false;
                }
            }
            
        }

        //  Call this function whenever the User leaves the 
        //  testimonial container while dragging
        function handleDragLeave() {
            if (isMouseDown == true || isTouchStart == true) {
                //  Do the same things we did in registerDragEnd() function here
                if (canDrag == true) {
                    isMouseDown = false;
                    isTouchStart = false;
        
                    dragDistance = currentDragPosX - dragStartPosX;
                    console.log("The drag distance is " + dragDistance + "px");

                    if (Math.abs(dragDistance) > 15) {    
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
                        
                    undoCardsDrag("auto");
        
                    isMouseDown = false;
                    isTouchStart = false;
                }
            }
        }

        //  We will call this function to undo cards drag
        function undoCardsDrag(toRightEndOrLeftEnd) {
            var snapBack = toRightEndOrLeftEnd == "left-end" ? 0 : toRightEndOrLeftEnd == "right-end" || "auto" ? cardsTranslateX : 0;
            testimonialCards.forEach(card => {
                //  Update the browserWidth variable
                browserWidth = window.innerWidth;        
                //  Return a duration for our transition based on the browser width
                var animationTransition = browserWidth < 1080 ? "0.5s ease" : "0.6s ease";
            
                //  Slide the testimonial cards
                card.style.transition = animationTransition;
                card.style.transform = `translateX(${snapBack}px)`;
            });
            wasDragged = false;
        }

        //  Call this function to create our testimonial pagination buttons
        function createPaginationBtns() {
            
            //  Using this for() loop, create the correct number of cards
            //  in proportion with the number of slides available
            for (i = 0; i < noOfPaginationBtnsToCreate; i++) {
                testimonialPaginationContainer.innerHTML += `
                <div class="pagination-btn" data-slide-id="${i}"></div>
                `;
            }
            
            //  After creating the pagination buttons, get the buttons
            paginationButtons = document.querySelectorAll(".testimonial-pagination .pagination-btn");
            //  Add an active class to the first button
            paginationButtons[0].classList.add("active");
            
            //  Add an event listener to all the buttons using .forEach() method
            paginationButtons.forEach(paginationButton => {
                paginationButton.addEventListener('click', ()=> {
                    //  We won't proceed if the button clicked is already active
                    if (paginationButton.classList.contains("active") == false) {
                        
                        //  Set this variable to the value of the data-set
                        //  attribute of the pagination button
                        currentSlideID = Number(paginationButton.dataset.slideId);
                        
                        //  Get the direction by checking if the ID of the 
                        //  button clicked is greater or less than that of 
                        //  the previously active button
                        var direction = currentSlideID > previousSlideID ? "left" : "right"; 

                        //  Update the value of this variable 
                        previousSlideID = currentSlideID;

                        //  Remove the active class of the previously 
                        //  active pagination button
                        paginationButtons[activePaginationBtnID].classList.remove("active");
                    
                        //  Update this variable to the newly active pagination button
                        activePaginationBtnID = Number(paginationButton.dataset.slideId);
                    
                        //  Then add an active class to it
                        paginationButtons[activePaginationBtnID].classList.add("active");
                    
                        //  If the forward button is disabled, enable it
                        if (sliderForwardBtn.classList.contains("btn-disabled") == true) {
                            sliderForwardBtn.classList.remove("btn-disabled");
                            
                        }

                        //  Enable the backwards button if it's disabled
                        if (sliderBackwardsBtn.classList.contains("btn-disabled") == true) {
                            sliderBackwardsBtn.classList.remove("btn-disabled");
                            
                        }

                        //  Then slide the testimonial cards
                        slideTestimonialCards(testimonialCards, direction, currentSlideID);
                        
                        //  Note: I carefully arranged each line, based on the flow of the logic.
                        //  If a line should go above another line, it may cause unexpected results
                    }
                });
            });            
            
        }
        
        
        

        //  This will be updated with the correct number 
        //  of buttons to be created whenever the browser is resized
        noOfPaginationBtnsToCreate = testimonialCards.length - noOfCardsOnFirstSlide == 0 ? 0 : 1 + (testimonialCards.length - noOfCardsOnFirstSlide);
        
        //  When the browser is resized,
        //  check if the pagination buttons are complete in number
        if (testimonialCards.length > noOfCardsOnFirstSlide && noOfPaginationBtnsToCreate !== 0) {
            //  Clear the content of the pagination container of any object in it
            testimonialPaginationContainer.innerHTML = "";
            //  Call this function to create the pagination buttons
            createPaginationBtns();

            //  This is zero by default, to help us 
            //  select the first pagination button
            activePaginationBtnID = 0;
            //  Remove the active class from any pagination 
            //  buttons that have it
            paginationButtons.forEach(all => {
                all.classList.remove("active");
            });
            //  Then add it to the pagination button the User clicked 
            paginationButtons[activePaginationBtnID].classList.add("active"); 
        }

        if (testimonialCards.length == noOfCardsOnFirstSlide) {
            arrowBtns.forEach(arrowBtn => {
                arrowBtn.style.display = "none";
            });

            document.querySelector(".testimonial-pagination").style.display = "none";
        }
    }

    //  If there are no testimonial cards in the testimonial container,
    if (testimonialCards.length == 0) {        
        isTestimonialAvailable = false;

        //  Then show this in the testimonial container
        testimonialContainer.innerHTML = `
            <p class='no-testimonials-text'>There are no testimonials to view</p>
        `;
        //  And hide the forward and backwards button
        //  by adding this class to the testimonial wrapper
        testimonialWrapper.classList.add("no-testimonials");
        //  Remove the slider class from the testimonial container 
        //  to remove the styles that are no longer necessary
        testimonialContainer.classList.remove("slider");
    }
});