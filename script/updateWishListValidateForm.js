let form2 = document.getElementById("form2");
let gift_new_name = document.getElementById("gift-new-name");
let gift_new_link = document.getElementById("gift-new-link");
let validForm = false;


form2.addEventListener("submit", function(e) {
    e.preventDefault();

    validateNewName();
    validateNewLink();

    gift_new_name.addEventListener("change", validateNewName);
    gift_new_link.addEventListener("change",validateNewLink);

    if(validateNewLink() && validateNewName()) {
        this.submit();
    }

});


let validateNewName = () => {

    let name_error = document.getElementById("gift-new-name-error");

    if(isEmpty(gift_new_name.value.trim()) || gift_new_name.value.trim().length < 3) {
        name_error.innerHTML="Name can not be empty, and must have at least 3 characters.";
        validForm = false;
    }
    else {
        name_error.innerHTML="";
        validForm = true;
    }

    return validForm;
}

let validateNewLink = () => {
    let link_error = document.getElementById("gift-new-link-error");

    if(!isValidLink(gift_new_link.value)) {
        link_error.innerHTML='Link is not in valid form.';
        isValid = false;
    }
    else {
        link_error.innerHTML='';
        isValid=true;
    }

    return isValid;
}


