function view_seguiti_follower(list) {
    let obj_list = {...list}; //Object.assign({}, list);
    if (list) {
        var formData = new FormData();
        formData.append("list", JSON.stringify(obj_list));
        axios.post("./api-seguiti_follower.php", formData
        ).then(response => {
            /* console.log(response.data); */
            document.getElementById("colDx").innerHTML = response.data;
            var utn = document.getElementById("utenti");
            utn.classList.add("myShow");
            if (!desktop.matches) {
                blr.classList.add("blurfilter");
                colMain.style.filter = "blur(4px)";
            }
        });
    }
}

function openOtherUser(user_id) {
    window.onscroll=null; //TODO vedere se aggiungere anche qui il caricamento dinamico/ottimizzato dei post
    var formData = new FormData();
    formData.append("user_id", user_id);
    axios.post("./api-profilo_other_user.php", formData
    ).then(response => {
        document.getElementById("labelIdentifyScreen").innerHTML = "ACCOUNT";
        document.getElementById("colMain").innerHTML = response.data;
        if(mobile.matches){
            if(open_nav){
                btn_nav.click();
            }else{
                close_all_popup();
            }
            
        }else if(tablet.matches){
            close_all_popup();
        }
    });
}

function startFollow(user_id) {
    //alert(user_id);
    var formData = new FormData();
    formData.append("user_id", user_id);
    axios.post("./api-start_follow.php", formData
    ).then(response => {
        document.getElementById("colMain").innerHTML = response.data;
    });
}

function deletePost(post_id) {
    //alert(post_id);
    var formData = new FormData();
    formData.append("post_id", post_id);
    axios.post("./api-delete_post.php", formData
    ).then(response => {
        document.getElementById("colMain").innerHTML = response.data;
    });
}