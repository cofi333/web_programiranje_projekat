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
        console.log(data);

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
        for(let i in data){
            output +=
                `<div class="user-event">
                        <div class="event-data">
                            <img src="${data[i].event_img}" alt="eventImg" />
                            <h2>${data[i].event_title}</h2>
                        </div>
                        <div class="event-options">

                            <a href="./php/send-invitation.php?event_id=${data[i].event_id}" class="btn btn-primary">Send invitation</a>
                            <a class="btn btn-warning update-event" href="./php/update-event.php?event_id=${data[i].event_id}" role="button">Update Event</a>
                            <a class="btn btn-danger" id="delete-btn" href="./php/delete-event.php?event_id=${data[i].event_id}" role="button">Delete Event</a>

                        </div>
                    </div>`;
        }
        document.querySelector('.events').innerHTML = output;
    }catch (e){
        console.log("Error in fetching data", e);
    }
};



