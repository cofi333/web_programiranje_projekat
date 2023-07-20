const fetchUsers = async () => {
  try {
    const response = await fetch("php/fetch-all-users.php/", {
      method: "GET",
      headers: {
        Accept: "application/json",
      },
    });
    const data = await response.json();
    //console.log(data);
    let users = "";
    for (let user in data) {
      users += `
                <div class="user-admin d-md-flex justify-content-between align-items-center">
                    <div class="user-data">
                        <h4>${data[user].id_user}</h4>
                        <p class="usr-name">Username: ${data[user].email}</p>
                        <p class="usr-active">Active status: ${data[user].active}</p>
                        <p class="usr-ban">Ban status: ${data[user].is_banned}</p>
                        <p class="usr-date">Date created: ${data[user].date_time}</p>
                    </div> 
                    <div class="admin-usr-actions d-flex justify-content-center">
                        <button onclick="banUser(${data[user].id_user})" type="button" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#restrictUser" data-bs-whatever="@mdo">User actions</button>
                    </div>
               </div>`;
    }

    document.querySelector("#pills-profile").innerHTML = users;
  } catch (e) {
    console.log("Fetch error" + e);
  }
};

const fetchEvents = async () => {
  try {
    const response = await fetch("php/fetch-all-events.php/", {
      method: "GET",
      headers: {
        Accept: "application/json",
      },
    });
    const data = await response.json();
    //console.log(data);
    let events = "";
    for (let event in data) {
      events += `<div class="admin-v-events d-md-flex justify-content-between align-items-center">
                        <div class="ev-info">
                            <h4>Event ID: ${data[event].event_id}</h4>
                            <h4>Event name: ${data[event].event_title}</h4>
                            <h6>User ID: ${data[event].id_user}</h6>  
                            <p>Event date: ${data[event].event_date} / ${data[event].event_time}</p>
                            <p>Event location: ${data[event].event_location}</p>
                            <p>Ban Status: ${data[event].is_banned}</p>
                        </div>
                        <div class="ev-action d-flex justify-content-center gap-2">
                            <button 
                                id="updateEventButton"
                                onclick="updateEvent('${data[event].event_id}', 
                                                     '${data[event].event_title}', 
                                                     '${data[event].id_user}',
                                                     '${data[event].event_description}',
                                                     '${data[event].event_location}',
                                                     '${data[event].event_date}',
                                                     '${data[event].event_time}')"
                                type="button" 
                                class="btn btn-primary" 
                                data-bs-toggle="modal" 
                                data-bs-target="#updateEvent">
                                    Update event
                                </button>
                            
                            <button onclick="banEvent(${data[event].event_id})" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#banEventModal">Ban Event</button>
                            <button onclick="deleteEvent(${data[event].event_id}, ${data[event].id_user})" type="button" data-bs-toggle="modal" data-bs-target="#deleteEvent" class="btn btn-danger">Delete Event</button>
                        </div>
                       </div>`;
    }
    document.querySelector("#pills-contact").innerHTML = events;
  } catch (e) {
    console.log("Fetch error" + e);
  }
};

const fetchAdminInfo = async () => {
  try {
    const response = await fetch("php/fetch-Admin-info.php/", {
      method: "GET",
      headers: {
        Accept: "application/json",
      },
    });
    const data = await response.json();
    console.log(data);
    let footerData = "";
    for (let i in data) {
      footerData += `<p>username: ${data[i].username}</p>
                           <p>session id: ${data[i].id_admin}</p>`;
    }

    document.querySelector("#admin-info").innerHTML = footerData;
  } catch (e) {
    console.log("Fetch error" + e);
  }
};

//funtions for adding link directions to modal buttons
let banUser = (param) => {
  document.querySelector(
    "#banUser"
  ).href = `./php/ban-user.php?id_user=${param}`;
  document.querySelector(
    "#allowUser"
  ).href = `./php/allow-user.php?id_user=${param}`;
};

let banEvent = (param) => {
  document.querySelector(
    "#banEvent"
  ).href = `./php/ban-event.php?id_event=${param}`;
  document.querySelector(
    "#allowEvent"
  ).href = `./php/allow-event.php?id_event=${param}`;
};

let deleteEvent = (idEvent, idUser) => {
  document.querySelector("#deleteEventAdmin").value = `${idEvent}`;
  document.querySelector("#deleteEventUser").value = `${idUser}`;
};

let updateEvent = (
  eventID,
  eventName,
  eventOwner,
  eventDesc,
  eventLocation,
  eventDate,
  eventTime
) => {
  document.querySelector(".admin-event-id").value = eventID;
  document.querySelector(".admin-event-name").value = eventName;
  document.querySelector(".admin-event-owner").value = eventOwner;
  document.querySelector(".admin-event-desc").value = eventDesc;
  document.querySelector(".admin-event-location").value = eventLocation;
  document.querySelector(".admin-event-date").value = eventDate;
  document.querySelector(".admin-event-time").value = eventTime;
};
