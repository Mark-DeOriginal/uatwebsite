window.addEventListener("load", function() {

    var subscriptionForm = document.getElementById("subscription-form");
    var sendEmailBtn = document.querySelector(".send-email-btn");
    var modalContainer = document.querySelector(".modal-container");
    var spinningLoader = document.querySelector(".loading-indicator .loader");
    var loadingText = document.querySelector(".loading-indicator p");
    var formData;

    subscriptionForm.onsubmit = function(event) {
        event.preventDefault();        
        
        sendEmailBtn = document.querySelector(".send-email-btn");

        if (sendEmailBtn.classList.contains("disabled") == false) {
            subscriptionForm = document.getElementById("subscription-form");
            formData = new FormData(subscriptionForm);

            modalContainer.style.display = "block";
            spinningLoader.style.display = "block";
            loadingText.style.display = "block";

            sendConfirmationEmail(formData);
        }
        
    }

    function sendConfirmationEmail(data) {       

        var modalHeading;
        var modalMessage;
        var buttonText = "Okay";

        var response = "";

        var isNetworkAvailable = "";

        async function hasInternetAccess () {
            try {
                var response = await fetch("resources/images/testimonials/janet.jpeg");

                if (response.ok) {
                    return true;
                } else {
                    return false;
                }
            } catch (error) {
                return false;
            }
        }

        hasInternetAccess()
            .then(available => {
                if (available) {
                    isNetworkAvailable = true;
                } else {
                    isNetworkAvailable = false;
                }

            if (isNetworkAvailable == true) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "send-confirmation-email.php", true);

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                            
                        response = xhr.responseText;                    
                        
                        if (response === "Sent") {
                            modalHeading = "Confirm Subscription";
                            modalMessage = "A confirmation link has been sent to your email. Please click on it to confirm your subscription.";
                            
                            clearTimeout(pleaseWaitResponse);

                            showModal(modalHeading, modalMessage, buttonText);
                            
                        } else if (response === "Resent") {
                            modalHeading = "Confirm Subscription";
                            modalMessage = "A confirmation link has been resent to your email. Click on it to confirm your subscription.";

                            clearTimeout(pleaseWaitResponse);

                            showModal(modalHeading, modalMessage, buttonText);
                            
                        } else if (response === "Confirmed") {
                            modalHeading = "Already Subscribed";
                            modalMessage = "The email address you provided has already been added to our subscription list and has been confirmed.";

                            clearTimeout(pleaseWaitResponse);

                            showModal(modalHeading, modalMessage, buttonText);

                        } else if (response === "Not Confirmed") {
                            modalHeading = "Confirm Subscription";
                            modalMessage = "We sent a confirmation code to you previously. </br>Would you like us to resend it?";
                            buttonText = "Yes, resend";

                            clearTimeout(pleaseWaitResponse);
                            
                            showModal(modalHeading, modalMessage, buttonText);

                        } else if (response === "Network Error") {

                            modalHeading = "Network Error";
                            modalMessage = "Your request could not be completed. </br>Please check your internet connection and try again.";
                            
                            clearTimeout(pleaseWaitResponse);
                            
                            showModal(modalHeading, modalMessage, buttonText); 

                        } else {

                            modalHeading = "Oops!";
                            modalMessage = response;
                            
                            clearTimeout(pleaseWaitResponse);

                            showModal(modalHeading, modalMessage, buttonText);
                        }              
                    }
                }                

                xhr.send(data);

                var pleaseWaitResponse = setTimeout(() => {
                    if (response.trim() === '') {
                        modalHeading = "Processing Request";
                        modalMessage = "Your request is being processed. </br>Please hold on a little.";
                        
                        showModal(modalHeading, modalMessage, buttonText);
                    }
                }, 4000);

            } else {
                modalHeading = "Network Error";
                modalMessage = "Your request could not be completed. </br>Please check your internet connection and try again.";
                
                clearTimeout(pleaseWaitResponse);
                
                showModal(modalHeading, modalMessage, buttonText);            
            }       
        });
    }

    var subscriptionModalContainer = document.querySelector(".modal-container");
    var subscriptionModal = document.querySelector(".subscription-status-modal");
    
    function showModal(headingText, message, buttonText) {
        var modalBtnContainer = document.querySelector(".btn-container");

        var modalHeading = document.querySelector(".modal .heading");
        var modalMessage = document.querySelector(".modal .message");

        modalHeading.innerHTML = headingText;
        modalMessage.innerHTML = message;

        function hideLoader() {
            spinningLoader.style.animation = "hide-spinning-loader 0.3s ease forwards";
            loadingText.style.animation = "hide-loading-text 0.3s ease forwards";
            setTimeout(() => {
                spinningLoader.style.display = "none";
                spinningLoader.style.animation = "";

                loadingText.style.display = "none";
                loadingText.style.animation = "";
            }, 300);            
        }
        
        setTimeout(() => {
            hideLoader();
            
            subscriptionModalContainer.style.display = "block";
            subscriptionModal.style.display = "block";
        }, 1000);
        
        if (buttonText === "Yes, resend") {
            modalBtnContainer.innerHTML = 
            ` <button type="button" class="resend-btn button">${buttonText}</button>
              <button type="button" class="modal-close-btn button">Close</button>`;
            
            var resendBtn = document.querySelector(".modal .resend-btn");

            resendBtn.addEventListener("click", function() {
                subscriptionForm = document.getElementById("subscription-form");
                formData = new FormData(subscriptionForm);
                formData.append("resend-confirmation", true);

                subscriptionModal.style.animation = "hide-modal 0.3s ease forwards";
                setTimeout(()=>{
                    subscriptionModal.style.display = "";
                    subscriptionModal.style.animation = "";                    
                }, 300);

                spinningLoader.style.display = "block";
                loadingText.style.display = "block";

                sendConfirmationEmail(formData);
            });

        } else {
            modalBtnContainer.innerHTML = 
            ` <button type="button" class="modal-close-btn button">Okay</button>`;  
        }

        var modalCloseBtn = document.querySelector(".modal-close-btn");

        modalCloseBtn.addEventListener("click", function(){
            closeModal();
        });

    }

    subscriptionModalContainer.addEventListener("click", function(evt) {
        if (evt.target === subscriptionModalContainer) {
            closeModal();
        } 
    });

    function closeModal() {
        subscriptionModal.style.animation = "hide-modal 0.3s ease forwards";
        setTimeout(()=>{
            subscriptionModal.style.display = "none";
            subscriptionModal.style.animation = "";

            subscriptionModalContainer.style.animation = "hide-modal-container 0.3s ease forwards";
            setTimeout(()=>{
                subscriptionModalContainer.style.display = "none";
                subscriptionModalContainer.style.animation = "";
            }, 300);
            
        }, 300);
    }
});

    

