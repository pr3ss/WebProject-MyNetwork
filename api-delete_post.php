<?php 
require_once 'bootstrap.php'; //comprende avvio sessione protteta


$templateParams["title"] = "PROFILO";

if($dbh->login_check()){
    $post_id = $_POST["post_id"];
    $post_info = $dbh->load_post($post_id);
    $path_img_post = $post_info[0]["img"];
    if($dbh->delete_post($post_id)){
        unlink(IMG_DIR.$path_img_post);
    }
    require 'api-profilo.php';
}else{ //non autorizzato
    header('Content-Type: application/json');
    echo json_encode("Accesso negato.");
}