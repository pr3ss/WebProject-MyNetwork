<?php
require_once 'bootstrap.php';


if ($dbh->login_check()) {
    $my_user_id = $_SESSION["user_id"];

    if(isset($_POST['cat_changed']) && $_POST['cat_changed']=="true"){
        $_SESSION["categoria_corrente"] = $_POST['categoria'];
        $_SESSION["last_post"] = time();
    }

    $num_post = NUM_POST_FOR_REQUEST;
    if(isset($_POST["num_post"])) $num_post = $_POST["num_post"];


    $templateParams['posts'] = $dbh->load_posts_for($my_user_id, $_SESSION["categoria_corrente"], $_SESSION["last_post"], $num_post);
    $cout_post = count($templateParams['posts']);
    if ($cout_post != 0){
        $_SESSION["last_post"] = $templateParams['posts'][$cout_post-1]["data_ora"];
    }


    require("./template/post.php");
} else { //non autorizzato
    header('Content-Type: application/json');
    echo json_encode("Accesso negato.");
}



?>