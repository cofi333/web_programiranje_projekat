//Form and input values
let form = document.getElementById("form");
let gift_name = document.getElementById("gift-name");
let gift_link = document.getElementById("gift-link");
//Span elements for error messages
let name_error = document.getElementById("gift-name-error");
let link_error = document.getElementById("gift-link-error");

form.addEventListener("submit", function(e) {
    e.preventDefault();

    if(validateForm()) {
        this.submit();
    }
});


//Function to validate form
let validateForm = () => {

    name_error.innerHTML="";
    link_error.innerHTML="";

    let isValid = true;

    if(isEmpty(gift_name.value) || gift_name.value.length < 3) {
        name_error.innerHTML="Name can not be empty, and must have at least 3 characters.";
        isValid = false;
    }

    if(!isValidLink(gift_link.value)) {
        link_error.innerHTML='Link is not in valid form.';
        isValid = false;
    }

    return isValid;
}

//Function to check if input value is empty
const isEmpty = value => value === '';


//Function to check if link is valid
const isValidLink = (link) => {
    let rex= /(https:\/\/www\.|http:\/\/www\.|https:\/\/|http:\/\/)?[a-zA-Z0-9]{2,}(\.[a-zA-Z0-9]{2,})(\.[a-zA-Z0-9]{2,})?/;
    return rex.test(link);

}