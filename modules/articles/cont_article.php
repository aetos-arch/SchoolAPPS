<?php
require_once 'vue_article.php';
require_once 'modele_article.php';

class ContArticle
{
	private $vue;
	private $modele;


	public function __construct()
	{
		$this->vue = new VueArticle();
		$this->modele = new  ModeleArticle();
	}


    public function listeArticles () {
        $data = $this->modele->getListeArticles();
        $this->vue->afficherArticles($data);
    }

    public function afficherArticle ($url) {
        $data = $this->modele->getArticle($url);
        $this->vue->afficherArticle($data);
    }
}
