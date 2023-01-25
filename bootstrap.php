<?php

require_once("db/database.php");
require_once("utils/functions.php");
sec_session_start(); //avvio sessione protetta
define("IMG_DIR", "./img/");
define("NUM_POST_FOR_REQUEST", 5);
define("DEFAULT_CATEGORY", 1);

$dbh = new DatabaseHelper("localhost", "dafault_user", "Passtest0.", "web-socialnetwork", 3306);
?>