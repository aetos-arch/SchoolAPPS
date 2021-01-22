<?php

if (!isset($_SESSION['login']) && !isset($_SESSION['idUtil']) && !isset($_SESSION['idTypeUtilisateur'])) {
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
if (!in_array($page, array('connexion', 'utilisateur', 'technicien', 'admin', 'panier', 'avis', 'contact', 'produits'))) {
    // Si c'est une page static
    if (in_array($page, array('home', 'propos', 'mentions', 'articles', 'article1', 'article2', 'article3', 'schoolDev', 'schoolNet', 'E-education', 'test'))) {
        ob_start();
        $pageTitle = ucfirst($page) . ' - School APPS';
        require "static/$page.php";
        $pageContent = ob_get_clean();
        require 'layout.php';
    } else { // Ni module ni page static
        $error = '404';
        require "static/error.php";
        http_response_code(404);
        die;
    }
} else { // Module
    $pageTitle = ucfirst($page) . ' - School APPS';
    ob_start();
    require "modules/$page/mod_$page.php";
    $pageContent = ob_get_clean();
    require 'layout.php';
}
