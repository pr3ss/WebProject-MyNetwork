<!DOCTYPE html>
<html lang="en" xml:lang="en">

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
    <div id="blur" class="blur" onclick="close_menu()"></div>
    <!-- PILL -->
    <div class="container-fluid p-0 position-fixed menu" style="z-index:3;">
        <div class="row m-0 mt-1 mb-1">
            <!-- DESCRIZIONE -->
            <div class="col-8 col-md-2 d-flex align-items-center w-100">
                <p class="m-0 p-0 w-100" id="labelIdentifyScreen">
                    <?php echo $templateParams["title"]; ?>
                </p>
            </div>
            <div class="col-2 col-md-2 order-md-last d-flex justify-content-center align-items-center">
                <div>
                    <button class="btn btn-nav btn-circle " onclick="addPost()"><em class="fas fa-plus"></em></button>
                </div>
            </div>
            <!-- NAV -->
            <div id="nav" class="col-2 col-md-8 order-md-2 d-flex justify-content-center w-100">
                <nav class="bg-body-tertiary navbar-expand-md ">
                    <div class="container-fluid">
                        <button id="btn_nav" class="btn btn-nav btn-circle navbar-toggler" data-bs-toggle="collapse"
                            data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                            aria-label="Toggle navigation" onclick="open_menu(),check_NuoveNotifiche()" ><em
                                id="icon_notifiche_mobile" class="fa-solid fa-bars" alt="button toggle menu"></em></button>
                        <div class="collapse navbar-collapse position-notmd-absolute justify-content-center "
                            id="navbarText">
                            <ul class="navbar-nav me-auto mb-2 mb-md-0 w-100 d-flex justify-content-center ">
                                <li class="nav-item ">
                                    <button class="btn btn-nav btn-circle " onclick="home()"><em alt="Link to home"
                                            class="fa-solid fa-house"></em></button>
                                </li>
                                <li class="nav-item ">
                                    <button class="btn btn-nav btn-circle "
                                        onclick="showProfilo(),check_NuoveNotifiche()" ><em alt="button show my account"
                                            class="fa-regular fa-user"></em></button>
                                </li>
                                <li class="nav-item ">
                                    <button class="btn btn-nav btn-circle "
                                        onclick="viewNotifiche(),check_NuoveNotifiche()" ><em alt="button show notifications"
                                            id="icon_notifiche_desktop" class="fa-regular fa-envelope">
                                            <span id="num_notifiche"
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"></span></em></button>
                                </li>
                                <li class="nav-item  btn_RicCat">
                                    <button class="btn btn-nav btn-circle"
                                        onclick="viewCategoria(),check_NuoveNotifiche() " ><em alt="button show categories"
                                            class="fa-solid fa-layer-group"></em></button>
                                </li>
                                <li class="nav-item  btn_RicCat">
                                    <button class="btn btn-nav btn-circle "
                                        onclick="viewRicerca(),check_NuoveNotifiche()" ><em alt="button show input for search users" class="
                                                fa-solid fa-magnifying-glass"></em></button>
                                </li>
                                <li class="nav-item  ">
                                    <button class="btn btn-nav btn-circle "
                                        onclick="showImpostazioni(),check_NuoveNotifiche()" ><em alt="button show account settings"
                                            class="fa-solid fa-gear"></em></button>
                                </li>
                                <li class="nav-item ">
                                    <button class="btn btn-nav btn-circle " onclick="logout()"><em alt="button logout"
                                            class="fa-solid fa-right-from-bracket"></em></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <!-- FEED -->
    <div class="container-fluid" style="z-index:3;">
        <div class="row" style="padding-top: 60px;">
            <div id="colSx" class="col-lg-3 d-lg-block position-fixed p-0 pl-2 col-hidden " style="height: 90%;">
                <div id="ricerca" class="backthing h-50" style="z-index: 4; overflow-y:hidden;">
                    <div class="row mt-3 mb-1 w-100  ">
                        <div class="col-12 d-flex flex-row align-items-center">
                            <em class="fa-solid fa-magnifying-glass pr-2 pl-2"></em>
                            <label for="input_search_user" style="display: none;">Search user</label>
                            <emnput id="input_search_user" class="form-control " type="search" placeholder="Search"
                                aria-label="Search" oninput="ricerca_user()">
                        </div>
                    </div>
                    <div class="row w-100" style="overflow-y: auto; height:80%">
                        <div class="col-12">
                            <div id="list_searched_users" class="list-group">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="categoria" class="backthing h-50 " style="overflow-y: hidden; z-index: 4;">
                    <div class="row w-100 h-100" style="overflow-y: auto;">
                        <div class="col-12">
                            <div id="list_categorie" class="list-group p-0">
                                <?php foreach ($templateParams["categorie"] as $categoria): ?>
                                    <button id="btnCat<?php echo $categoria['id'] ?>" type="button" class="btn btnMagic <?php if ($categoria['id'] == 1) {
                                           echo "active";
                                       } ?>" onclick="cambiaCategoria(<?php echo $categoria['id'] ?>)"><?php
                                           echo $categoria['titolo'] ?></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 offset-lg-3 d-flex flex-column align-items-center p-0">
                <div class="container-fluid">
                    <div id="colMain" class="row justify-content-center m-0">
                    </div>
                </div>
            </div>
            <div id="colDx" class="col-lg-3 offset-lg-9 d-lg-block position-fixed col-hidden" style="height: 90%; ">
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



</html>