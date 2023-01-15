<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta

//sleep(1); //for testing
$my_user_id = $_SESSION["user_id"];
//$templateParams['posts']=array(array("user"=>$user), array("user"=>"Simone"),array("user"=>"Alex")) ; //db call

$templateParams['posts'] = $dbh->load_posts_for($my_user_id);

require("./template/post.php");


?>