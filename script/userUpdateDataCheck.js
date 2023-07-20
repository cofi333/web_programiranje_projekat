//update info check
let infoCheck = true;
document.querySelector('#updateUserInfoForm').addEventListener("submit", function (e){
    e.preventDefault();
    if(updateInfoFormValidation()){
        this.submit();
    }
});

let updateInfoFormValidation = () => {
    let userName = document.querySelector('#floatingUpdateName');
    let errMsgName = document.querySelector('#nameInputErrorMsg');

    if(userName.value.trim().length < 3){
        infoCheck = false;
        errMsgName.innerHTML = 'Your name must be at least 3 characters long!';
    } else {
        infoCheck = true;
        errMsgName.innerHTML = '';
    }

    return infoCheck;
}

//update password check
document.querySelector('#updateUserPasswordForm').addEventListener("submit", function (ev){
    ev.preventDefault();
    console.log(updatePasswordFormValidation());
    if(updatePasswordFormValidation()){
        this.submit();
    }
});


let updatePasswordFormValidation = () => {
    let passCheck = true;
    //input tags
    let currentPassword = document.querySelector('#floatingUpdatePassword');
    let newPassword = document.querySelector('#floatingUpdateNewPassword');
    let repNewPassword = document.querySelector('#floatingUpdateRepeatPassword');

    //error messages
    let currPassmsg = document.querySelector('#currentPasswordError');
    let newPassmsg = document.querySelector('#newPasswordError');
    let repnewPassmsg = document.querySelector('#repNewPasswordError');

    if(isEmpty(currentPassword.value) && !isValidPassword(currentPassword.value.trim())) {
        passCheck = false;
        currPassmsg.innerHTML = 'Please enter valid password';
    }

    if(isEmpty(newPassword.value) && !isValidPassword(newPassword.value.trim()) && !(newPassword.value.trim().length > 8)) {
        passCheck = false;
        newPassmsg.innerHTML = 'Your new password must containt at least 8 charaters where' + '<br/>' + 'One char is uppercase letter' + '<br/>' + 'One is number' + '<br/>' +  'One is special char';
    }

    if(isEmpty(repNewPassword.value) && (newPassword.value.trim() !== repNewPassword.value.trim())) {
        passCheck = false;
        repnewPassmsg.innerHTML = 'Your passwords does not match.';
    }

    return passCheck;
}

let isEmpty = value => value === '';

const isValidPassword = (password) => {
    let rexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return rexPassword.test(password);
}