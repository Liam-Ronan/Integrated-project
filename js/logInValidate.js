let logInBtn = document.getElementById('login_btn');

let usernameInput = document.getElementById('username');
let usernameError = document.getElementById('username_error');

let passwordInput = document.getElementById('password');
let passwordError = document.getElementById('password_error');

const NAME_REGEX = /^[a-zA-Z ]*$/;
const PASSWORD_REGEX = /^[A-Za-z0-9]\w{8,}$/;

logInBtn.addEventListener('click', onSubmitForm);

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
    usernameError.innerHTML = "";
    passwordError.innerHTML = "";
}

function onSubmitForm(evt) {

    resetValues();

        /* Validate username */
        if(usernameInput.value === "") {
            showError(usernameError, "Please enter your username");
        }
        else if(!regexValid(NAME_REGEX, usernameInput.value)) {
            showError(usernameError, "Only letters and spaces");
        }

                /* Validate username */
        if(passwordInput.value === "") {
                    showError(passwordError, "Please enter your password");
        }
        else if(!regexValid(PASSWORD_REGEX, passwordInput.value)) {
                    showError(passwordError, "Must be more than 8 letters or numbers");
        }

        if(errorExists) {
            evt.preventDefault();
        }
    
}