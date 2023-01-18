<?php 
require_once 'bootstrap.php'; //comprende avvio sessione protteta


$templateParams["title"] = "HOME";
$_SESSION["last_post"] = time();
$_SESSION["categoria_corrente"]=1; //default categoria

if($dbh->login_check()){
    $templateParams["username"] = $_SESSION["username"];
    $templateParams['js'] = array("https://unpkg.com/axios/dist/axios.min.js", "js/base.js", "js/home.js");
    //$templateParams['posts']=array(array("user"=>"Simone"),array("user"=>"Alex")) ; //db call
    $templateParams['categorie'] = $dbh->getCategorie();

    require 'template/base.php';
}else{ //non autorizzato
    header('Location: ./index.php');
}





?>