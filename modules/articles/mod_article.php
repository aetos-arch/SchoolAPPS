<?php
require_once 'cont_article.php';

class ModArticle
{

    public function __construct($url)
    {
        $controllArticle = new ContArticle();

        if (isset($url[1])) {
            $action = $url[1];
            switch ($action) {
                case 'liste':
                    $controllArticle->listeArticles();
                    break;
                case 'afficher-article':
                    if (isset($url[2])) {
                        $controllArticle->afficherArticle($url[2]);
                    } else {
                      $controllArticle->actionInexistante();
                    }
                    break;
                default:
                $controllArticle->actionInexistante();
                break;
            }
        } else {
            $controllArticle->listeArticles();
        }
    }
}

?>

<?php
$modarticle = new ModArticle((isset($url)) ? $url : null);
?>