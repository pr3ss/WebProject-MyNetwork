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
    <!-- Fare il for anche per i css-->
    <link rel="stylesheet" href="./css/home_base.css">


</head>



<body>

    <!-- PILL -->
    <div class="container-fluid position-fixed" style="z-index:3;">
        <div class="row m-0 mt-2 bg-white rounded-pill ">
            <!-- DESCRIZIONE -->
            <div class="col-8 col-md-3 d-flex justify-content-center align-items-center">
                <label class="m-0 p-0" id="labelIdentifyScreen" for="">HOME</label>
            </div>
            <div class="col-2 col-md-3 order-md-last d-flex justify-content-center align-items-center">
                <div>
                    <a class="btn btn-dark btn-circle " href="add_post.html"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <!-- NAV -->
            <div class="col-2 col-md-6 order-md-2 d-flex justify-content-center align-items-center">
                <nav class="bg-body-tertiary navbar-expand-md">
                    <div class="container-fluid">
                        <button class="btn btn-dark btn-circle navbar-toggler" data-bs-toggle="collapse"
                            data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                            aria-label="Toggle navigation" onclick="blurrare()"><i
                                class="fa-solid fa-bars"></i></button>
                        <div class="collapse navbar-collapse position-notmd-absolute" id="navbarText">
                            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                                <li class="nav-item mr-4 ml-4">
                                    <a class="btn btn-dark btn-circle " href="..."><i class="fa-solid fa-house"></i></a>
                                </li>
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

    <!-- FEED -->
    <div class="container-fluid">
        <div class="row">
            <div id="colSx" class="col-lg-3 d-lg-block position-fixed p-2" style="height: 90%; padding-top: 60px;">
                <div id="ricerca" class="backthing h-50">
                    <div class="row mt-3 mb-1  " style="z-index: 2;">
                        <div class="col-12 d-flex flex-row align-items-center">
                            <i class="fa-solid fa-magnifying-glass pr-2 pl-2"></i>
                            <input id="input_search_user" class="form-control " type="search" placeholder="Search"
                                aria-label="Search" oninput="ricerca_user('desktop')">
                        </div>
                    </div>
                    <div class="row  h-100 " style="overflow-y: scroll;">
                        <div class="col-12">
                            <div id="list_searched_users" class="list-group">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="categoria" class="backthing row h-50" style="overflow-y: auto;">
                    <div class="col-12">
                        <div id="list_categorie" class="list-group p-0">
                            <button type="button" class="list-group-item list-group-item-action">ALL</button>
                            <button type="button" class="list-group-item list-group-item-action">Seguiti</button>
                            <button type="button" class="list-group-item list-group-item-action">Informatica</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="colMain" class="col-12 col-lg-6 offset-lg-3 d-flex flex-column align-items-center"
                style="padding-top: 60px;">
            </div>
            <div id="colDx" class="col-lg-3 offset-lg-9 d-lg-block d-none position-fixed bg-dark"
                style="height: 90%; padding-top: 60px;">
            </div>
        </div>
    </div>
    <div id="blur" class="blur" onclick="blurrare()"></div>

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



</html>