<?php
require_once 'bootstrap.php';


$result=false;
if ($dbh->login_check()) {
    if(isset($_POST['post_id'])){
        $post_id = $_POST['post_id'];
        $result=$dbh->check_like($post_id, $_SESSION['user_id']);
        header('Content-Type: application/json');
        echo json_encode($result);
    }
} else { //non autorizzato
    header('Content-Type: application/json');
    echo json_encode("Accesso negato.");
}
?>