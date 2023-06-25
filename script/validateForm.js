let form = document.querySelector('#form');
let name = document.getElementById("name");
let email = document.getElementById("email");
let password = document.getElementById("password");
let confirm_password = document.getElementById("repeated-password");
let validForm = false;


form.addEventListener("submit", function (e){
    e.preventDefault();

    validateName();
    validateEmail();
    validatePassword();
    validateRepeatedPassword();


    name.addEventListener("change", validateName);
    email.addEventListener("change", validateEmail);
    password.addEventListener("change", validatePassword);
    confirm_password.addEventListener("change", validateRepeatedPassword);

    if(validateName() && validateEmail() && validateRepeatedPassword() && validatePassword()) this.submit();


});



let validateName = () => {
    let name_errorMessage = document.getElementById("name_error");

    if(isEmpty(name.value) && name.value.length < 8) {
        validForm = false;
        name_errorMessage.innerHTML = "Your name must be at least 8 characters long";
    }
    else{
        validForm = true;
        name_errorMessage.innerHTML = "";
    }
    if(isEmpty(name.value) && name.value.length < 8) {
        validForm = false;
        name_errorMessage.innerHTML = "Your name must be at least 8 characters long";
    }
    else{
        validForm = true;
        name_errorMessage.innerHTML = "";
    }

    return validForm;
}

let validateEmail = () => {
    let email_errorMessage = document.getElementById("email_error");
    if(isEmpty(email.value.trim())) {
        email_errorMessage.innerHTML = "Please enter a email.";
        validForm = false;
    }
    else if(!isValidEmail(email.value.trim())) {
        email_errorMessage.innerHTML = "Email is in incorrect format.";
        validForm = false;
    }
    else {
        validForm = true;
        email_errorMessage.innerHTML = "";
    }

    return validForm;
}

let validatePassword = () => {
    let password_errorMessage = document.getElementById("password_error");
    if(!(password.value.trim().length > 8) && !isValidPassword(password)){
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
    let repeat_password_error = document.getElementById("repeat_password_error");

    if(password.value.trim() !== confirm_password.value.trim()) {
        repeat_password_error.innerHTML = "Passwords do not match. Please re-enter.";
        validForm = false;
    }
    else {
        validForm = true;
        repeat_password_error.innerHTML = "";
    }

    return validForm;

}

const isEmpty = value => value === '';

const isValidEmail = (email) => {
    let rex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    return rex.test(email);
}

const isValidPassword = (password) => {
    let rexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return rexPassword.test(password);
}

