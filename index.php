<?php

if(!isset($_SESSION['login']) && !isset($_SESSION['idUtil']) && !isset($_SESSION['idTypeUtilisateur'])) {
    session_start();
}

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
if (!in_array($page, array('connexion', 'utilisateur', 'technicien', 'admin', 'panier', 'avis'))) {
    // Si c'est une page static
    if (in_array($page, array('home', 'contact', 'propos', 'mentions', 'logiciels', 'actualites', 'schooldev', 'schoolnet', 'E-education'))) {
        ob_start();
        require "static/$page.php";
        $pageContent = ob_get_clean();
        require 'layout.php';
    } else { // Ni module ni page static
        require "static/error404.php";
        http_response_code(403);
        die;
    }
} else { // Module
    ob_start();
    require "modules/$page/mod_$page.php";
    $pageContent = ob_get_clean();
    require 'layout.php';
}