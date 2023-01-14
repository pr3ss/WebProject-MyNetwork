function blurrare() {
    var ric = document.getElementById("ricerca");
    var cat = document.getElementById("categoria");
    var nav = document.getElementById("navbarText");
    var x = document.getElementById("blur");
    x.classList.toggle("blurfilter");
    /*         if (x.classList.length == 1) {
                ric.classList.remove("myShow");
                cat.classList.remove("myShow");
                nav.classList.remove("show");
            } */
    if ((ric.classList.contains("myShow") || cat.classList.contains("myShow")) && !nav.classList.contains("show")) {
        x.classList.add("blurfilter");
    }
    if ((ric.classList.contains("myShow") || cat.classList.contains("myShow")) && nav.classList.contains("show")) {
        x.classList.add("blurfilter");
    }
}
function viewCategoria() {
    var x = document.getElementById("colSx");
    var x = document.getElementById("ricerca");
    x.classList.remove("myShow");
    var x = document.getElementById("categoria");
    x.classList.toggle("myShow");
    blurrare();
}
function viewRicerca() {
    var x = document.getElementById("colSx");

    var x = document.getElementById("categoria");
    x.classList.remove("myShow");
    var x = document.getElementById("ricerca");
    x.classList.toggle("myShow");
}
function openPost(user) {
    //se mobile view
        //window.location.href = "post.html"; oppure mettere il caricameno dinamico nel main invece che alla colonna

        //se desktop view
        var jolly = document.getElementById("colDx");

        const formData = new FormData();
        formData.append('post', user);

        axios.post('./api-post.php', formData).then(response => {
            console.log(response);
            jolly.innerHTML = response.data;
        });
}

function viewNotifiche(){
    //se mobile view
    //window.location.href = "notifiche.html"; oppure mettere il caricameno dinamico nel main invece che alla colonna

    //se desktop view
    var jolly = document.getElementById("colDx");


    axios.get('./notifiche.html').then(response => {
        console.log(response);
        jolly.innerHTML = response.data;
    });
}

/*/
    /* TODO risolvere background color spinner in desktop non serve ma in mobile altrimenti non si vede oppure in mobile cambiare il colore dello spinner oppure é un problema di z-index in mobile 
    /*/

    function ricerca_user(){
        var user = document.getElementById("input_search_user").value;
        if(!user){
            document.getElementById("list_searched_users").innerHTML="";    
            return;
        }

        document.getElementById("list_searched_users").innerHTML="<div class='d-flex justify-content-center pt-4 bg-white'><div class='spinner-border' role='status'> <span class='sr-only'>Loading...</span> </div></div>";

        const formData = new FormData();
        formData.append('username_to_search', user);
        
        axios.post('api-ricerca.php', formData).then(response => {
            fill_list_user(response.data["list_username"]);
        });
    }

    //TODO add referal to user page.
    function fill_list_user(list_users){
        const list_elm = document.getElementById("list_searched_users");
        list_elm.innerHTML="";
        for (let user in list_users){
            list_elm.innerHTML += ' <button type="button" class="list-group-item list-group-item-action">'+list_users[user].username+'</button>';
        }

    }