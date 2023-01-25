<?php
require_once 'bootstrap.php';

$result["signineseguito"] = false;

if(isset($_POST['email'], $_POST['password'], $_POST['username'], $_POST['nome'], $_POST['cognome'], $_POST['data_nascita'])) { 
    $email = $_POST['email'];
    $password = $_POST['password']; // Recupero la password criptata.
    $username = $_POST['username'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $data_nascita = $_POST['data_nascita'];

    if($dbh->usernameIsPresent($username)) {
       $result["erroresignin"] = "Username giá presente.";  
    } else if ($dbh->emailIsPresent($email)) {
      $result["erroresignin"] = "Email giá registrata.";  
    } else{
      $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
      // Crea una password usando la chiave appena creata.
      $password = hash('sha512', $password.$random_salt);

      if($dbh->signin($email, $password, $username, $random_salt, $nome, $cognome, $data_nascita)){
         $result["signineseguito"] = true;

      } else {
         $result["erroresignin"] = "Errore durante la registrazione. Riprovare.";
      }

    }
 } else { 
      $result["erroresignin"] = "Specificare tutti i dati.";
 }



header('Content-Type: application/json');
echo json_encode($result);





?>