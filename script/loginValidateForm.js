//Form and input elements
let emailInput = document.getElementById('exampleInputEmail1');
let passwordInput = document.getElementById('exampleInputPassword1');

// p elements for error message for each input
let emailError = document.getElementById('emailError');
let passwordError = document.getElementById('passwordError');

//valid form flag


document.getElementById('login-form').addEventListener("submit", function (e){
   e.preventDefault();

   if(validateLoginForm()){
       this.submit();
   }
});

let validateLoginForm = () => {
    emailError.innerHTML = '';
    passwordError.innerHTML = '';

    let validLoginForm = true;
    if(isEmpty(emailInput.value.trim()) && !isValidEmail(emailInput.value.trim())) {
        validLoginForm = false;
        emailError.innerHTML += 'Please enter valid email address';
    }

    if(!isValidPassword(passwordInput.value)) {
        validLoginForm = false;
        passwordError.innerHTML += 'Incorrect password, please try again.';
    }

    return validLoginForm;
}

const isEmpty = value => value === '';

const isValidEmail = (email) => {
    let rex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    return rex.test(email);
}

const isValidPassword = (password) => {
    let rexPassword = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    return rexPassword.test(password);
}

