const fetchUsers = async() => {
    try{
        const response = await fetch("http://localhost/web_programiranje_projekat/admin/php/fetch-all-users.php/", {
            method: 'GET',
            headers:{
                'Accept': 'application/json',
            },
        });
           const data = response.json();
           console.log(data);
    } catch (e){
        console.log("Fetch error" + e);
    }
}

const fetchEvents = async() => {
    try{
        const response = await fetch("http://localhost/web_programiranje_projekat/admin/php/fetch-all-events.php/" , {
            method: 'GET',
            headers:{
                'Accept': 'application/json',
            },
        });
        const data = response.json();
        console.log(data);
    }catch (e){
        console.log("Fetch error" + e);
    }
}