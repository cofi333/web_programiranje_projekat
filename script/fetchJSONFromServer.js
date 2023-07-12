const fetchEventJSON = async () => {
    try{
        const res = await fetch("http://localhost/web_programiranje_projekat/php/fetchData/fetch-event.php/", {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
        });
        const data = await res.json();
        let output = '';
        console.log(data);
        for(let i in data){
            output +=
                `<div class="swiper-slide">
                   <a href="./eventPage.php?id=${data[i].event_id}">
                   <img src="${data[i].event_img}" alt=bck">
                   <h2>${data[i].event_title}</h2>
                  </a>
                   <p>${data[i].event_date}</p>
                   <p>${data[i].event_time}</p>
                   <p>${data[i].event_description}</p>
               </div>`;
        }
        document.querySelector('.swiper-wrapper').innerHTML = output;
    }catch (e){
        console.log("Error in fetching data", e);
    }
};

const fetchUserJSON = async ()=> {
    try{
        const res= await fetch("http://localhost/web_programiranje_projekat/php/fetchData/fetch-user.php/", {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
        });
        const data = await res.json();
        let output = '';
        for(let i in data){
            output +=
                `<p>Username: ${data[i].email}</p>
                 <p>Name: ${data[i].firstname }</p>
                 <p>Date created: ${data[i].date_time}</p>`;
        }
        document.getElementById('user-info').innerHTML = output;
    }catch (e){
        console.log("Error in fetching data", e);
    }
};

const fetchUserEvents = async () => {
    try{
        const res = await fetch("http://localhost/web_programiranje_projekat/php/fetchData/fetch-userEvent.php/", {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
        });

        const data = await res.json();
        let output = '';
        let bannedEvents = [];
       // console.log(data);


        for(let i in data) {
            bannedEvents[i] = data[i].is_banned;
            output +=
                `<div class="usr-ev">   
                        <div class="event-data">                           
                            <img src="${data[i].event_img}" alt="eventImg" />
                            <h4 id="statusMessage">${data[i].event_title}</h4>
                        </div>

                        <div class="event-options">   
                            <a id="sendInv" href="./php/send-invitation.php?event_id=${data[i].event_id}" class="btn btn-primary">Invitations</a>
                            <a id="updateEv" class="btn btn-warning update-event" href="./php/update-event.php?event_id=${data[i].event_id}" role="button">Update Event</a>
                            <a id="delButton" class="btn btn-danger" onclick="putID(${data[i].event_id})" role="button" data-bs-toggle="modal" data-bs-target="#deleteEventModal">Delete event</a>                                                       
                        </div>
                </div>`;
        }

        document.querySelector('.created-by-user').innerHTML = output;
        return bannedEvents;
    } catch (e){
        console.log("Error in fetching data", e);
    }
};


const fetchComments = async () => {
    try {
        const res = await fetch("http://localhost/web_programiranje_projekat/php/fetchData/fetch-comments.php", {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
        });

        const data = await res.json();
        let output = '';
        for (let i in data) {
            output += `
                 <div class="swiper-slide">
                    <div class="comment">
                        <div class="user">
                            <i class="fa-regular fa-user"></i>
                            <h2>${data[i].guest_name}</h2>
                        </div>
                        <p>${data[i].comment}</p>
                    </div>
                </div>
            `;

            document.querySelector('.swiper-wrapper').innerHTML = output;
        }
    } catch (e) {
        console.log("Error in fetching data", e);
    }

}

const fetchMessages = async () => {
    try{
        const res = await fetch("http://localhost/web_programiranje_projekat/php/fetchData/fetch-userMessages.php", {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
        });

        const data = await res.json();
    } catch (e){
        console.log("Error in fetching data", e);
    }
}


//function to insert path to script with ID of event, into button of modal
let putID = (paramID) => {
    document.querySelector('#delete-btn').href= `php/delete-event.php?event_id=${paramID}`;
}


//fetch events and check if its disabled
let fetchUserEventsAndCheck = async () => {
    let res = await fetchUserEvents();
    //console.log(res);

    let sendInvBtn = document.querySelector('#sendInv');
    let updateEvBtn = document.querySelector('#updateEv');
    let statMsg = document.querySelector('#statusMessage');

    for(let i in res) {
        if(res[i] === 1) {
            sendInvBtn.classList.add("disabled");
            updateEvBtn.classList.add("disabled");
            statMsg.innerHTML = 'Event banned';
        }
    }
}

let fetchGifts = async () => {
    try {
        const res = await fetch("http://localhost/web_programiranje_projekat/php/fetchData/fetch-gifts.php", {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
        });

        const data = await res.json();
        let output = '';
        let number=1;

        for (let i in data) {
            output += `
            <tr>
                            <th scope="row"> ${number}</th>
                            <td>${data[i].wish_gift_name}</td>
                            <td><a href="${data[i].wish_gift_link}" target="_blank">Link of product</a></td>
                            <td><a class="btn btn-warning" onclick="getGiftData('${data[i].wish_gift_name}', '${data[i].wish_gift_link}', ${data[i].wish_id}, ${data[i].event_id})" data-bs-toggle="modal" data-bs-target="#update-gift-modal">Update gift</a>
                            <a class="btn btn-danger" onclick="getGiftId(${data[i].wish_id}, ${data[i].event_id})" role="button" data-bs-toggle="modal" data-bs-target="#delete-gift-modal">Delete gift</a>
                            </td>
                    </tr>
            `;

            document.querySelector('.wish-table').innerHTML = output;
            number++;
        }
    } catch (e) {
        console.log("Error in fetching data", e);
    }
}



let getGiftId = (wish_id, event_id) => {
    let deleteBtn = document.getElementById("delete-gift");
    deleteBtn.href = "./delete-gift.php?wish_id=" + wish_id + "&event_id=" + event_id;

}

let getGiftData = (name, link, wish_id, event_id) => {

    let input_name = document.getElementById("gift-new-name");
    let input_link = document.getElementById("gift-new-link");
    let input_wish_id = document.getElementById("input-wish-id");
    let input_event_id = document.getElementById("input-event-id");
    input_name.value = name;
    input_link.value = link;
    input_wish_id.value = wish_id;
    input_event_id.value = event_id;
}

