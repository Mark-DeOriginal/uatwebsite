window.addEventListener("load", function() {

    var isFormAvailable = document.querySelector(".book-appointment form");

    if (isFormAvailable) {

        var customSelectElement = document.querySelector(".appointment-type.dropdown-btn");
        var customSelectElementCaret = document.querySelector(".appointment-type.dropdown-btn .toggle-icon");
        var customSelectElementDropdownOptions = document.querySelectorAll(".appointment-type-wrapper .dropdown.list ul li");
        
        var appointmentTypeInput = document.querySelector("input.appointment-type-choice");
        var defaultAppointmentTypeValue = appointmentTypeInput.value.trim();
    
        var customSelectDropDown = document.querySelector(".dropdown.list");
    
        function showSelectOptions() {
            customSelectDropDown = document.querySelector(".dropdown.list");
            if (customSelectDropDown.style.display !== "block") {
                customSelectDropDown.style.display = "block";
                customSelectElementCaret.classList.toggle("rotate");
            } else {
                customSelectDropDown.style.display = "none";
                customSelectElementCaret.classList.remove("rotate");
            }       
            
        }
    
        function hideSelectOptions() {
            customSelectDropDown = document.querySelector(".dropdown.list");
            if (customSelectDropDown.style.display !== "") {
                customSelectDropDown.style.display = "none";
            }
    
            customSelectElementCaret.classList.remove("rotate");
        }
    
        document.onclick = function(event) {
            if (event.target === customSelectElement || customSelectElement.contains(event.target)) {            
                showSelectOptions();
            } else if (event.target === customSelectElementDropdownOptions[1] || event.target === customSelectElementDropdownOptions[2]){
                customSelectElement.querySelector("p.choice").innerText = event.target.innerText;
                appointmentTypeInput.value = event.target.innerText;
                hideSelectOptions();
            } else {
                hideSelectOptions();
            }        
        }
    
        var chooseFileBtn = document.querySelector(".choose-file-btn");
    
        chooseFileBtn.onclick = ()=> {
            
            var fileUploader = document.querySelector(".upload-wrapper .file input.uploader");
            var uploadedFile = document.querySelector(".upload-wrapper .file");
            
            fileUploader.click();
            fileUploader.value = null;
    
            fileUploader.addEventListener("change", ()=> {
                var isFileSelected = fileUploader.files.length > 0 ? true : false;

                if (isFileSelected) {
                    uploadedFile.classList.remove("hidden");            
                    chooseFileBtn.style.display = "none";
                } else {
                    uploadedFile.classList.add("hidden");
                    chooseFileBtn.style.display = "block";
                }
                
            });
    
            var deleteFileIcon = document.querySelector(".upload-wrapper .delete-file-icon");
            deleteFileIcon.onclick = ()=> {
                uploadedFile.classList.add("hidden");
                chooseFileBtn.style.display = "block";            
            }
            
        }
    
        var bookAppointmentBtn = document.querySelector(".book-appointment .book-appointment-btn");
    
        bookAppointmentBtn.onclick = (event)=> {
            validateInputs(event);
        }
        
        function validateInputs(event) {
            var fullName = document.querySelector(".book-appointment form #full-name").value;
            var email = document.querySelector(".book-appointment form #email").value;
            var phone = document.querySelector(".book-appointment form #phone").value;
        
            var relevantDoc = document.querySelector(".book-appointment form input[type='file'].relevant-doc");
            var paymentDoc = document.querySelector(".book-appointment form input[type='file'].payment-receipt")
            
            function isValidFile (file, typeOrSize) {
                
                var validFormats = [
                    "image/png", 
                    "image/jpeg", 
                    "application/pdf", 
                    "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                ];
                var maxSize = 5 * 1024 * 1024;
    
                if (file.files.length > 0) {
                    if (typeOrSize === "type") {
                        if (!validFormats.includes(file.files[0].type)) {
                            return false;
                        }
                    }
        
                    else if (typeOrSize === "size") {
                        if (file.files[0].size > maxSize) {
                            return false;
                        }
                    }
                }
                
            }
    
            var isValidFileType = isValidFile(relevantDoc, "type") == false ? false
                                : isValidFile(paymentDoc, "type") == false ? false
                                : true;
    
            var isValidFileSize = isValidFile(relevantDoc, "size") == false ? false
                                : isValidFile(paymentDoc, "size") == false ? false
                                : true;
    
    
            var isInputEmpty = fullName.trim() === "" ? true : email.trim() === "" ? true : phone.trim() === "" ? true : false;
            var isAppointmentDateEmpty = document.querySelector(".book-appointment form #appmnt-date").value.trim() === "" ? true : false;
            
            var validationErrorMessage = document.querySelector(".book-appointment .validation-error");
        
            if (isInputEmpty == true) {
                event.preventDefault();
        
                validationErrorMessage.innerHTML 
                = "<p>One or more input fields appear empty. <br>Please, fill out the inputs before submitting.</p>";    
    
            } else if (isAppointmentDateEmpty == true) {
                event.preventDefault();
        
                validationErrorMessage.innerHTML
                = "<p>Please provide a appointment date in the appointment date field.</p>";
    
            } else if (appointmentTypeInput.value.trim() === defaultAppointmentTypeValue) {
                event.preventDefault();
        
                validationErrorMessage.innerHTML
                = "<p>Please choose appointment type.</p>";    
    
            } else if (isValidFileType === false) {
                event.preventDefault();
        
                validationErrorMessage.innerHTML
                = "<p>Please upload only JPEG, PNG, PDF or DOC files.</p>";
    
            } else if (isValidFileSize === false) {
                event.preventDefault();
        
                validationErrorMessage.innerHTML
                = "<p>Please upload files not higher than 5MB.</p>";
                
            } else {
                validationErrorMessage.innerHTML = "";
            }
    
        }

        window.addEventListener("scroll", ()=> {
            //  Remove the form validation error message when user scrolls up towards the empty field
            var validationErrorMessage = document.querySelector(".book-appointment .validation-error");
            
            if (validationErrorMessage.innerText !== "") {
                if (window.scrollY < 600) {
                    validationErrorMessage.innerHTML = "";
                }
            }
        });
    }

    
});