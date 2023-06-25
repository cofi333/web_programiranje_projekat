fetch("http://localhost/web_programiranje_projekat/php/fetch-from-server.php").then((res) => res.json()).then(response => {
    console.log(response);
}).catch(error => console.log(error));