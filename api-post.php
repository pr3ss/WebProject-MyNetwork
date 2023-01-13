<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta



$templateParams["test"] = $_POST['post'];
//js ti inviera l id del post e qui carichiamo tutti i commenti in un templateParams che post.php potra leggere


require("./template/post.php");






?>