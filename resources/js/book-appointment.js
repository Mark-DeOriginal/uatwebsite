window.addEventListener("load", function() {
    var customSelectElement = document.querySelector(".consultation-type.dropdown-btn");
    var customSelectElementCaret = document.querySelector(".toggle-icon");
    var customSelectElementDropdownOptions = document.querySelectorAll(".consultation-type-wrapper .dropdown.list ul li");
    
    var selectElement = document.querySelector("input.consultation-type-choice");

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
            selectElement.value = event.target.innerText;
            hideSelectOptions();
        } else {
            hideSelectOptions();
        }        
    }

    var chooseFileBtn = document.querySelector(".choose-file-btn");
    
    var uploadWrapper = document.querySelector(".upload-wrapper .files-wrapper");

    chooseFileBtn.onclick = ()=> {
        uploadWrapper.innerHTML = `
        <div class="file hidden">
            <div class="file-name">
                <input type="file" name="file-upload" class="uploader" multiple>
            </div>                                
            <i class="delete-file-icon">&times;</i>
        </div>
        `;
        
        var fileUploader = document.querySelector(".upload-wrapper .file input.uploader");
        var uploadedFile = document.querySelector(".upload-wrapper .file");
        
        fileUploader.click();

        fileUploader.addEventListener("change", (event)=> {
            var isFileSelected = event.target.files[0];
            if (isFileSelected) {
                uploadedFile.classList.remove("hidden");            
                chooseFileBtn.style.display = "none";
            } else {
                uploadedFile.remove();
                chooseFileBtn.style.display = "block";
            }
            
        });

        var deleteFileIcon = document.querySelector(".upload-wrapper .delete-file-icon");
        deleteFileIcon.onclick = ()=> {
            deleteFileIcon.parentElement.remove();
            chooseFileBtn.style.display = "block";            
        }
        
    }

    
});