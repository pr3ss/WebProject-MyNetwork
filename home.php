<?php 
require_once 'bootstrap.php';


$templateParams["title"] = "HOME";


if($dbh->login_check()){
    $_SESSION["last_post"] = time();
    $_SESSION["categoria_corrente"]= DEFAULT_CATEGORY;
    $templateParams["username"] = $_SESSION["username"];

    $templateParams['js'] = array("https://unpkg.com/axios/dist/axios.min.js", "js/base.js", "js/home.js", "js/sha512.js", 
                                    "js/add_post.js", "js/add_comment.js","js/impostazioni.js", "js/notifiche.js",
                                    "js/profilo.js","js/ricerca.js");
    $templateParams['categorie'] = $dbh->getCategorie();

    require 'template/base.php';
}else{ //non autorizzato
    header('Location: ./index.php');
}





?>