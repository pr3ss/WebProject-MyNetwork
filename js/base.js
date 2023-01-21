var blr = document.getElementById("blur");
var nav = document.getElementById("navbarText");
var cat = document.getElementById("categoria");
var ric = document.getElementById("ricerca");
let btn_nav = document.getElementById("btn_nav");
let desktop = window.matchMedia("(min-width: 991px)");
let colDx = document.getElementById("colDx");
let colMain = document.getElementById("colMain");
var tablet = window.matchMedia("(min-width: 767px)");
let tablet2 = window.matchMedia("(max-width: 991px)");
var mobile = window.matchMedia("(max-width: 767px)");

check_NuoveNotifiche();

open_nav = false;
function open_menu() {
    if (true ) {
        open_nav = !open_nav;

        if (open_nav) {
            blr.classList.add("blurfilter");
        } else {
            close_all_popup();
        }
    }
}

function close_menu() {
    if (open_nav) {
        console.log("chi");
        btn_nav.click();
    } else {
        open_nav = true;
        open_menu();
    }

}

function close_all_popup() {
    ric.classList.remove("myShow");
    cat.classList.remove("myShow");
    var utn;
    if (utn = document.getElementById("utenti")) {
        utn.classList.remove("myShow");
        //blr.classList.remove("blurfilter");
    }

    blr.classList.remove("blurfilter");
}

function tablet_all_popup_close(mediaQ){
    if(mediaQ.matches){
        close_all_popup();
    }
}

//Media query event
mobile.addEventListener("change", (e)=>{
    if(e.matches){
        if(open_nav){
            btn_nav.click();
        }else{
            close_all_popup();
        }
    }
})

tablet.addEventListener("change", (e) => {
    tablet_all_popup_close(e);
});

tablet2.addEventListener("change", (e) => {
    tablet_all_popup_close(e);
});

desktop.addEventListener("change", (e)=>{
    if(e.matches){
        var elm;
        if(elm = document.getElementById("post_singolo")){
            colDx.innerHTML="";
            colDx.appendChild(elm);
            colMain.innerHTML="";
            load_posts(true); //True per fare in modo di ricaricare dal post piu recente
            //console.log("desktop si");
        }else if(elm = document.getElementById("notifiche")){
            colDx.innerHTML="";
            colDx.appendChild(elm);
            colMain.innerHTML="";
            load_posts(true); //True per fare in modo di ricaricare dal post piu recente
            //console.log("desktop si");
        }
    }
})



function viewCategoria() {
    if (tablet.matches) {
        if(cat.classList.contains("myShow")){
            close_all_popup(); //non metterlo fuori dal if
        }else{
            close_all_popup();
            blr.classList.add("blurfilter");
            cat.classList.add("myShow");
        }
        
    }else{
        close_all_popup();
        blr.classList.add("blurfilter");
        cat.classList.add("myShow");
    }
}

function viewRicerca() {
    if (tablet.matches) {
        
        if(ric.classList.contains("myShow")){
            close_all_popup();
        }else{
            close_all_popup();
            blr.classList.add("blurfilter");
            ric.classList.add("myShow");
        }
        
    }else{
        close_all_popup();
        blr.classList.add("blurfilter");
        ric.classList.add("myShow");
    }
}

//TODO risolvere background color spinner in desktop non serve ma in mobile altrimenti non si vede oppure in mobile cambiare il colore dello spinner oppure é un problema di z-index in mobile  */

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
        list_elm.innerHTML += ' <button type="button"onclick="openOtherUser(' + list_users[user].id + ')" class="list-group-item list-group-item-action">' + list_users[user].username + '</button>';
    }

}

function addPost() {
    axios.post('./api-add_post.php').then(response => {
        //console.log(response.data);
        main.innerHTML = response.data;
    });
}

var file;
function add_image() {
    var input = document.createElement('input');
    input.type = 'file';

    input.onchange = e => {
        file = e.target.files[0];
        document.getElementById("tmp_img").innerHTML = "<div class='container-fluid'><img class='card-img-top p-2' id='myImg' src='" + URL.createObjectURL(new Blob([file])) + "'></div>";
    }

    input.click();
}

function upload_post() {
    let testo = document.getElementById("tmp_post_text").value;
    let luogo = document.getElementById("tmp_post_luogo").value;
    let cat = document.getElementById("tmp_post_cat").value;
    if (file || testo) {
        var formData = new FormData();
        formData.append("file", file);
        formData.append("testo", testo);
        formData.append("luogo", luogo);
        formData.append("categoria", cat);
        axios.post("./api-add_post.php", formData
        ).then(response => {
            console.log(response.data);
            alert(response.data);
            //TODO gestire errori estensione dimensione .....
        });
    } else {
        console.log("Inserire testo e/o immagine");
        alert("Inserire testo e/o immagine");
    }

    file = null;
    document.getElementById("tmp_img").innerHTML = "<button class='btn' style='font-size: 300%;' onclick='add_image()'><i class='fa-solid fa-circle-plus'></i></button>";
}



//TODO rivedere reload post commenti
function addComment(postId) {
    let text = document.getElementById("textComment").value;
    console.log(postId);
    if (text && postId) {
        var formData = new FormData();
        formData.append("testo", text);
        formData.append("postId", postId);
        axios.post("./api-add_comment.php", formData
        ).then(response => {
            console.log(response.data);
            //alert(response.data);
            if (response.data) {
                openPost(postId);
            }
        });
    } else {
        console.log("Inserire testo");
        alert("Inserire testo");
    }
}

function showProfilo() {
    window.onscroll=null; //TODO vedere se aggiungere anche qui il caricamento dinamico/ottimizzato dei post
    axios.post("./api-profilo.php"
    ).then(response => {
        document.getElementById("labelIdentifyScreen").innerHTML = "PROFILO";
        document.getElementById("colMain").innerHTML = response.data;
        if(mobile.matches){ btn_nav.click();} //Per chiudere il menu
    });
}

function showImpostazioni() {
    window.onscroll=null; //TODO verificare sia necessario
    axios.post("./api-impostazioni.php"
    ).then(response => {
        document.getElementById("labelIdentifyScreen").innerHTML = "IMPOSTAZIONI";
        document.getElementById("colMain").innerHTML = response.data;
        if(mobile.matches){ btn_nav.click();} //Per chiudere il menu
    });
}





//Impostazioni.php
var temp_foto_profilo;
function cambia_foto_profilo() {
    var input = document.createElement('input');
    input.type = 'file';

    input.onchange = e => {
        temp_foto_profilo = e.target.files[0];
        document.getElementById("foto_profilo").src = URL.createObjectURL(new Blob([temp_foto_profilo]));
    }

    input.click();
}

function salva_info() {
    let new_info = {};

    temp_foto_profilo; // se non é stata cambiata prende nul;
    new_info["username"] = document.getElementById("my_username").value;
    new_info["email"] = document.getElementById("email").value;
    let psw = document.querySelector("#password").value;
    console.log(psw);

    if (psw && !checkPasswordSecurity(psw)) {
        alert("password non valida");

    } else {
        if (psw) {
            new_info["password"] = hex_sha512(psw);
        }

        console.log(JSON.stringify(new_info));
        var formData = new FormData();
        formData.append("new_info", JSON.stringify(new_info));
        formData.append("foto_profilo", temp_foto_profilo);
        axios.post("./api-impostazioni.php", formData
        ).then(response => {
            console.log(response.data);
            alert(response.data);

        });

    }
    temp_foto_profilo = null;
}

//Ridondante da signin.js
/* TODO aggiungere ricerca maiuscola e carattere speciale oltre che alla lunghezza */
function checkPasswordSecurity(password) {
    return password.length >= 8;
}


function view_seguiti_follower(list) {
    let obj_list = {...list}; //Object.assign({}, list);
    if (list) {
        var formData = new FormData();
        formData.append("list", JSON.stringify(obj_list));
        axios.post("./api-seguiti_follower.php", formData
        ).then(response => {
            /* console.log(response.data); */
            document.getElementById("colDx").innerHTML = response.data;
            var utn = document.getElementById("utenti");
            utn.classList.add("myShow");
            if (!desktop.matches) {
                blr.classList.add("blurfilter");
            }
        });
    }
}



function openOtherUser(user_id) {
    window.onscroll=null; //TODO vedere se aggiungere anche qui il caricamento dinamico/ottimizzato dei post
    var formData = new FormData();
    formData.append("user_id", user_id);
    axios.post("./api-profilo_other_user.php", formData
    ).then(response => {
        document.getElementById("labelIdentifyScreen").innerHTML = "PROFILO";
        document.getElementById("colMain").innerHTML = response.data;
    });
}




function startFollow(user_id) {
    //alert(user_id);
    var formData = new FormData();
    formData.append("user_id", user_id);
    axios.post("./api-start_follow.php", formData
    ).then(response => {
        document.getElementById("colMain").innerHTML = response.data;
    });
}


function deletePost(post_id) {
    //alert(post_id);
    var formData = new FormData();
    formData.append("post_id", post_id);
    axios.post("./api-delete_post.php", formData
    ).then(response => {
        document.getElementById("colMain").innerHTML = response.data;
    });
}

function viewNotifiche() {
    //se mobile view
    //window.location.href = "notifiche.html"; oppure mettere il caricameno dinamico nel main invece che alla colonna
    //TODO mettere il caricamento dinamico;
    //se desktop view

    if(desktop.matches){
        var jolly = document.getElementById("colDx");
    }else{
        var jolly = document.getElementById("colMain");
        otherCall=true;
    }

    axios.post('./api-notifiche.php').then(response => {
        console.log(response);
        jolly.innerHTML = response.data;
        close_menu();
    });
}

function notificaVista(notifica_id){
    var formData = new FormData();
    formData.append("notifica_id", notifica_id);
    axios.post("./api-notifica_vista.php", formData
    ).then(response => {
        console.log(response.data);
    });
    check_NuoveNotifiche();
}

function check_NuoveNotifiche(){
    axios.post("./api-check_notifiche.php"
    ).then(response => {
        console.log(response.data);
        if(response.data!=0){
            document.getElementById("num_notifiche").style.display ="inline";
            document.getElementById("num_notifiche").innerHTML = response.data;
        }else{
            document.getElementById("num_notifiche").style.display ="none";
        }
        
    });
}




