const nav = document.getElementById("navbarText");
const cat = document.getElementById("categoria");
const blr = document.getElementById("blur");
const ric = document.getElementById("ricerca");
const btn_nav = document.getElementById("btn_nav");
const desktop = window.matchMedia("(min-width: 991px)");
const colDx = document.getElementById("colDx");
const colMain = document.getElementById("colMain");
const tablet = window.matchMedia("(min-width: 767px)");
const tablet2 = window.matchMedia("(max-width: 991px)");
const mobile = window.matchMedia("(max-width: 767px)");

function home(){
    window.location.replace("home.php");
}
function logout(){
    window.location.replace("logout.php");
}

//Gestione menu e menu-popup
let open_nav = false;
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
        btn_nav.click();
    } else {
        open_nav = true;
        open_menu();
    }

}

function close_all_popup() {
    ric.classList.remove("myShow");
    cat.classList.remove("myShow");
    let utn;
    if (utn = document.getElementById("utenti")) {
        utn.classList.remove("myShow");
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
        document.getElementById("icon_notifiche_mobile").innerHTML = "<span id='num_notifiche' class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger'></span>";
        document.getElementById("icon_notifiche_desktop").innerHTML = "";
        if(open_nav){
            btn_nav.click();
        }else{
            close_all_popup();
        }
    }else{
        document.getElementById("icon_notifiche_desktop").innerHTML = "<span id='num_notifiche' class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger'></span>";
        document.getElementById("icon_notifiche_mobile").innerHTML = "";
    }
    check_NuoveNotifiche();
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
        let elm;
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
            close_all_popup(); 
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
    let col_view;
    if(desktop.matches){
        col_view = document.getElementById("colDx");
    }else{
        window.onscroll=null;
        col_view = document.getElementById("colMain");
        otherCall=true;
    }

    axios.post('./api-notifiche.php').then(response => {
        col_view.innerHTML = response.data;
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
        if(mobile.matches && open_nav){
            btn_nav.click();
        }
        main.innerHTML = response.data;
    });
}








