const fetchUsers = async() => {
    try{
        const response = await fetch("http://localhost/web_programiranje_projekat/admin/php/fetch-all-users.php/", {
            method: 'GET',
            headers:{
                'Accept': 'application/json',
            },
        });
           const data = await response.json();
           console.log(data);
           let users = '';
           for(let user in data) {
               users += `<div class="user-data">
                            <h4>User ID: ${data[user].id_user}</h4>
                            <p class="usr-name">Username: ${data[user].email}</p>
                            <p class="usr-active">Active status: ${data[user].active}</p>
                            <p class="usr-ban">Ban status: ${data[user].is_banned}</p>
                            <p class="usr-date">Date created: ${data[user].date_time}</p>
                          </div>`;
           }


        document.querySelector('.admin-v-users').innerHTML = users;
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
        const data = await response.json();
        console.log(data);
        let events = '';
        for(let event in data) {

        }
    }catch (e){
        console.log("Fetch error" + e);
    }
}

const fetchAdminInfo = async () => {
    try{
        const response = await fetch("http://localhost/web_programiranje_projekat/admin/php/fetch-Admin-info.php/" , {
            method: 'GET',
            headers:{
                'Accept': 'application/json',
            },
        });
        const data = await response.json();
        console.log(data);
    }catch (e){
        console.log("Fetch error" + e);
    }
}