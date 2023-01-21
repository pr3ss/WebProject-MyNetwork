<?php
require_once 'bootstrap.php'; //comprende avvio sessione protteta

//sleep(1.5); //for testing
$my_user_id = $_SESSION["user_id"];
//$templateParams['posts']=array(array("user"=>$user), array("user"=>"Simone"),array("user"=>"Alex")) ; //db call



if(isset($_POST['cat_changed']) && $_POST['cat_changed']=="true"){
    $_SESSION["categoria_corrente"] = $_POST['categoria'];
    $_SESSION["last_post"] = time();
}

$num_post = 5; //default
if(isset($_POST["num_post"])) $num_post = $_POST["num_post"];


$templateParams['posts'] = $dbh->load_posts_for($my_user_id, $_SESSION["categoria_corrente"], $_SESSION["last_post"], $num_post);
$cout_post = count($templateParams['posts']);
if ($cout_post != 0){
    $_SESSION["last_post"] = $templateParams['posts'][$cout_post-1]["data_ora"];
}



require("./template/post.php");


?>