<?php
require_once 'bootstrap.php';


$templateParams["title"] = "PROFILO";

if ($dbh->login_check()) {
    $templateParams["username"] = $_SESSION["username"];
    $id_current_user = $_SESSION["user_id"];
    $templateParams["posts"] = $dbh->get_user_posts($id_current_user);
    $templateParams["info"] = $dbh->get_user_info($id_current_user);
    $templateParams["seguiti"] = $dbh->get_user_seguiti($id_current_user);
    $templateParams["follower"] = $dbh->get_user_follower(($id_current_user));

    if ($templateParams["info"] != null) {
        require 'template/profilo.php';
    } else {
        require './template/page_404.php';
    }
} else { //non autorizzato
    header('Content-Type: application/json');
    echo json_encode("Accesso negato.");
}