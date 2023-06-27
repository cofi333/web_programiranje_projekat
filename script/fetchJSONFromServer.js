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
            for(let i in response){
                let path = response[i].event_img;
                output += `<div class="swiper-slide">
                    
                    <img src="${path}" alt=bck">
                </div>`;

            }

            document.querySelector('.swiper-wrapper').innerHTML = output;
        })
        .catch(error => console.log(error));

