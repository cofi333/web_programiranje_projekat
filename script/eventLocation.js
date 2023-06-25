const event_label = document.getElementById("location_input_label");
const event_input = document.getElementById("location_input");
const online_button = document.getElementById("online_button");
const venue_button = document.getElementById("venue_button");

venue_button.addEventListener("click", function() {
    event_label.innerText = "Venue";

    if (event_input.style.display === "none") {
        event_input.style.display = "block";
    }
    else {
        event_input.style.display = "block";
    }

});

online_button.addEventListener("click", function() {
    event_label.innerText = "Online event";

    if (event_input.style.display === "none") {
        event_input.style.display = "block";
    }
    else {
        event_input.style.display = "block";
    }
});
