var blr = document.getElementById("blur");
var nav = document.getElementById("navbarText");
var cat = document.getElementById("categoria");
var ric = document.getElementById("ricerca");
let resize_grow = window.matchMedia("(max-width: 991px)");
let colDx  = document.getElementById("colDx");

toggle_column(resize_grow);


function blurrare() {
    blr.classList.toggle("blurfilter");
    if (blr.classList.contains("blurfilter")) {
        nav.classList.add("show");
    } else {
        nav.classList.remove("show");
        cat.classList.remove("myShow");
        ric.classList.remove("myShow");
        document.getElementById("colSx").style.zIndex = "0";
    }
}
function viewCategoria() {
    ric.classList.remove("myShow");
    cat.classList.toggle("myShow");
    if (cat.classList.contains("myShow") || nav.classList.contains("show")) {
        blr.classList.add("blurfilter");
        document.getElementById("colSx").style.zIndex = "2";
    } else {
        blr.classList.remove("blurfilter");
        document.getElementById("colSx").style.zIndex = "0";
    }
}
function viewRicerca() {
    cat.classList.remove("myShow");
    ric.classList.toggle("myShow");
    if (ric.classList.contains("myShow") || nav.classList.contains("show")) {
        blr.classList.add("blurfilter");
        document.getElementById("colSx").style.zIndex = "2";
    } else {
        blr.classList.remove("blurfilter");
        document.getElementById("colSx").style.zIndex = "0";
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
        list_elm.innerHTML += ' <button type="button"onclick="openOtherUser('+list_users[user].id+')" class="list-group-item list-group-item-action">' + list_users[user].username + '</button>';
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

var resize = window.matchMedia("(min-width: 767px)");
resize.addEventListener("change", (e) => {
    if (e.matches && !(cat.classList.contains("myShow") || ric.classList.contains("myShow"))) {
        blr.classList.remove("blurfilter");
        nav.classList.remove("show");
    }
});

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
    axios.post("./api-profilo.php"
    ).then(response => {
        document.getElementById("labelIdentifyScreen").innerHTML = "PROFILO";
        document.getElementById("colMain").innerHTML = response.data;
    });
}

function showImpostazioni() {
    axios.post("./api-impostazioni.php"
    ).then(response => {
        document.getElementById("labelIdentifyScreen").innerHTML = "IMPOSTAZIONI";
        document.getElementById("colMain").innerHTML = response.data;
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

resize_grow.addEventListener("change", (e) =>{
    toggle_column(e);
});

function toggle_column(e){
    if (e.matches) {
        //colDx.classList.remove("d-none");
        //colDx.classList.add("col-hidden"); CSS
    }else{
        //colDx.classList.add("d-none");
        //colDx.classList.remove("col-hidden"); CSS
    }
}



function view_seguiti_follower(list) {
    let temp = Object.assign({},list);
    if (list) {
        var formData = new FormData();
        formData.append("list", JSON.stringify(temp));
        axios.post("./api-seguiti_follower.php" , formData 
        ).then(response => {
            /* console.log(response.data); */
            document.getElementById("colDx").innerHTML = response.data;
            var utn = document.getElementById("utenti");
            utn.classList.add("myShow");
            utn.style.zIndex= 3;
            //blr.classList.add("blurfilter");
        });
    }
}


function openOtherUser(user_id) {
    var formData = new FormData();
    formData.append("user_id", user_id);
    axios.post("./api-profilo_other_user.php", formData
    ).then(response => {
        document.getElementById("labelIdentifyScreen").innerHTML = "PROFILO";
        document.getElementById("colMain").innerHTML = response.data;
    });
}


function close_all_popup(){
    var utn;
    if(utn = document.getElementById("utenti")){
        utn.classList.remove("myShow");
        blr.classList.remove("blurfilter");
    }

    //blr.classList.remove("blurfilter");
    


}

function startFollow(user_id){
    //alert(user_id);
    var formData = new FormData();
    formData.append("user_id", user_id);
    axios.post("./api-start_follow.php", formData
    ).then(response => {
        document.getElementById("colMain").innerHTML = response.data;
    });
}


function deletePost(post_id){
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
    var jolly = document.getElementById("colDx");

    axios.post('./api-notifiche.php').then(response => {
        console.log(response);
        jolly.innerHTML = response.data;
    });
}





