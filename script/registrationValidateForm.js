//Form and input elements
let form = document.querySelector('#form');
let name = document.getElementById("name");
let email = document.getElementById("email");
let password = document.getElementById("password");
let confirm_password = document.getElementById("repeated-password");

// Span elements for error message for each input
let name_error= document.getElementById("name-error");
let mail_error = document.getElementById("mail-error");
let password_error = document.getElementById("password-error");
let repeat_password_error = document.getElementById("repeat-password-error");



form.addEventListener("submit", function (e){
    e.preventDefault();

    if(registrationValidateForm()) {
        this.submit();
    }
});

//Function to validate form
let registrationValidateForm = () => {

    let validForm = true;
    name_error.innerHTML="";
    mail_error.innerHTML="";
    password_error.innerHTML="";
    repeat_password_error.innerHTML="";

    if(isEmpty(name.value) && name.value.length < 8) {
        validForm = false;
        name_error.innerHTML = "Your name must be at least 8 characters long.";
    }

    if(!isValidEmail(email.value.trim())) {
        mail_error.innerHTML += "Email is in incorrect format.";
        validForm = false;
    }

    if(!isValidPassword(password.value)){
        validForm = false;
        password_error.innerHTML +=  "Your password must contain:" + "<br>" + "Minimum eight characters" + "<br>" + "At least one uppercase letter" + "<br>" + "One lowercase letter" + "<br>" + "One number and one special character";
    }

    if(password.value.trim() !== confirm_password.value.trim()) {
        repeat_password_error.innerHTML += "Passwords do not match. Please re-enter.";
        validForm = false;
    }


    return validForm;
}

//Function checks if email is valid
const isValidEmail = (email) => {
    let rex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    return rex.test(email);
}

//Function checks if password is valid
const isValidPassword = (password) => {
    let rexPassword = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    return rexPassword.test(password);
}

//Function checks if input value is empty
const isEmpty = value => value === '';
