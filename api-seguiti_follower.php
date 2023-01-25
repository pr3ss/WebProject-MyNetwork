<?php 
require_once 'bootstrap.php';


$templateParams["title"] = "PROFILO";

if($dbh->login_check()){
    $templateParams["listaAccount"] = json_decode($_POST["list"],true);
    require 'template/seguiti_follower.php';
}else{ //non autorizzato
    header('Content-Type: application/json');
    echo json_encode("Accesso negato.");
}