let form = document.getElementById("form");
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
});

let validateEventTitle = () => {

    let title = document.getElementById("event-title");
    let title_errorMessage = document.getElementById("event-title_error");

    if(isEmpty(title.value)) {
        title_errorMessage.innerText = "Please enter a title.";
        validForm = false;
    }
    else {
        validForm = true;
        title_errorMessage.innerText = "";
    }


}

let validateEventOrganizer = () => {

    let organizer = document.getElementById("event-organizer");
    let organizer_errorMessage = document.getElementById("event-organizer_error");

    if(isEmpty(organizer.value)) {
        organizer_errorMessage.innerText = "Please enter who is a organizer.";
        validForm = false;
    }
    else {
        validForm = true;
        organizer_errorMessage.innerText = "";
    }
}

let validateEventCategory = () => {

    let category = document.getElementById("event-category");
    let category_errorMessage = document.getElementById("event-category_error");

    if(category.value === "default") {
        category_errorMessage.innerText = "Please select category.";
        validForm = false;
    }
    else {
        category_errorMessage.innerText = "";
        validForm = true;
    }

}

let validateLocation = () => {

    let location = document.getElementById("event-location");
    let location_errorMessage = document.getElementById("event-location_error");

    if(isEmpty(location.value)) {
        validForm = false;
        location_errorMessage.innerText = "Please enter a location.";
    }
    else {
        validForm = true;
        location_errorMessage.innerText = "";
    }

}

let validateDate = () => {

    let date = document.getElementById("event-date");
    let date_errorMessage = document.getElementById("event-date_error");

    if(!isValidDate(date.value)) {
        validForm = false;
        date_errorMessage.innerText = "Date is in incorrect format.";
    }
    else {
        validForm = true;
        date_errorMessage.innerText = "";
    }

}

let validateTime = () => {
    let time = document.getElementById("event-time");
    let time_errorMessage = document.getElementById("event-time_error");

    if(isEmpty(time.value)) {
        validForm = false;
        time_errorMessage.innerText = "Please enter a time.";
    }
    else {
        validForm = true;
        time_errorMessage.innerText = "";
    }
}

let validateDescription = () => {
    let description = document.getElementById("event-description");
    let description_errorMessage = document.getElementById("event-description_error");

    if(isEmpty(description.value)) {
        validForm = false;
        description_errorMessage.innerText = "Please enter a description.";
    }
    else {
        validForm = true;
        description_errorMessage.innerText = "";
    }
}



const isEmpty = value => value === '';

const isValidDate = (date) => {
    let rexDate = /^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/;
    return rexDate.test(date);
}

const isValidTime = (time) => {

}