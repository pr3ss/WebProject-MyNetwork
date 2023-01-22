<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta


$result=false;
if ($dbh->login_check()) {
    if(isset($_POST['post_id'])){
        $post_id = $_POST['post_id'];
        $result=$dbh->check_like($post_id, $_SESSION['user_id']);
        echo $result[0]["nMiPiace"];
    }
} else { //non autorizzato
    header('Location: ./index.php');
}



?>