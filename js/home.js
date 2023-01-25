const main = document.getElementById("colMain");
let categoria = 1; //default categoria
let otherCall = false;
let post_finished = false;
const offset_end_page = window.innerHeight/2; //Per anticipare il caricamneto di nuvi post


function load_posts(cat_changed=false){
    otherCall=true;
    main.innerHTML += "<div class='container'> <div class='row justify-content-center'><div class='spinner-border' role='status'> <span class='sr-only'>Loading...</span> </div> </div> </div>";

    const formData = new FormData();
    formData.append("categoria", categoria);
    formData.append("cat_changed", cat_changed);
    axios.post('./api-feed.php', formData).then(response => {
        main.removeChild(main.lastChild);
        if(response.data){
            main.innerHTML += response.data;
            post_finished = false;
        }else{
            post_finished = true;
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
    window.onscroll = null;
    const formData = new FormData();
    formData.append('post_id', post_id);

    axios.post('./api-post.php', formData).then(response => {
        main.innerHTML = response.data;
    });
}

function cambiaCategoria(idCategoria){
    const btn = document.getElementById("btnCat"+idCategoria);
    const list = document.getElementById("list_categorie").children;

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
            element.innerHTML = '<em class="fa-solid fa-heart" style="font-size: 150%;"></em>'+response.data.count[0]["nMiPiace"];
            if(response.data.like == true){
                element.classList.add("btn-like");
            }else{
                element.classList.remove("btn-like");
            }
        });
    });
}
