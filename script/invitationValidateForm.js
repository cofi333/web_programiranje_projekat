let form = document.getElementById("form");
let guest_email = document.getElementById("guest-email");
let guest_name = document.getElementById("guest-name");
let validForm = false;

form.addEventListener("submit", function(e) {
    e.preventDefault();

    validateGuestEmail();
    validateGuestName();

    guest_email.addEventListener("change", validateGuestEmail);
    guest_name.addEventListener("change", validateGuestName);

    if(validateGuestEmail() && validateGuestName()) this.submit();

});

let validateGuestEmail = () => {
    let email_errorMessage = document.getElementById("email-error");

    if(isEmpty(guest_email.value.trim())) {
        email_errorMessage.innerHTML = "Please enter a email.";
        validForm = false;
    }
    else if(!isValidEmail(guest_email.value.trim())) {
        email_errorMessage.innerHTML = "Email is in incorrect format.";
        validForm = false;
    }
    else {
        validForm = true;
        email_errorMessage.innerHTML = "";
    }

    return validForm;

}

let validateGuestName = () => {

    let guest_errorMessage = document.getElementById("name-error");

    if(isEmpty(guest_name.value.trim())) {
        guest_errorMessage.innerHTML = "Please enter a name.";
        validForm = false;
    }
    else if (guest_name.value < 3) {
        guest_errorMessage.innerHTML= "Name must be at least 3 characters";
        validForm = false;
    }
    else {
        guest_errorMessage.innerHTML = "";
        validForm = true;
    }

    return validForm;
}

const isValidEmail = (email) => {
    let rex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    return rex.test(email);
}

const isEmpty = value => value === '';