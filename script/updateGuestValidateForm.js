let form2 = document.getElementById("form2");
let name2 = document.getElementById("guest-new-name");
let name_error = document.getElementById("new-name-error");
let close_modal = document.querySelectorAll('.close-modal-btn');
let isValid = false;


form2.addEventListener("submit", function(e) {

    e.preventDefault();

    validateName();
    name2.addEventListener("change", validateName);

    for(let i =0; i< close_modal.length ;i++) {
        close_modal[i].addEventListener("click", function() {
            name2.value = '';
            name_error.innerHTML='';
        })
    }
    if(validateName()) {
        this.submit();
    }

});

let validateName = () => {
    if(isEmpty(name2.value) || name2.value.length < 3) {
        name_error.innerHTML="Name can not be empty, and must have at least 3 characters.";
        isValid = false;
    }
    else {
        name_error.innerHTML="";
        isValid = true;
    }

    return isValid;
}

