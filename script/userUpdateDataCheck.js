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