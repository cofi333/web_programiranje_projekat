let form = document.getElementById("form");
let title = document.getElementById("event-title");
let organizer = document.getElementById("event-organizer");
let category = document.getElementById("event-category");
let Location = document.getElementById("event-location");
let date = document.getElementById("event-date");
let time = document.getElementById("event-time");
let description = document.getElementById("event-description");
let error_message = document.getElementById("error");

let isValid = false;

let title_value = title.value.trim();
let organizer_value = organizer.value.trim();
let category_value = category.value.trim();
let location_value = Location.value.trim();
let date_value = date.value.trim();
let time_value = time.value.trim();
let description_value = description.value.trim();

form.addEventListener("submit", function(e) {
    e.preventDefault();

    title.addEventListener("change", function () {
        isValid = true;

        if(title.value.trim() === title_value) {
            isValid = false;
        }
    });

    organizer.addEventListener("change", function () {
        isValid = true;

        if(organizer.value.trim() === organizer_value) {
            isValid = false;
        }

    });

    category.addEventListener("change", function () {
        isValid = true;

        if(category.value.trim() === category_value) {
            isValid = false;
        }
    });

    Location.addEventListener("change", function () {
        isValid = true;

        if(Location.value.trim() === location_value) {
            isValid = false;
        }
    });

    date.addEventListener("change", function () {
        isValid = true;

        if(date.value.trim() === date_value) {
            isValid = false;
        }
    });

    time.addEventListener("change", function () {
        isValid = true;

        if(time.value.trim() === time_value) {
            isValid = false;
        }
    });

    description.addEventListener("change", function () {
        isValid = true;

        if(description.value.trim() === description_value) {
            isValid = false;
        }
    });

    if(isValid) {
        this.submit();
    }
    else {
        error_message.innerText = "If you want to update your event, you need to change at least one field.";
    }

})