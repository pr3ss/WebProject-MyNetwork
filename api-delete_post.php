<?php 
require_once 'bootstrap.php'; //comprende avvio sessione protteta


$templateParams["title"] = "PROFILO";

if($dbh->login_check()){
    $post_id = $_POST["post_id"];
    $dbh->delete_post($post_id);
    require 'api-profilo.php';
}else{ //non autorizzato
    header('Location: ./index.php');
}