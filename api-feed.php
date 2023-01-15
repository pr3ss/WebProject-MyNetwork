<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta

sleep(1); //for testing
$user = $_SESSION["username"];
$templateParams['posts']=array(array("user"=>$user,"data"=> "10/10/10"), array("user"=>"Simone"),array("user"=>"Alex")) ; //db call


require("./template/post.php");






?>