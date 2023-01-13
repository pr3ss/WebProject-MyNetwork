<?php
require_once 'bootstrap.php';

if($dbh->login_check()){
    header('Location: ./home.php');
}else{
    $templateParams['js'] = array("https://unpkg.com/axios/dist/axios.min.js", "js/login.js", "js/sha512.js");
    $templateParams['title'] = 'Log-in';
    $templateParams['form'] = "login-form.php";

    require 'template/login-base.php';
}



?>