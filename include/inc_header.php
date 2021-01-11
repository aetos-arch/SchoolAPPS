<header class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a href="/home" id="brand-homelink">
            <img id="logo" src="../images/logo.svg" alt="Logo du site" />
            <span>La référence de l'éducation</span>
        </a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/home">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Logiciels
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="schooldev">School Dev</a>
                        <a class="dropdown-item" href="schoolnet">School Net</a>
                        <a class="dropdown-item" href="E-education">Plateforme E-education</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="actualites">Actualités</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="propos">A propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="connexion" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if (!isset($_SESSION['idUtil']) and (!isset($_SESSION['login']))) {
                            echo '
                                    <a class="dropdown-item" href="connexion">Se connecter</a>
                                    <a class="dropdown-item" href="connexion">S\'inscrire</a>';
                        }else {
                            echo '
                                    <p class="dropdown-item">'.$_SESSION['login'].'</p>
                                    <a class="dropdown-item" href="connexion">Test</a>
                                    <a class="dropdown-item" href="connexion/deconnexion">Se déconnecter</a>';
                        }
                        ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="panier"><i class="fas fa-shopping-cart"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>