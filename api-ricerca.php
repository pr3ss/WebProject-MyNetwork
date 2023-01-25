<?php
require_once 'bootstrap.php';

if($dbh->login_check()){
    $result['found'] = false;
   
    if(isset($_POST['username_to_search'])){
        
        $username = $_POST['username_to_search'];
        $list = $dbh->search_username($username);

        if(count($list)>0){
            $result["found"] = true;
            $result['list_username'] = $list;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($result);
}else{ //non autorizzato
    header('Content-Type: application/json');
    echo json_encode("Accesso negato.");
}








?>