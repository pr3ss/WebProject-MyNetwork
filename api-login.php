<?php
require_once 'bootstrap.php'; 

$result["logineseguito"] = false;
if(isset($_POST['email'], $_POST['password'])) { 
    $email = $_POST['email'];
    $password = $_POST['password']; // Recupero la password criptata.
    if($dbh->login($email, $password) == true) {
      //Login eseguito
       $result["logineseguito"] = true;
    } else {
      //Login fallito
       $result["errorelogin"] = "utente o password errati"; 
    }
 } else { 
   //Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    $result["errorelogin"] = "utente o password mancanti";
 }

header('Content-Type: application/json');
echo json_encode($result);





?>