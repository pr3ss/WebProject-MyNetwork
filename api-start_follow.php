<?php 
require_once 'bootstrap.php';


$templateParams["title"] = "PROFILO";

if($dbh->login_check()){
    $user = $_POST["user_id"];
    $dbh->start_follow($user, $_SESSION["user_id"]);
    require 'api-profilo_other_user.php';
}else{ //non autorizzato
    header('Content-Type: application/json');
    echo json_encode("Accesso negato.");
}