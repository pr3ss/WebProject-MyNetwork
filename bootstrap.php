<?php

require_once("db/database.php");
require_once("utils/functions.php");
sec_session_start(); //avvio sessione protetta
define("IMG_DIR", "./img/");

$dbh = new DatabaseHelper("localhost", "dafault_user", "Passtest0.", "web-socialnetwork", 3306);
?>