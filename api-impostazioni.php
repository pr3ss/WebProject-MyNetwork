<?php 
require_once 'bootstrap.php'; //comprende avvio sessione protteta


$templateParams["title"] = "IMPOSTAZIONI";

if($dbh->login_check()){
    $templateParams["username"] = $_SESSION["username"];
    $id_current_user = $_SESSION["user_id"];
    $templateParams["info"] = $dbh->get_user_info($id_current_user);
    //$templateParams['js'] = array("https://unpkg.com/axios/dist/axios.min.js",);

    require 'template/impostazioni.php';
}else{ //non autorizzato
    header('Location: ./index.php');
}