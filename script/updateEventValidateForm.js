//Form,input values and span tag for error message
let form = document.getElementById("form");
let title = document.getElementById("event-title");
let organizer = document.getElementById("event-organizer");
let category = document.getElementById("event-category");
let Location = document.getElementById("event-location");
let date = document.getElementById("event-date");
let time = document.getElementById("event-time");
let description = document.getElementById("event-description");
let error_message = document.getElementById("error");
//Modal and buttons in modal that update event
let button = document.getElementById("modal-submit");
const myModal = new bootstrap.Modal(document.getElementById('exampleModal'));


//Code to disable option to update event in past
let today = new Date();
let dd = String(today.getDate()).padStart(2,'0');
let mm = String(today.getMonth() + 1).padStart(2,'0');
let yyyy = today.getFullYear();
today = yyyy + '-' + mm + '-' + dd;
date.min = today;

form.addEventListener("submit", function(e) {
    e.preventDefault()

    let isValid = true;

    if(isEmpty(title.value) || isEmpty(organizer.value) || isEmpty(category.value) || isEmpty(Location.value) || isEmpty(date.value) || isEmpty(time.value) || isEmpty(description.value))  {
        isValid = false;
        error_message.innerText = "Fields can't be empty!";
    }
    if(isValid) {
        myModal.show();
        button.addEventListener("click", function () {
            form.submit();
        });
    }
});

//Functions checks if input value is empty
const isEmpty = value => value === '';