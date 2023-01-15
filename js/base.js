var blr = document.getElementById("blur");
var nav = document.getElementById("navbarText");
var cat = document.getElementById("categoria");
var ric = document.getElementById("ricerca");
function blurrare() {
    blr.classList.toggle("blurfilter");
    document.getElementById("colSx").style.zIndex="2";
    if(blr.classList.contains("blurfilter")){
        nav.classList.add("show");
    } else {
        nav.classList.remove("show");
        cat.classList.remove("myShow");
        ric.classList.remove("myShow");
        document.getElementById("colSx").style.zIndex="0";
    }
}
function viewCategoria() {
    ric.classList.remove("myShow");
    cat.classList.toggle("myShow");
    if (cat.classList.contains("myShow") || nav.classList.contains("show")) {
        blr.classList.add("blurfilter");
        document.getElementById("colSx").style.zIndex="2";
    } else {
        blr.classList.remove("blurfilter");
        document.getElementById("colSx").style.zIndex="0";
    }
}
function viewRicerca() {
    cat.classList.remove("myShow");
    ric.classList.toggle("myShow");
    if (ric.classList.contains("myShow") || nav.classList.contains("show")) {
        blr.classList.add("blurfilter");
        document.getElementById("colSx").style.zIndex="2";
    } else {
        blr.classList.remove("blurfilter");
        document.getElementById("colSx").style.zIndex="0";
    }
}

function viewNotifiche() {
    //se mobile view
    //window.location.href = "notifiche.html"; oppure mettere il caricameno dinamico nel main invece che alla colonna

    //se desktop view
    var jolly = document.getElementById("colDx");


    axios.get('./notifiche.html').then(response => {
        console.log(response);
        jolly.innerHTML = response.data;
    });
}

/*/
    /* TODO risolvere background color spinner in desktop non serve ma in mobile altrimenti non si vede oppure in mobile cambiare il colore dello spinner oppure é un problema di z-index in mobile 
    /*/

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

//TODO add referal to user page.
function fill_list_user(list_users) {
    const list_elm = document.getElementById("list_searched_users");
    list_elm.innerHTML = "";
    for (let user in list_users) {
        list_elm.innerHTML += ' <button type="button" class="list-group-item list-group-item-action">' + list_users[user].username + '</button>';
    }

}