let submitBtn = document.getElementById('submit_Btn');
let headlineInput = document.getElementById('headline');
let briefHeadlineInput = document.getElementById('brief_headline');
let synopsisInput = document.getElementById('synopsis');
let articleInput = document.getElementById('article');
let dobInput = document.getElementById('published_date');
let journalistInput = document.getElementsByName('journalist_id');
let typeInput = document.getElementsByName('type_id');

/* get error divs by ID */
let headlineError = document.getElementById('headline_error');
let brief_headlineError = document.getElementById('brief_headline_error');
let synopsisError = document.getElementById('synopsis_error');
let articleError = document.getElementById('article_error');
let dobError = document.getElementById('published_date_error');
let journalistError = document.getElementById('journalist_error');
let typeError = document.getElementById('type_error');

/* REGEX PATTERNS */
const ARTICLE_REGEX = /^[0-9a-zA-Z- ]*$/;
const DATE_REGEX = /^([0-9]{4})-([0-9]{2})-([0-9]{2})$/; 

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
    headlineError.innerHTML = "";
    brief_headlineError.innerHTML = "";
    synopsisError.innerHTML = "";
    articleError.innerHTML = "";
    dobError.innerHTML = "";
    journalistError.innerHTML = "";
    typeError.innerHTML = "";
}

function onSubmitForm(evt) {

    resetValues();

    /* Validate headline */
    if(headlineInput.value === "") {
        showError(headlineError, "The headline field is required");
    }
    else if(!regexValid(ARTICLE_REGEX, headlineInput.value)) {
        showError(headlineError, "Only letters, spaces & numbers allowed");
    }

      /* Validate brief headline */
    if(briefHeadlineInput.value === "") {
        showError(brief_headlineError, "The brief headline field is required");
    }
    else if(!regexValid(ARTICLE_REGEX, briefHeadlineInput.value)) {
        showError(brief_headlineError, "Only letters, numbers and spaces allowed");
    }

    /* Validate synopsis */
    if(synopsisInput.value === "") {
        showError(synopsisError, "The synopsis field is required");
    }
    else if(!regexValid(ARTICLE_REGEX, synopsisInput.value)) {
        showError(synopsisError, "The synopsis field is required");
    }

     /* Validate Article */
    if(articleInput.value === "") {
        showError(articleError, "The article field is required");
    }
    else if(!regexValid(ARTICLE_REGEX, articleInput.value)) {
        showError(articleError, "Invalid article format");
    }

     /* Validate DOB */
    if(dobInput.value === "") {
        showError(dobError, "The published date is required");
    }
    else if(!regexValid(DATE_REGEX, dobInput.value)) {
        showError(dobError, "Invalid date format");
    }

     /* Validate journalist */
    if(journalistInput.value === "") {
        showError(journalistError, "The type field is required");
    }

    if(typeInput.value === "") {
        showError(typeError, "The type field is required");
    }

    if(errorExists) {
        evt.preventDefault();
    }
}
