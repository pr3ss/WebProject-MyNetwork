const main = document.getElementById("colMain");
var categoria = 1; //default categoria
var otherCall = false;
var post_finished = false;


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
        }
        
        otherCall=false;
        check_NuoveNotifiche();
    });
    
}

//Cariamento iniziale
load_posts(); 

/*codice copiato è quello che fa jquery per compatibilita tra i browser */
//TODO verificare se usarlo al posto di document.body.offsetHeight
/*var body = document.body,
    html = document.documentElement;

var height = Math.max( body.scrollHeight, body.offsetHeight, 
                       html.clientHeight, html.scrollHeight, html.offsetHeight );*/

//console.log(height);

//TODO verificare se sia megglio fare addeventlistern e metodo onscroll
window.onscroll = function(ev) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && !otherCall && !post_finished) {
        //console.log("fine");  
        load_posts();
        
        /*var body = document.body,
            html = document.documentElement;

        var height = Math.max( body.scrollHeight, body.offsetHeight, 
                            html.clientHeight, html.scrollHeight, html.offsetHeight );*/

       // console.log(height + " - "+document.body.offsetHeight);
    }
};



function openPost(post_id) {
    var type = window.matchMedia("(min-width: 991px)")
    //se mobile view
    if(type.matches){
        var jolly = document.getElementById("colDx");
    }else{
        var jolly = document.getElementById("colMain");
        otherCall=true;
    }

    //se desktop view

    //var jolly = document.getElementById("colDx");

    const formData = new FormData();
    formData.append('post_id', post_id);

    axios.post('./api-post.php', formData).then(response => {
        //console.log(response.data);
        jolly.innerHTML = response.data;
    });
}


function cambiaCategoria(idCategoria){
    let btn = document.getElementById("btnCat"+idCategoria);
    let list = document.getElementById("list_categorie").children;

    for (const child of list) {
        //console.log(child);
        child.classList.remove("active");
    }
    

    btn.classList.add("active");
    categoria = idCategoria;
    main.innerHTML="";
    load_posts(true);
}

function likePost(post_id) {
    const formData = new FormData();
    formData.append('post_id', post_id);

    axios.post('./api-like.php', formData).then(response => {
        //console.log(response.data);
        document.querySelectorAll("button.btnLike_"+post_id).forEach(element => {
            element.innerHTML = '<i class="fa-solid fa-heart"> '+response.data+'</i>';
        });
    });
}
