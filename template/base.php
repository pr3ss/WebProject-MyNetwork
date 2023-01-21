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
    <div id="blur" class="blur" onclick="close_menu()"></div>
    <!-- PILL -->
    <div class="container-fluid position-fixed" style="z-index:3;">
        <div class="row m-0 mt-2 bg-white rounded-pill ">
            <!-- DESCRIZIONE -->
            <div class="col-8 col-md-3 d-flex justify-content-center align-items-center">
                <label class="m-0 p-0" id="labelIdentifyScreen" for="">
                    <?php echo $templateParams["title"]; ?>
                </label>
            </div>
            <div class="col-2 col-md-3 order-md-last d-flex justify-content-center align-items-center">
                <div>
                    <button class="btn btn-dark btn-circle " onclick="addPost()"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <!-- NAV -->
            <div id="nav" class="col-2 col-md-6 order-md-2 d-flex justify-content-center">
                <nav class="bg-body-tertiary navbar-expand-md">
                    <div class="container-fluid">
                        <button id="btn_nav" class="btn btn-dark btn-circle navbar-toggler" data-bs-toggle="collapse"
                            data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                            aria-label="Toggle navigation" onclick="open_menu(),check_NuoveNotifiche()"><i
                                class="fa-solid fa-bars"></i></button>
                        <div class="collapse navbar-collapse position-notmd-absolute justify-content-center"
                            id="navbarText">
                            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                                <li class="nav-item ">
                                    <a class="btn btn-dark btn-circle " href="home.php"><i
                                            class="fa-solid fa-house"></i></a>
                                </li>
                                <li class="nav-item ">
                                    <button class="btn btn-dark btn-circle " onclick="showProfilo(),check_NuoveNotifiche()"><i
                                            class="fa-regular fa-user"></i></button>
                                </li>
                                <li class="nav-item ">
                                    <button class="btn btn-dark btn-circle " onclick="viewNotifiche(),check_NuoveNotifiche()"><i
                                            class="fa-regular fa-envelope">
                                            <span id="num_notifiche" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"></span></i></button>
                                </li>
                                <li class="nav-item  btn_RicCat">
                                    <button class="btn btn-dark btn-circle" onclick="viewCategoria(),check_NuoveNotifiche() "><i
                                            class="fa-solid fa-layer-group"></i></button>
                                </li>
                                <li class="nav-item  btn_RicCat">
                                    <button class="btn btn-dark btn-circle " onclick="viewRicerca(),check_NuoveNotifiche()"><i class="
                                                fa-solid fa-magnifying-glass"></i></button>
                                </li>
                                <li class="nav-item  ">
                                    <button class="btn btn-dark btn-circle " onclick="showImpostazioni(),check_NuoveNotifiche()"><i
                                            class="fa-solid fa-gear"></i></button>
                                </li>
                                <li class="nav-item ">
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
    <div class="container-fluid" style="z-index:3;">
        <div class="row" style="padding-top: 60px;">
            <div id="colSx" class="col-lg-3 d-lg-block position-fixed p-2 col-hidden " style="height: 90%;">
                <div id="ricerca" class="backthing h-50" style="z-index: 4;">
                    <div class="row mt-3 mb-1  ">
                        <div class="col-12 d-flex flex-row align-items-center">
                            <i class="fa-solid fa-magnifying-glass pr-2 pl-2"></i>
                            <input id="input_search_user" class="form-control " type="search" placeholder="Search"
                                aria-label="Search" oninput="ricerca_user()">
                        </div>
                    </div>
                    <div class="row  h-100 " style="overflow-y: scroll;">
                        <div class="col-12">
                            <div id="list_searched_users" class="list-group">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="categoria" class="backthing row h-50" style="overflow-y: auto; z-index: 4;">
                    <div class="col-12">
                        <div id="list_categorie" class="list-group p-0">
                            <?php foreach ($templateParams["categorie"] as $categoria): ?>
                                <button id="btnCat<?php echo $categoria['id'] ?>" type="button"
                                    class="list-group-item list-group-item-action <?php if ($categoria['id'] == 1) {
                                        echo "active";
                                    } ?>"
                                    onclick="cambiaCategoria(<?php echo $categoria['id'] ?>)"><?php echo $categoria['titolo'] ?></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 offset-lg-3 d-flex flex-column align-items-center">
                <div id="colMain" class="container-fluid"></div>
            </div>
            <div id="colDx" class="col-lg-3 offset-lg-9 d-lg-block position-fixed bg-dark col-hidden"
                style="height: 90%; ">
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