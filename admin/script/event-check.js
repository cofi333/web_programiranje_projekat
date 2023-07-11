let isEmpty = value => value === '';
document.querySelector('#sumbitDeleteForm').addEventListener("click", function (e){

    let messageBox = document.querySelector('.deleteMessage');
    let errMsg = document.querySelector('#errorMsg');


    if(!isEmpty(messageBox.value.trim())) {
        errMsg.innerHTML = '';
        this.submit();
    }
    else {
        e.preventDefault();
        errMsg.innerHTML = 'Message is required for deleting event create by user';
    }
})


