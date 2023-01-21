<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta


//TODO add check login

if(isset($_POST['post_id'])){
    $post_id = $_POST['post_id'];
    $templateParams['post']=$dbh->load_post($post_id);
    $templateParams['commenti']=$dbh->load_commenti_for($post_id);
    require("./template/post_commenti.php");
}


//js ti inviera l id del post e qui carichiamo tutti i commenti in un templateParams che post.php potra leggere



?>