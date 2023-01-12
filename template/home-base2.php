<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/67fa264284.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css\home_base.css">
</head>



<body>
    <div id="blur" class="blur " onclick="test()"></div>
    <div id="categoria" class="backthing">
        <div class="container p-0">
            <div class="row">
                <div class="col-12 list-group p-0">
                    <button type="button" class="list-group-item list-group-item-action">ALL</button>
                    <button type="button" class="list-group-item list-group-item-action">Seguiti</button>
                    <button type="button" class="list-group-item list-group-item-action">Informatica</button>
                    <button type="button" class="list-group-item list-group-item-action">DonneNude</button>
                    <button type="button" class="list-group-item list-group-item-action">MOTO</button>
                    <button type="button" class="list-group-item list-group-item-action">ALL</button>
                    <button type="button" class="list-group-item list-group-item-action">Seguiti</button>
                    <button type="button" class="list-group-item list-group-item-action">Informatica</button>
                    <button type="button" class="list-group-item list-group-item-action">DonneNude</button>
                    <button type="button" class="list-group-item list-group-item-action">MOTO</button>
                    <button type="button" class="list-group-item list-group-item-action">ALL</button>
                    <button type="button" class="list-group-item list-group-item-action">Seguiti</button>
                    <button type="button" class="list-group-item list-group-item-action">Informatica</button>
                    <button type="button" class="list-group-item list-group-item-action">DonneNude</button>
                    <button type="button" class="list-group-item list-group-item-action">MOTO</button>
                    <button type="button" class="list-group-item list-group-item-action">ALL</button>
                    <button type="button" class="list-group-item list-group-item-action">Seguiti</button>
                    <button type="button" class="list-group-item list-group-item-action">Informatica</button>
                    <button type="button" class="list-group-item list-group-item-action">DonneNude</button>
                    <button type="button" class="list-group-item list-group-item-action">MOTO</button>
                </div>
            </div>
        </div>
    </div>
    <div id="ricerca" class="backthing">
        <div class="container p-0">
            <div class="row ">
                <input id="input_search_user_mobile" class="col-9 form-control" type="search" placeholder="Search" aria-label="Search" oninput="ricerca_user('mobile')">
                <button type="button" class=" col-3 btn btn-dark">
                    <i class="fas fa-search"></i>
                </button>
                <div class="col-12 p-0">
                    <div id="list_searched_users_mobile" class="list-group">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid position-fixed" style="z-index:2;">
        <div class="row m-0 mt-2 bg-white rounded-pill ">

            <div class="col-8 col-lg-3 d-flex justify-content-center align-items-center">
                <label class="m-0 p-0" id="labelIdentifyScreen" for="">HOME</label>
            </div>
            <div class="col-2 col-lg-3 order-lg-last d-flex justify-content-center align-items-center">
                <div>
                    <a class="btn btn-dark btn-circle " href="add_post.html"><i class="fas fa-plus"></i></a>
                </div>
            </div>

            <!-- FISSO IL MENU -->
            <div class="col-2 col-lg-6 order-lg-2 d-flex justify-content-center align-items-center">
                <nav class="bg-body-tertiary navbar-expand-lg">
                    <div class="container-fluid ">
                        <button class="btn btn-dark btn-circle navbar-toggler" data-bs-toggle="collapse"
                            onclick="test()" data-bs-target="#navbarText" aria-controls="navbarText"
                            aria-expanded="false" aria-label="Toggle navigation"><i
                                class="fa-solid fa-bars"></i></button>
                        <div class="collapse navbar-collapse position-notlg-absolute" id="navbarText">
                            <!--position-absolute togli con js-->
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item mr-4 ml-4">
                                    <a class="btn btn-dark btn-circle " href="profilo.html"><i
                                            class="fa-regular fa-user"></i></a>
                                </li>
                                <li class="nav-item mr-4 ml-4">
                                    <a class="btn btn-dark btn-circle " href="notifiche.html"><i
                                            class="fa-regular fa-envelope"></i></a>
                                </li>
                                <li class="nav-item mr-4 ml-4 btn_RicCat">
                                    <button class="btn btn-dark btn-circle" onclick="viewCategoria()"><i
                                            class="fa-solid fa-layer-group"></i></button>
                                </li>
                                <li class="nav-item mr-4 ml-4 btn_RicCat">
                                    <button class="btn btn-dark btn-circle " onclick="viewRicerca()"><i class="
                                                fa-solid fa-magnifying-glass"></i></button>
                                </li>
                                <li class="nav-item mr-4 ml-4 ">
                                    <a class="btn btn-dark btn-circle " href="impostazioni.html"><i
                                            class="fa-solid fa-gear"></i></a>
                                </li>
                                <li class="nav-item mr-4 ml-4">
                                    <a class="btn btn-dark btn-circle " href="logout.php"><i
                                            class="fa-solid fa-right-from-bracket"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

            </div>
        </div>

    </div>


    <div class="container-fluid" style="padding-top: 60px;">
        <div class="row">
            <!--Decidere l altezza dell intera colonna se 100% si puo usare anche h-100-->
            <div class="col-lg-3 d-lg-block d-none position-fixed  p-2 " style="height: 90%;">
                <div class="row h-50" style="overflow-y: auto;">
                    <div id="categoria" class="col-12">
                                <div class="list-group p-0">
                                    <button type="button" class="list-group-item list-group-item-action">ALL</button>
                                    <button type="button"
                                        class="list-group-item list-group-item-action">Seguiti</button>
                                    <button type="button"
                                        class="list-group-item list-group-item-action">Informatica</button>
                                    <button type="button"
                                        class="list-group-item list-group-item-action">DonneNude</button>
                                    <button type="button" class="list-group-item list-group-item-action">MOTO</button>
                                    <button type="button" class="list-group-item list-group-item-action">MOTO</button>
                                    <button type="button" class="list-group-item list-group-item-action">MOTO</button>
                                    <button type="button" class="list-group-item list-group-item-action">MOTO</button>
                                    <button type="button" class="list-group-item list-group-item-action">MOTO</button>
                                    <button type="button" class="list-group-item list-group-item-action">MOTO</button>
                                    <button type="button" class="list-group-item list-group-item-action">MOTO</button>
                                    <button type="button" class="list-group-item list-group-item-action">MOTO</button>
                                    <button type="button" class="list-group-item list-group-item-action">MOTO</button>
                                    <button type="button" class="list-group-item list-group-item-action">MOTO</button>
                                </div>
                    </div>
                </div>

                <div class="row mt-3 mb-1">
                    <div class="col-9 ">
                        <input id="input_search_user_desktop" class="form-control " type="search" placeholder="Search" aria-label="Search" oninput="ricerca_user('desktop')">
                    </div>
                    <div class="col-3 p-0">
                        <button type="button" class="btn btn-dark position-fixed" style="z-index: 2;" onclick="ricerca_user()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="row h-50 " style="overflow-y: scroll;">
                    <div class="col-12">
                        <div id="list_searched_users_desktop" class="list-group">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 offset-lg-3 ">
                <!--Verificare se usare row oppure come era prima con d-flex....-->
                <div class="row justify-content-center align-items-center">
                    <div class="container bg-white m-1">
                        <div class="row d-flex justify-content-center">
                            <div class="col-3 d-flex  justify-content-center ">
                                <img src="img/logo.jpg" alt="Avatar" class="avatar">
                            </div>
                            <div class="col-5">
                                <div class="row">
                                    <p class="m-0 user">SimoneLuga</p>
                                </div>
                                <div class="row">
                                    <p class="m-0 date">22/12/22</p>
                                </div>
                                <div class="row">
                                    <p class="m-0" style="font-size: small;">Luogo:cesena</p>
                                </div>
                            </div>
                            <div class="col-2 d-flex flex-column justify-content-center">
                                <div class="row justify-content-center">
                                    <button type="button" class="btn btnshadow"><i class="fa-solid fa-heart">
                                            919</i></button>
                                </div>
                            </div>
                            <div class="col-2 d-flex flex-column justify-content-center">
                                <div class="row justify-content-center">
                                    <button type="button" class="btn btnshadow" onclick="openPost()"><i
                                            class="fa-solid fa-comment">
                                            100</i></button>
                                </div>
                            </div>
                        </div>
                        <img src="img\logo.jpg" class="card-img-top p-2" alt="..." onclick="openPost()">
                        <div class="card-body" onclick="openPost()">
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of
                                the
                                card's content.</p>
                        </div>
                    </div>
                    <div class="container bg-white m-1">
                        <div class="row d-flex justify-content-center">
                            <div class="col-3 d-flex  justify-content-center ">

                                <img src="img/logo.jpg" alt="Avatar" class="avatar">
                            </div>
                            <div class="col-5">
                                <div class="row">
                                    <p class="m-0 user">SimoneLuga</p>
                                </div>
                                <div class="row">
                                    <p class="m-0 date">22/12/22</p>
                                </div>
                                <div class="row">
                                    <p class="m-0" style="font-size: small;">Luogo:cesena</p>
                                </div>
                            </div>
                            <div class="col-2 d-flex flex-column justify-content-center">
                                <div class="row justify-content-center">
                                    <button type="button" class="btn btnshadow"><i class="fa-solid fa-heart">
                                            919</i></button>
                                </div>
                            </div>
                            <div class="col-2 d-flex flex-column justify-content-center">
                                <div class="row justify-content-center">
                                    <button type="button" class="btn btnshadow" onclick="openPost()"><i
                                            class="fa-solid fa-comment">
                                            100</i></button>
                                </div>
                            </div>
                        </div>
                        <img src="img\logo.jpg" class="card-img-top p-2" alt="..." onclick="openPost()">
                        <div class="card-body" onclick="openPost()">
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of
                                the
                                card's content.</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 offset-lg-9 d-lg-block d-none position-fixed">
                <iframe src="./post.html" class="vh-100 w-100" title="" style="border: 0; overflow: hidden;"></iframe>
            </div>
        </div>
    </div>
    

    <?php
        if (isset($templateParams["js"])):
            foreach ($templateParams["js"] as $script):
        ?>
        <script src="<?php echo $script; ?>"></script>
        <?php
            endforeach;
        endif;
    ?>



</body>

<style>

</style>

<script>
    function test() {
        var x = document.getElementById("blur");
        x.classList.toggle("blurfilter");
        if (x.classList.length == 1) {
            var x = document.getElementById("categoria");
            x.classList.remove("showCategoria");
            var x = document.getElementById("ricerca");
            x.classList.remove("showRicerca");
            var x = document.getElementById("navbarText");
            x.classList.remove("show");
        }
    }
    function viewCategoria() {
        var x = document.getElementById("ricerca");
        x.classList.remove("showRicerca");
        var x = document.getElementById("categoria");
        x.classList.toggle("showCategoria");
    }
    function viewRicerca() {
        var x = document.getElementById("categoria");
        x.classList.remove("showCategoria");
        var x = document.getElementById("ricerca");
        x.classList.toggle("showRicerca");
    }
    function openPost() {
        window.location.href = "post.html";
    } 


    /*/
    /* TODO risolvere background color spinner in desktop non serve ma in mobile altrimenti non si vede oppure in mobile cambiare il colore dello spinner oppure é un problema di z-index in mobile 
    /*/

    function ricerca_user(view_type){
        var user = document.getElementById("input_search_user_"+view_type).value;
        if(!user){
            document.getElementById("list_searched_users_"+view_type).innerHTML="";    
            return;
        }

        document.getElementById("list_searched_users_"+view_type).innerHTML="<div class='d-flex justify-content-center pt-4 bg-white'><div class='spinner-border' role='status'> <span class='sr-only'>Loading...</span> </div></div>";

        const formData = new FormData();
        formData.append('username_to_search', user);
        
        axios.post('api-ricerca.php', formData).then(response => {
            fill_list_user(response.data["list_username"], view_type);
        });
    }

    //TODO add referal to user page.
    function fill_list_user(list_users, view_type){
        const list_elm = document.getElementById("list_searched_users_"+view_type);
        list_elm.innerHTML="";
        for (let user in list_users){
            list_elm.innerHTML += ' <button type="button" class="list-group-item list-group-item-action">'+list_users[user].username+'</button>';
        }

    }
</script>

</html>