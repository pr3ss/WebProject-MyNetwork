<?php
require_once 'bootstrap.php';

$result = false;
if ($dbh->login_check()) {
    if (isset($_FILES['file']['name'])) {
        $filename = $_FILES['file']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $extension = strtolower($extension);
    
        // Valid extensions
        $valid_ext = array("jpg", "png", "jpeg");
    
        if (in_array($extension, $valid_ext)) {
            $testo = isset($_POST['testo']) ? $_POST['testo'] : "NULL";
            $luogo = !empty($_POST['luogo']) ? $_POST['luogo'] : null;
            $cat = isset($_POST['categoria']) ? $_POST['categoria'] : 1;
            $user = $_SESSION['user_id'];
            $data_ora = time();
            $id_post = $dbh->upload_post($user, $data_ora, $testo, $luogo, $cat);
            $location = $_SESSION['user_id'] . "_" . $id_post. "." . $extension;
            if ($id_post) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], IMG_DIR.$location)) {
                    if ($dbh->updateimg_post($id_post, $location)) {
                        $result = true;
                    }
                }
            }
        }
    
        header('Content-Type: application/json');
        echo json_encode($result);
    } else if (isset($_POST['testo'])) {
        $testo = isset($_POST['testo']) ? $_POST['testo'] : "";
        $luogo = !empty($_POST['luogo']) ? $_POST['luogo'] : null;
        $cat = isset($_POST['categoria']) ? $_POST['categoria'] : 1;
        $user = $_SESSION['user_id'];
        $data_ora = time();
        $id_post = $dbh->upload_post($user, $data_ora, $testo, $luogo, $cat);
        if($id_post){
            $result = true;
        }
    
        header('Content-Type: application/json');
        echo json_encode($result);
    } else {
        $templateParams["categorie"] = $dbh->getCategorie();
        require("./template/add_post.php");
    }
} else { //non autorizzato
    header('Content-Type: application/json');
    echo json_encode("Accesso negato.");
}


?>