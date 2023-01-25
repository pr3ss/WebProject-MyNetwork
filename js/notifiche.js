//Gestione notifiche
function notificaVista(notifica_id){
    const formData = new FormData();
    formData.append("notifica_id", notifica_id);
    axios.post("./api-notifica_vista.php", formData
    ).then(response => {
        if(response.data){
            document.getElementById("not_"+notifica_id).classList.remove("bg-NuovaNotifica");
        }
    });
    check_NuoveNotifiche();
}

function check_NuoveNotifiche(){
    axios.post("./api-check_notifiche.php"
    ).then(response => {
        if(response.data.nNotifiche && response.data.nNotifiche!=0){
            document.getElementById("num_notifiche").style.display ="inline";
            document.getElementById("num_notifiche").innerHTML = response.data.nNotifiche;
        }else{
            document.getElementById("num_notifiche").style.display ="none";
        }
    });
}

if(mobile.matches){
    document.getElementById("icon_notifiche_mobile").innerHTML = "<span id='num_notifiche' class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger'></span>";
    document.getElementById("icon_notifiche_desktop").innerHTML = "";
}