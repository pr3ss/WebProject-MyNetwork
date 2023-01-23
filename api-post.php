<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta


if ($dbh->login_check()) {
    if(isset($_POST['post_id'])){
        $post_id = $_POST['post_id'];
        $templateParams['post']=$dbh->load_post($post_id);
        $templateParams['commenti']=$dbh->load_commenti_for($post_id);
        if($templateParams['post']!=null){
            require("./template/post_commenti.php");
        }else{
            require("./template/page_404.php");
        }
    }
} else { //non autorizzato
    header('Content-Type: application/json');
    echo json_encode("Accesso negato.");
}

?>