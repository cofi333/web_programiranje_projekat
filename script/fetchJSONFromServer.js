let fetchEventCard = () => {
    fetch("http://localhost/web_programiranje_projekat/php/fetch-from-server.php/", {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
        .then((response) => response.json())
        .then(response => console.log(response))
        .catch(error => console.log(error));
}
