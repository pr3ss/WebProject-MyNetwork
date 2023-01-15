<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta


//TODO add check login

$response=0;
if(isset($_FILES['file']['name'])){
    $filename = $_FILES['file']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);
 
    // Valid extensions
    $valid_ext = array("jpg","png","jpeg");
 
    if(in_array($file_extension,$valid_ext)){
       $location = "./img/test.".$file_extension; //TODO gestire i nomi tipo con l id post pero prima dovrei creare il post e ritornare l id e poi mettere l url e aggiornare il db
       if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
          $response = 1;
          //TODO insert in db cosi che siamo sicuri che l imagine é stata caricata e se l inser va male cancellare l immagine
          //Magari salvarla con un nome temporaneo e poi appena il db risponde metterci il nome con l id post 
          $testo = isset($_POST['testo']) ? $_POST['testo']: "";
          $luogo= isset($_POST['luogo']) ? $_POST['luogo']: ""; 
       } 
    }

    
    header('Content-Type: application/json');
    echo json_encode($response);
}else if(isset($_POST['testo'])){
    $luogo= isset($_POST['luogo']) ? $_POST['luogo']: ""; 
    
}else{
    //$js_add_post = "js/add_post.js";
    require("./template/add_post.php");
}



?>