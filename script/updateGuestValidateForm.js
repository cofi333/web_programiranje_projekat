//Form and input values
let form2 = document.getElementById("form2");
let name2 = document.getElementById("guest-new-name");
//Span element for error message
let name_error = document.getElementById("new-name-error");
//Modal button
let close_modal = document.querySelectorAll('.close-modal-btn');

form2.addEventListener("submit", function(e) {

    e.preventDefault();

    if(validationForm()) {
        this.submit();
    }
});

//To clear input value and error message after user close the modal
for(let i =0; i< close_modal.length ;i++) {
    close_modal[i].addEventListener("click", function () {
        name2.value = '';
        name_error.innerHTML = '';
    })
}

//Function to validate form
let validationForm = () => {
    let isValid = true;

    if(isEmpty(name2.value) || name2.value.length < 3 || name2.value.length > 30) {
        name_error.innerHTML="Name can not be empty,must have at least 3,and maximum 30 characters.";
        isValid = false;
    }

    return isValid;

}


