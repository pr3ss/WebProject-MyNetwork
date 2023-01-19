<?php 
require_once 'bootstrap.php'; //comprende avvio sessione protteta


$templateParams["title"] = "PROFILO";

if($dbh->login_check()){
    $templateParams["listaAccount"] =  $dbh->get_user_follower($_SESSION["user_id"]);
    require 'template/seguiti_follower.php';
}else{ //non autorizzato
    header('Location: ./index.php');
}