<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $pageTitle ?? 'School Apps'?></title>
    <link href="/css/style.css" rel="stylesheet">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<?php require 'include/header.php' ?>

<?= $pageContent ?>

<?php require 'include/footer.php' ?>

<?= $pageJavaScripts ?? ''?>
</body>
</html>