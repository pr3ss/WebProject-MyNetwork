<?php
require_once 'bootstrap.php';
require_once 'functions.php';

sec_session_start(); //avvio sessione protetta


function checkbrute($user_id, $mysqli) {
    // Recupero il timestamp
    $now = time();
    // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
    $valid_attempts = $now - (2 * 60 * 60); 
    if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) { 
       $stmt->bind_param('i', $user_id); 
       // Eseguo la query creata.
       $stmt->execute();
       $stmt->store_result();
       // Verifico l'esistenza di più di 5 tentativi di login falliti.
       if($stmt->num_rows > 5) {
          return true;
       } else {
          return false;
       }
    }
}


$result["logineseguito"] = false;

if(isset($_POST['email'], $_POST['password'])) { 
    $email = $_POST['email'];
    $password = $_POST['password']; // Recupero la password criptata.
    if(login($email, $password, $mysqli) == true) {
       // Login eseguito
       //echo 'Success: You have been logged in!';
       $result["logineseguito"] = true;
    } else {
       // Login fallito
       //header('Location: ./login.php?error=1');
    }
 } else { 
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    //echo 'Invalid Request';
 }



/*if(isUserLoggedIn()){
    $result["logineseguito"] = true;
    $result["articoliautore"] = $dbh->getPostByAuthorId($_SESSION["idautore"]);
    for($i = 0; $i < count($result["articoliautore"]); $i++){
        $result["articoliautore"][$i]["imgarticolo"] = UPLOAD_DIR.$result["articoliautore"][$i]["imgarticolo"];
    }
    
}*/

header('Content-Type: application/json');
echo json_encode($result);





?>