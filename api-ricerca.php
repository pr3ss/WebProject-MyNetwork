<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta

if($dbh->login_check()){
    if(isset($_POST['username_to_search'])){
        $result['found'] = false;

        $username = $_POST['username_to_search'];
        $list = $dbh->search_username($username);

        if(count($list)>0){
            $result["found"] = true;
            $result['list_username'] = $list;

        }


        header('Content-Type: application/json');
        echo json_encode($result);

    }
}else{ //non autorizzato
    header('Location: ./index.php');
}








?>