<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta


$templateParams["title"] = "PROFILO";

if ($dbh->login_check()) {
    $result = $dbh->check_nNuoveNotifiche($_SESSION['user_id']);
    echo $result[0]["nNotifiche"];
} else { //non autorizzato
    header('Location: ./index.php');
}