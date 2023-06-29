

const fetchEventJSON = () => {
    fetch("http://localhost/web_programiranje_projekat/php/fetchData/fetch-event.php/", {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
        .then((response) => response.json())
        .then(response => {
            console.log(JSON.stringify(response, null, 2));
            let output = '';
            for(let i in response){
                output +=
                    `<div class="swiper-slide">
                   <a href="./eventPage.php?id=${response[i].event_id}">
                   <img src="${response[i].event_img}" alt=bck">
                   <h2>${response[i].event_title}</h2>
                  </a>
                   <p>${response[i].event_date}</p>
                   <p>${response[i].event_time}</p>
                   <p>${response[i].event_description}</p>  
               </div>`;

            }
            document.querySelector('.swiper-wrapper').innerHTML = output;
        }).catch(error => console.log(error));
};


const fetchUserJSON = () => {
    fetch("http://localhost/web_programiranje_projekat/php/fetchData/fetch-user.php/", {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
        .then((response) => response.json())
        .then(response => {
            console.log(response);
        }).catch(error => console.log(error));
};


const fetchUserEvents = () => {
        fetch("http://localhost/web_programiranje_projekat/php/fetchData/fetch-userEvent.php/", {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
        })
            .then((response) => response.json())
            .then(response => {
                console.log(response);
                let output = '';
                for(let i in response){
                    output +=
                        `<div class="user-event">
                        <div class="event-data">
                            <img src="${response[i].event_img}" alt="eventImg" />
                            <h2>${response[i].event_title}</h2>
                        </div>
                        <div class="event-options">
                            <button type="button" class="btn btn-primary">Send invitation</button>
                            <a class="btn btn-warning update-event" href="./php/update-event.php?event_id=${response[i].event_id}" role="button">Update Event</a>
                            <a class="btn btn-danger update-event" href="./php/delete-event.php?event_id=${response[i].event_id}" role="button">Delete Event</a>
                        </div>
                    </div>`;
                }

                document.querySelector('.events').innerHTML = output;
            }).catch(error => console.log(error));

}

const test = () => {
    fetch("http://localhost/web_programiranje_projekat/php/delete-event.php?event_id=138/", {
        method: 'GET',
        headers: {
            'Accept' : 'application/json',
        },
    }).then((response) => {
        console.log(response);
    });
}

