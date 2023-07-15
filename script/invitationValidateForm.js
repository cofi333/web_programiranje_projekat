//Form and input values
let form = document.getElementById("form");
let guest_email = document.getElementById("guest-email");
let guest_name = document.getElementById("guest-name");
//Span elements for error messages
let email_errorMessage = document.getElementById("email-error");
let guest_errorMessage = document.getElementById("name-error");

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
    guest_errorMessage.innerHTML="";

    if(isEmpty(guest_email.value.trim())) {
        email_errorMessage.innerHTML = "Please enter a email.";
        validForm = false;
    }
    else if(!isValidEmail(guest_email.value.trim())) {
        email_errorMessage.innerHTML = "Email is in incorrect format.";
        validForm = false;
    }

    if(isEmpty(guest_name.value.trim())) {
        guest_errorMessage.innerHTML = "Please enter a name.";
        validForm = false;
    }
    else if (guest_name.value.length < 3) {
        guest_errorMessage.innerHTML= "Name must be at least 3 characters.";
        validForm = false;
    }
    else if(guest_name.value.length > 30) {
        guest_errorMessage.innerHTML= "Name must have under 30 characters.";
    }


    return validForm;
}

//Function checks if email is valid
const isValidEmail = (email) => {
    let rex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    return rex.test(email);
}

//Function checks if input value is empty
const isEmpty = value => value === '';