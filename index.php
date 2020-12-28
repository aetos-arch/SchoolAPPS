<?php
$url = '';

if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);
}

if (isset($url[0])) {
    $module = $url[0];
} else {
    $module = "pageAccueil";
}

if (!in_array($module, array('test','module2','module3'))){
    echo "Aucun acces";
    http_response_code(403);
    die;
}

ob_start();
require "modules/$module/mod_$module.php";
$pageContent = ob_get_clean();
require 'layout.php';
?>