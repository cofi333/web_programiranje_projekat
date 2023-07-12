let isEmpty = value => value === '';
let validForm = false;
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


