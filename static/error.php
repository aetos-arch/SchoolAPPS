<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text&family=Open+Sans&family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">
    <title><?= $pageTitle ?? 'School Apps' ?></title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0f2df055dd.js" crossorigin="anonymous"></script>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/error.css" rel="stylesheet">
</head>

<body>
    <?php require 'include/inc_header.php' ?>
    <main id="404-error">
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info">Erreur <?php echo (isset($error)) ? $error : 'inconnu'; ?></div><br>
                <h1 class="big-info" id="error-h1">Oups, il semblerait que cette page n'existe pas ...</h1>
            </div>
            <a class="big-info btn btn-outline-success" href="home">Me ramener à l'accueil</a>
        </div>
    </main>
    <?php require 'include/inc_footer.php' ?>
</body>

</html>