<?php
require_once 'bootstrap.php'; 

$result = false;
if ($dbh->login_check()) {
    if (isset($_POST["testo"]) && isset($_POST["postId"])) {
        $user = $_SESSION['user_id'];
        $data_ora = time();
        if ($dbh->upload_comment($user, $data_ora, $_POST["testo"], $_POST["postId"])) {
            $result = true;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($result);
} else { //non autorizzato
    header('Content-Type: application/json');
    echo json_encode("Accesso negato.");
}

?>