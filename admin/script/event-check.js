let isEmpty = value => value === '';

//formating date
let moment = require('moment');

let validForm = false;
let validUpdateForm = false;
//delete form validation
document.querySelector('#deleteForm').addEventListener("submit", function (e){
    e.preventDefault();

    if(validateForm()){
        this.submit();
    }
})

let validateForm = () => {

    let messageBox = document.querySelector('.deleteMessage');
    let errMsg = document.querySelector('#errorMsg');
    console.log("text: " , messageBox.value.trim());
    console.log("text-len: " , messageBox.value.trim().length);



    if(!isEmpty(messageBox.value.trim()) && messageBox.value.trim().length >= 15) {
        errMsg.innerHTML = '';
        validForm = true;
    }
    else {
        errMsg.innerHTML = 'Message is required for deleting event create by user';
        validForm = false;
    }

    return validForm;
}

//update form validation
document.querySelector('#update-form').addEventListener("submit", function (e){
    e.preventDefault();

    if(validateUpdateForm()){
        this.submit();
    }
});

let validateUpdateForm = () => {
    let inputName = document.querySelector('.admin-event-name');
    let inputDesc = document.querySelector('.admin-event-desc');
    let inputLocation = document.querySelector('.admin-event-location');
    let inputDate = document.querySelector('.admin-event-date').value;
    let inputTime = document.querySelector('.admin-event-time').value;
    let errMsg = document.querySelector('.errorMessage');

    if(!isEmpty(inputName.value.trim()) && inputName.trim().length > 5) {
        validUpdateForm = true;
    } else {
        validUpdateForm = false;
        errMsg.innerHTML += 'Please inter valid event name! <br/>';
    }

    if(!isEmpty(inputDesc.value.trim()) && inputDesc.value.trim().length > 10) {
        validUpdateForm = true;
    } else {
        validUpdateForm = false;
        errMsg.innerHTML += 'Please enter valid event description! <br/>';
    }

    if(!isEmpty(inputLocation.value.trim()) && inputLocation.value.trim().length > 5) {
        validUpdateForm = true;
    } else {
        validUpdateForm = false;
        errMsg.innerHTML += 'Please enter valid location for this event! <br/>';
    }

    if(!isEmpty(inputDate.value.trim())){
        validUpdateForm = true;
    } else{
        validUpdateForm = false;
        errMsg.innerHTML += 'Please enter a valid date';
    }

    if(!isEmpty())


}


