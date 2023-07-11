let form = document.getElementById("form");
let gift_name = document.getElementById("gift-name");
let gift_link = document.getElementById("gift-link");

form.addEventListener("submit", function(e) {
    e.preventDefault();

    validateName();
    validateLink();

    gift_name.addEventListener("change", validateName);
    gift_link.addEventListener("change",validateLink);

    if(validateName() && validateLink()) {
        this.submit();
    }

});

let validateName = () => {

    let name_error = document.getElementById("gift-name-error");

    if(isEmpty(gift_name.value) || gift_name.value.length < 3) {
        name_error.innerHTML="Name can not be empty, and must have at least 3 characters.";
        isValid = false;
    }
    else {
        name_error.innerHTML="";
        isValid = true;
    }

    return isValid;
}

let validateLink = () => {

    let link_error = document.getElementById("gift-link-error");

    if(!isValidLink(gift_link.value)) {
        link_error.innerHTML='Link is not in valid form';
        isValid = false;
    }
    else {
        link_error.innerHTML='';
        isValid=true;
    }

    return isValid;

}

const isEmpty = value => value === '';

const isValidLink = (link) => {
    let rex= /(https:\/\/www\.|http:\/\/www\.|https:\/\/|http:\/\/)?[a-zA-Z0-9]{2,}(\.[a-zA-Z0-9]{2,})(\.[a-zA-Z0-9]{2,})?/;
    return rex.test(link);

}