<?php

require_once("db/database.php");
require_once("utils/functions.php");
sec_session_start(); //avvio sessione protetta

$dbh = new DatabaseHelper("localhost", "dafault_user", "Passtest0.", "web-socialnetwork", 3306);
?>