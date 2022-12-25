<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta

$result["logineseguito"] = false;

sleep(3); //per test spinner in login page

if(isset($_POST['email'], $_POST['password'])) { 
    $email = $_POST['email'];
    $password = $_POST['password']; // Recupero la password criptata.
    if($dbh->login($email, $password) == true) {
      //Login eseguito
       //echo 'Success: You have been logged in!';
       $result["logineseguito"] = true;
    } else {
      //Login fallito
       $result["errorelogin"] = "utente o password errati"; 
       //header('Location: ./login.php?error=1');
    }
 } else { 
   //Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    $result["errorelogin"] = "utente o password mancanti";
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