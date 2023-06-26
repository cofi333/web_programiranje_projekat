let form = document.getElementById("form");
let reset_email = document.getElementById("reset-email");
let new_password = document.getElementById("new-password");
let repeat_new_password = document.getElementById("repeated-new-password");
let validForm = false;

form.addEventListener("submit", function(e) {
    e.preventDefault();

    validateEmail();
    validatePassword();
    validateRepeatedPassword();

    reset_email.addEventListener("change", validateEmail);
    new_password.addEventListener("change", validatePassword);
    repeat_new_password.addEventListener("change", validateRepeatedPassword);

    if(validateEmail() && validatePassword() && validateRepeatedPassword()) this.submit();

});


let validateEmail = () => {
    let email_errorMessage = document.getElementById("reset-email_error");
    if(isEmpty(reset_email.value.trim())) {
        email_errorMessage.innerHTML = "Please enter a email.";
        validForm = false;
    }
    else if(!isValidEmail(reset_email.value.trim())) {
        email_errorMessage.innerHTML = "Email is in incorrect format.";
        validForm = false;
    }
    else {
        validForm = true;
        email_errorMessage.innerHTML = "";
    }

    return validForm;
};


let validatePassword = () => {
    let password_errorMessage = document.getElementById("reset-password_error");
    if(!(new_password.value.trim().length > 8) && !isValidPassword(new_password)){
        validForm = false;
        password_errorMessage.innerHTML = "Your password must contain:" + "<br>" + "Minimum eight characters" + "<br>" + "At least one uppercase letter" + "<br>" + "One lowercase letter" + "<br>" + "One number and one special character";
    }
    else {
        validForm = true;
        password_errorMessage.innerHTML = "";
    }

    return validForm;
}


let validateRepeatedPassword = () => {
    let repeat_password_error = document.getElementById("reset-repeat_password_error");

    if( new_password.value.trim() !== repeat_new_password.value.trim()) {
        repeat_password_error.innerHTML = "Passwords do not match. Please re-enter.";
        validForm = false;
    }
    else {
        validForm = true;
        repeat_password_error.innerHTML = "";
    }

    return validForm;

}

const isValidEmail = (email) => {
    let rex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    return rex.test(email);
}

const isEmpty = value => value === '';

const isValidPassword = (password) => {
    let rexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return rexPassword.test(password);
}

