let form = document.getElementById("form");
let title = document.getElementById("event-title");
let organizer = document.getElementById("event-organizer");
let category = document.getElementById("event-category");
let date = document.getElementById("event-date");
let time = document.getElementById("event-time");
let description = document.getElementById("event-description");
let location2 = document.getElementById("event-location");
let validForm = false;


form.addEventListener("submit", function(e) {
    e.preventDefault();

    validateEventTitle();
    validateEventOrganizer();
    validateEventCategory();
     validateLocation();
    validateDate();
    validateTime();
    validateDescription();


    title.addEventListener("change", validateEventTitle);
    organizer.addEventListener("change", validateEventOrganizer);
    category.addEventListener("change", validateEventCategory);
    date.addEventListener("change", validateDate);
    time.addEventListener("change", validateTime);
    description.addEventListener("change", validateDescription);
    location2.addEventListener("change", validateLocation);




    if(validateEventTitle() && validateEventOrganizer() && validateEventCategory() && validateLocation()  && validateDate() && validateTime() && validateDescription()) this.submit();

});

let validateEventTitle = () => {


    let title_errorMessage = document.getElementById("event-title_error");

    if(isEmpty(title.value)) {
        title_errorMessage.innerText = "Please enter a title.";
        validForm = false;
    }
    else {
        validForm = true;
        title_errorMessage.innerText = "";
    }

    return validForm;

}

let validateEventOrganizer = () => {

    let organizer_errorMessage = document.getElementById("event-organizer_error");

    if(isEmpty(organizer.value)) {
        organizer_errorMessage.innerText = "Please enter who is a organizer.";
        validForm = false;
    }
    else {
        validForm = true;
        organizer_errorMessage.innerText = "";
    }

    return validForm;
}

let validateEventCategory = () => {

    let category_errorMessage = document.getElementById("event-category_error");

    if(category.value === "default") {
        category_errorMessage.innerText = "Please select category.";
        validForm = false;
    }
    else {
        category_errorMessage.innerText = "";
        validForm = true;
    }

    return validForm;
}

let validateLocation = () => {

    let location_errorMessage = document.getElementById("event-location_error");
    if(isEmpty(location2.value)) {

        validForm = false;
        location_errorMessage.innerText = "Please enter a location.";

    }
    else {
        validForm = true;
        location_errorMessage.innerText = "";
    }

    return validForm;
}

let validateDate = () => {

    let date_errorMessage = document.getElementById("event-date_error");

    if(isEmpty(date.value)) {
        date_errorMessage.innerText = "Please enter a date.";
        validForm = false;
    }

    else {
        validForm = true;
        date_errorMessage.innerText = "";
    }


    return validForm;
}

let validateTime = () => {
    let time_errorMessage = document.getElementById("event-time_error");

    if(isEmpty(time.value)) {
        validForm = false;
        time_errorMessage.innerText = "Please enter a time.";
    }
    else {
        if(!isValidTime(time.value)) {
            validForm = false;
            time_errorMessage.innerText = "Time is in incorrect format.";
        }
        else {
            validForm = true;
            time_errorMessage.innerText = "";
        }
    }
    return validForm;
}

let validateDescription = () => {
    let description_errorMessage = document.getElementById("event-description_error");

    if(isEmpty(description.value)) {
        validForm = false;
        description_errorMessage.innerText = "Please enter a description.";
    }
    else {
        validForm = true;
        description_errorMessage.innerText = "";
    }

    return validForm;
}



const isEmpty = value => value === '';



const isValidTime = (time) => {
    let rexTime = /^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/;
    return rexTime.test(time);
}