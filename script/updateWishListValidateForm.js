//Form and input values
let form2 = document.getElementById("form2");
let gift_new_name = document.getElementById("gift-new-name");
let gift_new_link = document.getElementById("gift-new-link");
//Span elements for error messages
let new_name_error = document.getElementById("gift-new-name-error");
let new_link_error = document.getElementById("gift-new-link-error");

form2.addEventListener("submit", function(e) {
    e.preventDefault();

    if(validationForm()) {
        this.submit();
    }

});

//Function to validate form
let validationForm = () => {

    let validForm = true;

    if(isEmpty(gift_new_name.value.trim()) || gift_new_name.value.trim().length < 3) {
        new_name_error.innerHTML="Name can not be empty, and must have at least 3 characters.";
        validForm = false;
    }

    if(!isValidLink(gift_new_link.value)) {
        new_link_error.innerHTML='Link is not in valid form.';
        validForm = false;
    }

    return validForm;
}

