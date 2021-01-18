<?php
require_once 'cont_article.php';

class ModArticle
{

    public function __construct()
    {
        $controllArticle = new ContArticle();

        if (isset($url[1])) {
            $action = $url[1];
            switch ($action) {
                case 'liste':
                    $controllArticle->listeArticles();
                    break;
                case 'afficherArticle':
                    $controllArticle->afficherArticle($url[2]);
                    break;
                default:
                    # code...
                    break;
            }
        } else
            echo '<h3>Aucune connexion trouvée.</h3>';
    }
}

?>

<?php
$modarticle = new ModArticle();
?>