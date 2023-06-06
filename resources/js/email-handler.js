window.addEventListener("load", function() {
    var subscriptionForm = document.getElementById("subscription-form");
    var sendEmailBtn = document.querySelector(".send-email-btn");
    var loader = document.querySelector(".loader");
    var formData;

    subscriptionForm.onsubmit = function(event) {
        event.preventDefault();        
        
        sendEmailBtn = document.querySelector(".send-email-btn");

        if (sendEmailBtn.classList.contains("disabled") == false) {
            subscriptionForm = document.getElementById("subscription-form");
            formData = new FormData(subscriptionForm);

            sendConfirmationEmail(formData);
        }
        
    }

    loader.addEventListener("transitionend", ()=> {
        if (loader.classList.contains("show-loader")) {
            sendEmailBtn.value = "Please wait";
            sendEmailBtn.classList.add("disabled");
        } else {
            sendEmailBtn.value = "Subscribe";
            sendEmailBtn.classList.remove("disabled");
        }      
    });

    function sendConfirmationEmail(data) {

        loader.classList.add("show-loader");

        function hideLoader() {
            loader.classList.remove("show-loader");
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "send-confirmation-email.php", true);
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status == 200) {

                var response = xhr.responseText;

                var modalHeading;
                var modalMessage;
                var buttonText = "Okay";
                
                if (response === "Sent") {
                    modalHeading = "Confirm Subscription";
                    modalMessage = "A confirmation link has been sent to your email. Please click on it to confirm your subscription.";
                    
                    hideLoader();
                    showModal(modalHeading, modalMessage, buttonText);
                    
                } else if (response === "Resent") {
                    modalHeading = "Confirm Subscription";
                    modalMessage = "A confirmation link has been resent to your email. Click on it to confirm your subscription.";

                    hideLoader();
                    showModal(modalHeading, modalMessage, buttonText);
                    
                } else if (response === "Confirmed") {
                    modalHeading = "Already Subscribed";
                    modalMessage = "The email address you provided has already been added to our subscription list and has been confirmed.";

                    hideLoader();
                    showModal(modalHeading, modalMessage, buttonText);

                } else if (response === "Not Confirmed") {
                    modalHeading = "Confirm Subscription";
                    modalMessage = "We sent a confirmation code to you previously. Do you want us to resend it?";
                    buttonText = "Yes, resend";

                    hideLoader();
                    showModal(modalHeading, modalMessage, buttonText);

                } else {

                    modalHeading = "Oops!";
                    modalMessage = response;
                    
                    hideLoader();
                    showModal(modalHeading, modalMessage, buttonText);
                }
            }
        }
        
        xhr.send(data);       
        
    }

    function showModal(headingText, message, buttonText) {
        var subscriptionModalContainer = document.querySelector(".modal-container");
        var subscriptionModal = document.querySelector(".subscription-status-modal");
        var modalBtnContainer = document.querySelector(".btn-container");

        var modalHeading = document.querySelector(".modal .heading");
        var modalMessage = document.querySelector(".modal .message");

        modalHeading.innerText = headingText;
        modalMessage.innerText = message;

        subscriptionModalContainer.style.display = "flex"; 
        
        if (buttonText === "Yes, resend") {
            modalBtnContainer.innerHTML = 
            ` <button type="button" class="resend-btn button">${buttonText}</button>
                <button type="button" class="modal-close-btn button">Close</button>`;
            
            var resendBtn = document.querySelector(".modal .resend-btn");

            resendBtn.addEventListener("click", function() {
                subscriptionForm = document.getElementById("subscription-form");
                formData = new FormData(subscriptionForm);
                formData.append("resend-confirmation", true);

                sendConfirmationEmail(formData);
            });
        } else {
            modalBtnContainer.innerHTML = 
            ` <button type="button" class="modal-close-btn button">Okay</button>`;  
        }

        if (subscriptionModal.classList.contains("show-modal") == false) {
            subscriptionModal.classList.add("show-modal");
        }

        var modalCloseBtns = document.querySelectorAll(".modal .button");

        modalCloseBtns.forEach(btn => {
            btn.addEventListener("click", function(){
                subscriptionModal.classList.remove("show-modal");
                subscriptionModal.classList.add("hide-modal");
            });
        });        
        
        subscriptionModalContainer.addEventListener("click", function(evt) {
            if (evt.target === subscriptionModalContainer) {
                subscriptionModal.classList.remove("show-modal");
                subscriptionModal.classList.add("hide-modal");  
            } 
        });

        function handleModalClosed() {
            if (subscriptionModal.classList.contains("hide-modal")) {
                subscriptionModal.classList.remove("hide-modal");
                subscriptionModalContainer.style.display = "none"; 
            }
        }

        subscriptionModal.addEventListener("animationend", handleModalClosed);
    }
});

    

