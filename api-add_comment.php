<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta
//TODO add check login
$result = false;
if (isset($_POST["testo"]) && isset($_POST["postId"])) {
    $user = $_SESSION['user_id'];
    $data_ora = time();
    if ($dbh->upload_comment($user, $data_ora, $_POST["testo"], $_POST["postId"])) {
        $result = true;
    }
}
header('Content-Type: application/json');
echo json_encode($result);
?>