var blr = document.getElementById("blur");
var nav = document.getElementById("navbarText");
var cat = document.getElementById("categoria");
var ric = document.getElementById("ricerca");
function blurrare() {
    blr.classList.toggle("blurfilter");
    document.getElementById("colSx").style.zIndex = "2";
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

function viewNotifiche() {
    //se mobile view
    //window.location.href = "notifiche.html"; oppure mettere il caricameno dinamico nel main invece che alla colonna

    //se desktop view
    var jolly = document.getElementById("colDx");


    axios.get('./template/notifiche.php').then(response => {
        console.log(response);
        jolly.innerHTML = response.data;
    });
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
        list_elm.innerHTML += ' <button type="button" class="list-group-item list-group-item-action">' + list_users[user].username + '</button>';
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
function addComment(postId){
    let text = document.getElementById("textComment").value;
    console.log(postId);
    if (text && postId) {
        var formData = new FormData();
        formData.append("testo", text);
        formData.append("postId", postId);
        axios.post("./api-add_comment.php", formData
        ).then(response => {
            console.log(response.data);
            alert(response.data);
            if(response.data){
                openPost(postId);
            }
        });
    } else {
        console.log("Inserire testo");
        alert("Inserire testo");
    }
}

function showProfilo(){
    axios.post("./api-profilo.php"
    ).then(response => {
        document.getElementById("labelIdentifyScreen").innerHTML = "PROFILO";
        document.getElementById("colMain").innerHTML = response.data;
    });
}

function showImpostazioni(){
    axios.post("./api-impostazioni.php"
    ).then(response => {
        document.getElementById("labelIdentifyScreen").innerHTML = "IMPOSTAZIONI";
        document.getElementById("colMain").innerHTML = response.data;
    });
}










