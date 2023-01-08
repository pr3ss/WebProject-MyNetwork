<?php 
require_once 'bootstrap.php'; //comprende avvio sessione protteta


$templateParams["title"] = "Home";

if($dbh->login_check()){
    $templateParams["username"] = $_SESSION["username"];
    $templateParams['js'] = array("https://unpkg.com/axios/dist/axios.min.js");

    require 'template/home-base2.php';
}else{ //non autorizzato
    header('Location: ./index.php');
}





?>