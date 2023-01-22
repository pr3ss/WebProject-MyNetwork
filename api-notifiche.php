<?php 
require_once 'bootstrap.php'; //comprende avvio sessione protteta


$templateParams["title"] = "PROFILO";

if($dbh->login_check()){
    $user = $_SESSION["user_id"];
    $templateParams["notifiche"] = $dbh->get_notifiche($user);
    require 'template/notifiche.php';
}else{ //non autorizzato
    header('Content-Type: application/json');
    echo json_encode("Accesso negato.");
}