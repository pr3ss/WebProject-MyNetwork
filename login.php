<?php
require_once 'bootstrap.php';

if(isset($_POST["username"]) && isset($_POST["password"])){
    //$login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
}

/*if(isUserLoggedIn()){
    require 'home.php';
}*/
//else{
    $templateParams['title'] = 'Log-in';
    $templateParams['name'] = 'template/login-form.php';

    require 'template/login-base.php';
//}



?>