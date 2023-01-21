<?php 
require_once 'bootstrap.php'; //comprende avvio sessione protteta

if($dbh->login_check()){
    $notifica_id = $_POST["notifica_id"];
    return $dbh->view_noticica($notifica_id);
}else{ //non autorizzato
    header('Location: ./index.php');
}