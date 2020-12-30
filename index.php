<?php
$url = '';

if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);
}

if (isset($url[0])) {
    $page = $url[0];
} else {
<<<<<<< HEAD
    $page = 'home';
}


// Si c'est pas un page
if (!in_array($page, array('connexion','user','page3', 'article'))) {
    if (in_array($page, array('home','contact','propos', 'mentions'))) {
        ob_start();
        require "static/$page.php";
=======
    $module = 'home';
}

// Si c'est pas un module
if (!in_array($module, array('connexion','module2','module3'))) {
    if (in_array($module, array('home','contact','propos', 'mentions'))) {

        ob_start();
        require "static/$module.php";
>>>>>>> main
        $pageContent = ob_get_clean();
        require 'layout.php';
    } else {
        echo "Aucun acces";
        http_response_code(403);
        die;
    }
} else {
    ob_start();
    require "modules/$page/mod_$page.php";
    $pageContent = ob_get_clean();
    require 'layout.php';
}

?>