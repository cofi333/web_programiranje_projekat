let email_forget = document.getElementById('email-forgot');
let form_forget = document.getElementById('forget-form');
let email_forget_error = document.getElementById('forget-password_error');

form_forget.addEventListener("submit", function (e) {
    e.preventDefault();

    if(forgotPasswordValidateForm()) {
        this.submit();
    }
})

let forgotPasswordValidateForm = () => {
    let validForm = true;

    email_forget_error.innerHTML = '';

    if(!isValidEmail(email_forget.value.trim())) {
        email_forget_error.innerHTML = 'Email is in incorrect format.';
        validForm = false;
    }

    return validForm;
}

