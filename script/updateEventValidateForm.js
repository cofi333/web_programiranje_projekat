

let form = document.getElementById("form");
let title = document.getElementById("event-title");
let organizer = document.getElementById("event-organizer");
let category = document.getElementById("event-category");
let Location = document.getElementById("event-location");
let date = document.getElementById("event-date");
let time = document.getElementById("event-time");
let description = document.getElementById("event-description");
let error_message = document.getElementById("error");
let button = document.getElementById("modal-submit");
const myModal = new bootstrap.Modal(document.getElementById('exampleModal'));



let isValid = false;



form.addEventListener("submit", function(e) {
    e.preventDefault();

    if(isEmpty(title.value) || isEmpty(organizer.value) || isEmpty(category.value) || isEmpty(Location.value) || isEmpty(date.value) || isEmpty(time.value) || isEmpty(description.value))  {
        isValid = false;
        error_message.innerText = "Fields can't be empty!";

    }
    else {
        isValid = true;
    }



    if(isValid) {
        myModal.show();

        button.addEventListener("click", function () {
            form.submit();
        });
    }

});

const isEmpty = value => value === '';