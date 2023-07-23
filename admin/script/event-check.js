let isEmpty = value => value === '';


//delete form validation
document.querySelector('#deleteForm').addEventListener("submit", function (e){
    e.preventDefault();

    if(validateForm()){
        this.submit();
    }
})

let validateForm = () => {
    let validForm = true;
    let messageBox = document.querySelector('.deleteMessage');
    let errMsg = document.querySelector('#errorMsg');
    let evName = document.querySelector('#floatingInputName');
    let evNameErr = document.querySelector('#evNameErrMsg');

    errMsg.innerHTML = '';
    evNameErr.innerHTML = '';

    if(isEmpty(messageBox.value.trim()) || (messageBox.value.trim().length < 15)) {
        errMsg.innerHTML = 'Message is required for deleting event create by user';
        validForm = false;
    }
    if (isEmpty(evName.value.trim())) {
        validForm = false;
        evNameErr.innerHTML = 'You need to enter event name before deleting it';
    }

    return validForm;
}

//update form validation
document.querySelector('#update-form').addEventListener("submit", function (e){
    e.preventDefault();

    //console.log(validateUpdateForm());
    if(validateUpdateForm()){
        this.submit();
    }
});

let validateUpdateForm = () => {
    let validUpdateForm = true;
    let inputName = document.querySelector('.admin-event-name');
    let inputDesc = document.querySelector('.admin-event-desc');
    let inputLocation = document.querySelector('.admin-event-location');
    let inputDate = document.querySelector('.admin-event-date');
    let inputTime = document.querySelector('.admin-event-time');

    //errorMessages
    let errMsgName = document.querySelector('.errorMessageName');
    let errMsgDesc = document.querySelector('.errorMessageDesc');
    let errMsgLocation = document.querySelector('.errorMessageLocation');
    let errMsgDate = document.querySelector('.errorMessageDate');
    let errMsgTime = document.querySelector('.errorMessageTime');

    if(isEmpty(inputDesc.value.trim()) && !(inputDesc.value.trim().length > 10)) {
        validUpdateForm = false;
        errMsgDesc.innerHTML = 'Please enter valid event description!';
    }

    if(isEmpty(inputLocation.value.trim()) && !(inputLocation.value.trim().length > 5)) {
        validUpdateForm = false;
        errMsgLocation.innerHTML = 'Please enter valid location for this event!';
    }

    if(isEmpty(inputDate.value.trim())) {
        validUpdateForm = false;
        errMsgDate.innerHTML = 'Please enter a valid date';
    }

    if(isEmpty(inputTime.value.trim())) {
        validUpdateForm = false;
        errMsgTime.innerHTML = 'Please enter a valid time for your event';
    }

    if(isEmpty(inputName.value.trim()) && !(inputName.value.trim().length > 5)) {
        validUpdateForm = false;
        errMsgName.innerHTML = 'Please inter valid event name!';
    }

    return validUpdateForm;
}
