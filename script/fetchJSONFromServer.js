
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
            //document.querySelector('.swiper-wrapper').innerHTML = output;
        }).catch(error => console.log(error));
};
