<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta


//TODO add check login
$result=false;
if(isset($_POST['post_id'])){
    $post_id = $_POST['post_id'];
    $result=$dbh->check_like($post_id, $_SESSION['user_id']);
    echo $result[0]["nMiPiace"];
}
//js ti inviera l id del post e qui carichiamo tutti i commenti in un templateParams che post.php potra leggere

?>