<?php 
require_once 'bootstrap.php'; //comprende avvio sessione protteta


$templateParams["title"] = "PROFILO";

if($dbh->login_check()){
    $templateParams["username"] = $_SESSION["username"];
    $id_current_user = $_SESSION["user_id"];
    $templateParams["posts"] = $dbh->get_user_posts($id_current_user);
    $templateParams["info"] = $dbh->get_user_info($id_current_user);
    $templateParams["seguiti"] = $dbh->get_user_seguiti($id_current_user);
    $templateParams["follower"] = $dbh->get_user_follower(($id_current_user));
    //$templateParams['js'] = array("https://unpkg.com/axios/dist/axios.min.js",);

    require 'template/profilo.php';
}else{ //non autorizzato
    header('Location: ./index.php');
}

