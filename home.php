<?php 
require_once 'bootstrap.php'; //comprende avvio sessione protteta


$templateParams["title"] = "Home";

if($dbh->login_check()){
    $templateParams["username"] = $_SESSION["username"];
}else{
    //$templateParams["error"] = "Non autorizzato";
    header('Location: ./index.php');
}

require 'template/home-base2.php';



?>