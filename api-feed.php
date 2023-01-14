<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta


$user = $_SESSION["username"];
$templateParams['posts']=array(array("user"=>$user), array("user"=>"Simone"),array("user"=>"Alex")) ; //db call


require("./template/post.php");






?>