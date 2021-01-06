<?php
$url = '';

if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);
}

if (isset($url[0])) {
    $page = $url[0];
} else {
    $page = 'home';
}

// Si c'est pas un page
if (!in_array($page, array('connexion', 'user', 'technicien', 'admin', 'panier', 'avis'))) {
    // Si c'est une page static
    if (in_array($page, array('home', 'contact', 'propos', 'mentions', 'logiciels', 'actualites'))) {
        ob_start();
        require "static/$page.php";
        $pageContent = ob_get_clean();
        require 'layout.php';
    } else { // Ni module ni page static
        echo "Aucun acces";
        http_response_code(403);
        die;
    }
} else { // Module
    ob_start();
    require "modules/$page/mod_$page.php";
    $pageContent = ob_get_clean();
    require 'layout.php';
}