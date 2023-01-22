<?php
require_once 'bootstrap.php';


$templateParams["title"] = "PROFILO";

if ($dbh->login_check()) {
    $result = $dbh->check_nNuoveNotifiche($_SESSION['user_id']);
    header('Content-Type: application/json');
    echo json_encode($result[0]);
} else { //non autorizzato
    header('Content-Type: application/json');
    echo json_encode("Accesso negato.");
}