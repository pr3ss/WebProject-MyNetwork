<?php 
require_once 'bootstrap.php';

if($dbh->login_check()){
    $notifica_id = $_POST["notifica_id"];
    header('Content-Type: application/json');
    $result["vista"] = $dbh->view_notifica($notifica_id);
    echo json_encode($result);
}else{ //non autorizzato
    header('Content-Type: application/json');
    echo json_encode("Accesso negato.");
}