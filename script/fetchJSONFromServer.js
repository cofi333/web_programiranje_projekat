let delete_btn= document.getElementById("delete-btn");
let eventID = [];

let flag = 0;

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

let path="./php/delete-event.php?event_id=";
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
        console.log(data);


        for(let i in data){
            output +=
                `<div class="usr-ev">   
                        <div class="event-data">                           
                            <img src="${data[i].event_img}" alt="eventImg" />
                            <h4>${data[i].event_title}</h4>
                        </div>
                        <div class="event-options">
                           
                            <a href="./php/wish-list.php?event_id=${data[i].event_id}" class="btn btn-primary">Wish list</a>
                            <a href="./php/send-invitation.php?event_id=${data[i].event_id}" class="btn btn-primary">Invitations</a>
                            <a class="btn btn-warning update-event" href="./php/update-event.php?event_id=${data[i].event_id}" role="button">Update Event</a>
                            <a id="delButton" class="btn btn-danger" onclick="putID(${data[i].event_id})" role="button" data-bs-toggle="modal" data-bs-target="#deleteEventModal">Delete event</a>                                                       
                        </div>
                </div>`;
        }

        document.querySelector('.created-by-user').innerHTML = output;
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


//function to insert path to script with ID of event, into button of modal
let putID = (paramID) => {
    document.querySelector('#delete-btn').href= `./php/delete-event.php?event_id=${paramID}`;
}

