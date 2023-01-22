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
        console.log(response.data);
        if(response.data!=0){
            document.getElementById("num_notifiche").style.display ="inline";
            document.getElementById("num_notifiche").innerHTML = response.data;
        }else{
            document.getElementById("num_notifiche").style.display ="none";
        }
        
    });
}