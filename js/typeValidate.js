let submitBtn = document.getElementById('submit_Btn');

let typeInput = document.getElementById('type');
let descInput = document.getElementById('description');

let typeError = document.getElementById('type_error');
let descError = document.getElementById('description_error');

const TYPE_REGEX = /^[a-z]*$/;
const DESC_REGEX = /^[0-9a-zA-Z-',."" ]*$/;

submitBtn.addEventListener('click', onSubmitForm);

let errorExists = false;

function showError(errorField, errorMessage) {
    errorExists = true;
    errorField.innerHTML = errorMessage;
}

function regexValid(regex, str) {
    return regex.test(str)
}

function resetValues() {
    
    errorExists = false;
    typeError.innerHTML = "";
    descError.innerHTML = "";
}

function onSubmitForm(evt) {

    resetValues();

        /* Validate Type */
        if(typeInput.value === "") {
            showError(typeError, "The Category field is required");
        }
        else if(!regexValid(TYPE_REGEX, typeInput.value)) {
            showError(typeError, "Only lowercase letters and no spaces");
        }

        /* Validate Type */
        if(descInput.value === "") {
            showError(descError, "The description field is required");
        }
        else if(!regexValid(DESC_REGEX, descInput.value)) {
            showError(descError, "Only letters. numbers and spaces");
        }

        if(errorExists) {
            evt.preventDefault();
        }
    
}