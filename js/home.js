const main = document.getElementById("colMain");
var categoria = 1; //default categoria
var otherCall = false;
var post_finished = false;
const offset_end_page = window.innerHeight/2; //Per anticipare il caricamneto di nuvi post


function load_posts(cat_changed=false){
    otherCall=true;
    main.innerHTML += "<div class='container'> <div class='row justify-content-center'><div class='spinner-border' role='status'> <span class='sr-only'>Loading...</span> </div> </div> </div>";

    var formData = new FormData();
    formData.append("categoria", categoria);
    formData.append("cat_changed", cat_changed);
    axios.post('./api-feed.php', formData/*, numero post*/).then(response => {
        main.removeChild(main.lastChild);
        //console.log((response.data.length));
        //WARNING funziona solo se in post.php non ci sono caratteri prima e dopo il primo e l ultimo tag php
        if(response.data){
            main.innerHTML += response.data;
            post_finished = false;
        }else{
            post_finished = true;
            console.log("post finiti");
            main.innerHTML +="<div class='container'><div class='row justify-content-center'><p>Non ci sono nuovi post</p></div></div>" 
        }
        
        otherCall=false;
        check_NuoveNotifiche();
    });
    
}

//Cariamento iniziale
load_posts(); 


window.onscroll = function(ev) {
    if (((window.innerHeight + window.scrollY) >= (document.body.offsetHeight - offset_end_page)) && !otherCall && !post_finished) {
        load_posts();
    }
};


function openPost(post_id) {
    var type = window.matchMedia("(min-width: 991px)")

    if(type.matches){
        var col = document.getElementById("colDx");
    }else{
        var col = document.getElementById("colMain");
        otherCall=true;
    }

    const formData = new FormData();
    formData.append('post_id', post_id);

    axios.post('./api-post.php', formData).then(response => {
        //console.log(response.data);
        col.innerHTML = response.data;
    });
}

function cambiaCategoria(idCategoria){
    let btn = document.getElementById("btnCat"+idCategoria);
    let list = document.getElementById("list_categorie").children;

    for (const child of list) {
        child.classList.remove("active");
    }
    

    btn.classList.add("active");
    categoria = idCategoria;
    main.innerHTML="";
    load_posts(true);
    if(mobile.matches){
        btn_nav.click();
    }else if(tablet.matches){
        close_all_popup();
    }
}

function likePost(post_id) {
    const formData = new FormData();
    formData.append('post_id', post_id);

    axios.post('./api-like.php', formData).then(response => {
        document.querySelectorAll("button.btnLike_"+post_id).forEach(element => {
            element.innerHTML = '<i class="fa-solid fa-heart" style="font-size: 150%;"> '+response.data.count[0]["nMiPiace"]+' </i>';
            if(response.data.like == true){
                element.classList.add("btn-danger");
            }else{
                element.classList.remove("btn-danger");
            }
        });
        console.log(response.data.count[0]["nMiPiace"]);
    });
}
