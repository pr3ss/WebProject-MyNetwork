<?php
require_once 'bootstrap.php';


$templateParams['title'] = 'Sign-in';  
$templateParams['js'] = array("https://unpkg.com/axios/dist/axios.min.js", "js/signin.js", "js/sha512.js");
$templateParams['form'] = "signin-form.php";

require 'template/login-base.php';




?>