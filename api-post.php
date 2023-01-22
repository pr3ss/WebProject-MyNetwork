<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta


if ($dbh->login_check()) {
    if(isset($_POST['post_id'])){
        $post_id = $_POST['post_id'];
        $templateParams['post']=$dbh->load_post($post_id);
        $templateParams['commenti']=$dbh->load_commenti_for($post_id);
        require("./template/post_commenti.php");
    }
} else { //non autorizzato
    header('Location: ./index.php');
}

?>