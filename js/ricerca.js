//TODO risolvere background color spinner in desktop non serve ma in mobile altrimenti non si vede oppure in mobile cambiare il colore dello spinner oppure é un problema di z-index in mobile  */

//Ricerca users
function ricerca_user() {
    var user = document.getElementById("input_search_user").value;
    if (!user) {
        document.getElementById("list_searched_users").innerHTML = "";
        return;
    }

    document.getElementById("list_searched_users").innerHTML = "<div class='d-flex justify-content-center pt-4 bg-white'><div class='spinner-border' role='status'> <span class='sr-only'>Loading...</span> </div></div>";

    const formData = new FormData();
    formData.append('username_to_search', user);

    axios.post('api-ricerca.php', formData).then(response => {
        fill_list_user(response.data["list_username"]);
    });
}

function fill_list_user(list_users) {
    const list_elm = document.getElementById("list_searched_users");
    list_elm.innerHTML = "";
    for (let user in list_users) {
        list_elm.innerHTML += ' <button type="button"onclick="openOtherUser(' + list_users[user].id + ')" class="list-group-item list-group-item-action">' + list_users[user].username + '</button>';
    }

}