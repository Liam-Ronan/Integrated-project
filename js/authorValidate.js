let submitBtn = document.getElementById('submit_Btn');
let firstNameInput = document.getElementById('firstName');
let lastNameInput = document.getElementById('lastName');
let linkInput = document.getElementById('link');
let bioInput = document.getElementById('bio');

/* get error divs by ID */
let firstNameError = document.getElementById('first_name_error');
let lastNameError = document.getElementById('last_name_error');
let linkError = document.getElementById('link_error');
let bioError = document.getElementById('bio_error');

/* REGEX PATTERNS */
const NAME_REGEX = /^[a-zA-Z ]*$/;
const BIO_REGEX = /^[0-9a-zA-Z-',.""-' ]*$/;
const WEBSITE_REGEX = /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/;


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
    firstNameError.innerHTML = "";
    lastNameError.innerHTML = "";
    linkError.innerHTML = "";
    bioError.innerHTML = "";
}

function onSubmitForm(evt) {

    resetValues();

    /* Validate First Name */
    if(firstNameInput.value === "") {
        showError(firstNameError, "The first name field is required");
    }
    else if(!regexValid(NAME_REGEX, firstNameInput.value)) {
        showError(firstNameError, "Only letters & spaces allowed");
    }

    /* Validate Last Name */
    if(lastNameInput.value === "") {
            showError(lastNameError, "The last name field is required");
    }
    else if(!regexValid(NAME_REGEX, lastNameInput.value)) {
            showError(lastNameError, "Only letters & spaces allowed");
    }

    /* Validate Link */
    if(linkInput.value === "") {
        showError(linkError, "The link field is required");
    }
    else if(!regexValid(WEBSITE_REGEX, linkInput.value)) {
        showError(linkError, "invalid must be www.example.com");
    }

    /* Validate Link */
    if(bioInput.value === "") {
            showError(bioError, "The bio field is required");
    }
    else if(!regexValid(bioInput.value)) {
            showError(bioError, "Only letters ,spaces & numbers allowed");
    }

    if(errorExists) {
        evt.preventDefault();
    }
}