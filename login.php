<?php
require_once 'bootstrap.php';


$templateParams['js'] = array("https://unpkg.com/axios/dist/axios.min.js", "js/login.js");
$templateParams['title'] = 'Log-in';

require 'template/login-base.php';


?>