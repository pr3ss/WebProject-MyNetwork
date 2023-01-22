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

//Gestione menu e menu-popup
open_nav = false;
function open_menu() {
    if (true ) {
        open_nav = !open_nav;

        if (open_nav) {
            blr.classList.add("blurfilter");
            colMain.style.filter = "blur(4px)";
        } else {
            close_all_popup();
            colMain.style.filter = "blur(0px)";
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
    colMain.style.filter = "blur(0px)";
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
        close_all_popup();
        var elm;
        if(elm = document.getElementById("notifiche")){
            colDx.innerHTML="";
            colDx.appendChild(elm);
            colMain.innerHTML="";
            load_posts(true); //True per fare in modo di ricaricare dal post piu recente
        }
    }else{
        colDx.innerHTML="";
    }
})


//Elementi del menu
function viewCategoria() {
    if (tablet.matches) {
        if(cat.classList.contains("myShow")){
            close_all_popup(); //non metterlo fuori dal if
        }else{
            close_all_popup();
            blr.classList.add("blurfilter");
            cat.classList.add("myShow");
            colMain.style.filter = "blur(4px)";
        }
        
    }else{
        close_all_popup();
        blr.classList.add("blurfilter");
        cat.classList.add("myShow");
        colMain.style.filter = "blur(4px)";
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
            colMain.style.filter = "blur(4px)";
        }
        
    }else{
        close_all_popup();
        blr.classList.add("blurfilter");
        ric.classList.add("myShow");
        colMain.style.filter = "blur(4px)";
    }
}

function viewNotifiche() {
    //se mobile view
    //window.location.href = "notifiche.html"; oppure mettere il caricameno dinamico nel main invece che alla colonna
    //TODO mettere il caricamento dinamico;
    //se desktop view

    if(desktop.matches){
        var jolly = document.getElementById("colDx");
    }else{
        window.onscroll=null;
        var jolly = document.getElementById("colMain");
        otherCall=true;
    }

    axios.post('./api-notifiche.php').then(response => {
        console.log(response);
        jolly.innerHTML = response.data;
        close_menu();
    });
}

function showProfilo() {
    window.onscroll=null;
    axios.post("./api-profilo.php"
    ).then(response => {
        document.getElementById("labelIdentifyScreen").innerHTML = "ACCOUNT";
        document.getElementById("colMain").innerHTML = response.data;
        if(mobile.matches){ btn_nav.click();} //Per chiudere il menu
    });
}

function showImpostazioni() {
    window.onscroll=null;
    axios.post("./api-impostazioni.php"
    ).then(response => {
        document.getElementById("labelIdentifyScreen").innerHTML = "SETTING";
        document.getElementById("colMain").innerHTML = response.data;
        if(mobile.matches){ btn_nav.click();} //Per chiudere il menu
    });
}

function addPost() {
    window.onscroll=null;
    axios.post('./api-add_post.php').then(response => {
        //console.log(response.data);
        main.innerHTML = response.data;
    });
}








