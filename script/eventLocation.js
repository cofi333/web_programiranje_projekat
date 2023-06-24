const venue_location = document.getElementById("location_input_venue");
const online_location = document.getElementById("location_input_online");
const online_button = document.getElementById("online_button");
const venue_button = document.getElementById("venue_button");

venue_button.addEventListener("click", function() {
    if(online_location.style.display === "block") {
        online_location.style.display = "none";
        venue_location.style.display = "block";
    }
    else {
        venue_location.style.display = "block";
    }
});

online_button.addEventListener("click", function() {
    if(venue_location.style.display === "block") {
        venue_location.style.display = "none";
        online_location.style.display = "block";
    }
    else {
        online_location.style.display = "block";
    }
});
