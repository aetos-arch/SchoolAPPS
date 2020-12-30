<?php
$url = '';

if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);
}

if (isset($url[0])) {
    $module = $url[0];
} else {
    $module = 'home';
}

// Si c'est pas un module
if (!in_array($module, array('connexion','module2','module3'))) {
    if (in_array($module, array('home','contact','propos', 'mentions'))) {

        ob_start();
        require "static/$module.php";
        $pageContent = ob_get_clean();
        require 'layout.php';
    } else {
        echo "Aucun acces";
        http_response_code(403);
        die;
    }
} else {
    ob_start();
    require "modules/$module/mod_$module.php";
    $pageContent = ob_get_clean();
    require 'layout.php';
}

?>