<?php
require_once 'bootstrap.php';

/*
*qui controllare se esistono i parametri per effetuare la registrazione
*se non esistono ritornare la pagina di signin 
if(isset($_POST["username"]) && isset($_POST["password"])){
    //$login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
}*/

/*Se la registrazione é andata a buon fine loggarlo e andare su home 
* altrimenti ritornare la pagina di signin con l errore
*/
// $templateParams['error'] = ....

$templateParams['title'] = 'Sign-in';
$templateParams['name'] = 'template/signin-form.php';    

require 'template/login-base.php';




?>