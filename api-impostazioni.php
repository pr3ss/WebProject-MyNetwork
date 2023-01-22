<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta


$templateParams["title"] = "IMPOSTAZIONI";


$result["foto"]=false;
$result["info"]=false;
if ($dbh->login_check()) {
    if (isset($_POST["new_info"])) {
        $info = json_decode($_POST["new_info"],true);
    
        $my_id_user = $_SESSION["user_id"];
        $username = isset($info["username"]) ? $info["username"] : null;
        $email = isset($info["email"]) ? $info["email"] : null;
        $descrizione = isset($info["descrizione"]) ? $info["descrizione"] : null;
        $password = null;
        $random_salt = null;

        if (isset($_FILES['foto_profilo']['name'])) {
            $foto_profilo = $_FILES['foto_profilo']['name'];
            $file_extension = pathinfo($foto_profilo, PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);

            // Valid extensions
            $valid_ext = array("jpg", "png", "jpeg");

            if (in_array($file_extension, $valid_ext)) {

                $location = $my_id_user."_" . "foto_profilo." . $file_extension;
                if (move_uploaded_file($_FILES['foto_profilo']['tmp_name'], IMG_DIR.$location)) {
                    if ($dbh->update_immagine_profilo($my_id_user, $location)) {
                        $result["foto"] = true;
                    }
                }
            }
        }
        
        if (isset($info["password"])) {
            $password = $info["password"];
            $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
            // Crea una password usando la chiave appena creata.
            $password = hash('sha512', $password . $random_salt);
        }

        if($dbh->update_impostazioni($my_id_user, $username, $email, $descrizione, $password, $random_salt)){
            $result["info"]=true;
        }

        header('Content-Type: application/json');
        echo json_encode($result);

    } else {
        $templateParams["username"] = $_SESSION["username"];
        $id_current_user = $_SESSION["user_id"];
        $templateParams["info"] = $dbh->get_user_info($id_current_user);
        //$templateParams['js'] = array("https://unpkg.com/axios/dist/axios.min.js",);

        require 'template/impostazioni.php';
    }
} else { //non autorizzato
    header('Location: ./index.php');
}
