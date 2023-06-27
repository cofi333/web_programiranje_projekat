<<<<<<< HEAD

       fetch("http://localhost/web_programiranje_projekat/php/fetch-from-server.php/", {
           method: 'GET',
           headers: {
               'Accept': 'application/json',
           },
       })
           .then((response) => response.json())
           .then(response => {
               console.log(JSON.stringify(response, null, 2));
               let output = '';
               for (let i in response) {
                   let path = response[i].event_img;
                   output += `<div class="swiper-slide">
                    <img src="${path}" alt=bck">
                    <h1>${response[i].event_title}</h1>
                </div>`;

               }

               document.querySelector('.swiper-wrapper').innerHTML = output;
           })
           .catch(error => console.log(error));

=======
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
>>>>>>> b9542941d4410360852301fe56a2d15959f17320

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
