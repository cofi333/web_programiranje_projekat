//Form and input values
let form = document.getElementById("form");
let title = document.getElementById("event-title");
let organizer = document.getElementById("event-organizer");
let category = document.getElementById("event-category");
let date = document.getElementById("event-date");
let time = document.getElementById("event-time");
let description = document.getElementById("event-description");
let location2 = document.getElementById("event-location");

//Span elements for error messages
let title_errorMessage = document.getElementById("event-title_error");
let organizer_errorMessage = document.getElementById("event-organizer_error");
let category_errorMessage = document.getElementById("event-category_error");
let location_errorMessage = document.getElementById("event-location_error");
let date_errorMessage = document.getElementById("event-date_error");
let time_errorMessage = document.getElementById("event-time_error");
let description_errorMessage = document.getElementById("event-description_error");

//Code to disable option to create event in past
let today = new Date();
let dd = String(today.getDate()).padStart(2,'0');
let mm = String(today.getMonth() + 1).padStart(2,'0');
let yyyy = today.getFullYear();
today = yyyy + '-' + mm + '-' + dd;
date.min = today;


form.addEventListener("submit", function(e) {
    e.preventDefault();

    if(validateForm()) {
        this.submit();
    }
});

//Function to validate form
let validateForm = () => {

    let validForm = true;
    title_errorMessage.innerText="";
    organizer_errorMessage.innerText="";
    category_errorMessage.innerText="";
    location_errorMessage.innerText="";
    date_errorMessage.innerText="";
    time_errorMessage.innerText="";
    description_errorMessage.innerText="";

    if(isEmpty(title.value.trim())) {
        title_errorMessage.innerText = "Please enter a title.";
        validForm = false;
    }

    if(organizer.value.trim().length < 3) {
        organizer_errorMessage.innerText = "Organizer can't be empty and must have at least 3 characters.";
        validForm = false;
    }


    if(category.value === "default") {
        category_errorMessage.innerText = "Please select category.";
        validForm = false;
    }

    if(location2.value.trim().length < 3) {
        validForm = false;
        location_errorMessage.innerText = "Please enter a valid location.";
    }

    if(isEmpty(date.value)) {
        date_errorMessage.innerText = "Please enter a date.";
        validForm = false;
    }

    if(!isValidTime(time.value)) {
        validForm = false;
        time_errorMessage.innerText = "Time is in incorrect format.";
    }

    if(description.value.trim().length < 15) {
        validForm = false;
        description_errorMessage.innerText = "Description must have at least 15 characters.";
    }


    return validForm;
}


//Function checks if input value is empty
const isEmpty = value => value === '';


//Function checks if time is in valid form
const isValidTime = (time) => {
    let rexTime = /^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/;
    return rexTime.test(time);
}