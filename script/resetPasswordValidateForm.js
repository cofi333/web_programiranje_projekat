//Form and input values
let form = document.getElementById("form");
let reset_email = document.getElementById("reset-email");
let new_password = document.getElementById("new-password");
let repeat_new_password = document.getElementById("repeated-new-password");
//Span elements for error messages
let email_errorMessage = document.getElementById("reset-email_error");
let password_errorMessage = document.getElementById("reset-password_error");
let repeat_password_error = document.getElementById("reset-repeat_password_error");

form.addEventListener("submit", function(e) {
    e.preventDefault();

    if(validateForm()) {
        this.submit();
    }

});

//Function to validate form
let validateForm = () => {
    let validForm = true;
    email_errorMessage.innerHTML="";
    password_errorMessage.innerHTML="";
    repeat_password_error.innerHTML="";

    if(isEmpty(reset_email.value.trim())) {
        email_errorMessage.innerHTML = "Please enter a email.";
        validForm = false;
    }
    else if(!isValidEmail(reset_email.value.trim())) {
        email_errorMessage.innerHTML = "Email is in incorrect format.";
        validForm = false;
    }

    if(!isValidPassword(new_password.value)){
        validForm = false;
        password_errorMessage.innerHTML = "Your password must contain:" + "<br>" + "Minimum eight characters" + "<br>" + "At least one uppercase letter" + "<br>" + "One lowercase letter" + "<br>" + "One number and one special character";
    }

    if(new_password.value.trim() !== repeat_new_password.value.trim()) {
        repeat_password_error.innerHTML = "Passwords do not match. Please re-enter.";
        validForm = false;
    }


    return validForm;
}

//Function to check if email is in valid form
const isValidEmail = (email) => {
    let rex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    return rex.test(email);
}

//Function to check if input value is empty
const isEmpty = value => value === '';

//Function to check if password is in valid form
const isValidPassword = (password) => {
    let rexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return rexPassword.test(password);
}

