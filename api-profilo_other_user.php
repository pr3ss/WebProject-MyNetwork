<?php 
require_once 'bootstrap.php'; //comprende avvio sessione protteta


$templateParams["title"] = "PROFILO";

if($dbh->login_check()){
    $user = $_POST["user_id"];
    $templateParams["posts"] = $dbh->get_user_posts($user);
    $templateParams["info"] = $dbh->get_user_info($user);
    $templateParams["seguiti"] = $dbh->get_user_seguiti($user);
    $templateParams["follower"] = $dbh->get_user_follower($user);
    $templateParams["isSeguito"] = $dbh->check_follow($user, $_SESSION["user_id"]);
    //$templateParams['js'] = array("https://unpkg.com/axios/dist/axios.min.js",);
    if($_SESSION["user_id"] == $user){
        require 'template/profilo.php';
    }else{
        require 'template/profilo_other_user.php';
    }
    
}else{ //non autorizzato
    header('Location: ./index.php');
}
