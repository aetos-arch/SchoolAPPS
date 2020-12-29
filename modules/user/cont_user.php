<?php
	require_once 'vue_user.php';
	require_once 'modele_user.php';

	class ContUser{
		private $vue;
		private $modele;


		public function __construct(){
			$this->vue = new  VueUser ();
			$this->modele = new  modeleUser();
		}


		public function ticket () {
			$this->vue->ticket();
			if(isset($_POST['explication'])){
					$intitule = htmlspecialchars($_POST['explication']);
					$explication = htmlspecialchars($_POST['explication']);
					$result = htmlspecialchars($_POST['explication']);
					$this->modele->ticket($result);

			}
		}

		public function printCommandes() {
			$commandes = $this->modele->getCommandes($_SESSION['idUtil']);
			$this->vue->printCommandes($commandes);
		}


		public function newPseudo(){
			$this->vue->newPseudo();
			if(isset($_POST['newPseudo'])){
					$newPseudo = htmlspecialchars($_POST['newPseudo']);
					if($this->modele->pseudoExiste($newPseudo) != 0){
						// pseudo existe déjà
						header('');
						exit();
					}
					else {
						$this->modele->setPseudo($_SESSION['idUtil'], $newPseudo);
						$_SESSION['nomUser'] = $newPseudo;
						header('');
						exit();
					}
			}
		}

		public function newPass(){
			$this->vue->newPass();
			if(isset($_POST['new_password2'])) {

					$newPass1 = $_POST['new_password1'];
					$newPass2 = $_POST['new_password2'];

					if($newPass1==$newPass2) {
						$passBD = $this->modele->getPassword($_SESSION['idUtil']);
						if(password_verify($_POST['old_password'], $passBD)) {
							$newPass=password_hash($newPass1,  PASSWORD_BCRYPT);
							$this->modele->setPass($newPass, $_SESSION['idUtil']);
							header('');
							exit();
						}
					}
			}
		}


		public function menu() {
			$this->vue->printMenu();
		}
}
?>
