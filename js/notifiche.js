//Gestione notifiche
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
        if(response.data.nNotifiche && response.data.nNotifiche!=0){
            document.getElementById("num_notifiche").style.display ="inline";
            document.getElementById("num_notifiche").innerHTML = response.data.nNotifiche;
        }else{
            document.getElementById("num_notifiche").style.display ="none";
        }
        
    });
}