<?php

require_once 'modules/generique/cont_generique.php';
require_once 'vue_contact.php';
require_once 'modele_contact.php';

class ContContact extends ContGenerique
{

	public function __construct()
	{
		parent::__construct(new ModeleContact(), new VueContact());
    }
    
    public function pageContact () {
        $this->vue->pageContact();
    }

    public function envoiMail () {
        try {
            $result = [
				'name' => addslashes(strip_tags($_POST['name'])),
				'prenom' => addslashes(strip_tags($_POST['prenom'])),
				'email' => addslashes(strip_tags($_POST['email'])),
				'message' => addslashes(strip_tags($_POST['message']))
			];
            $this->verifTableauValeurNull($result);
            $this->modele->envoiMail($result);
            $this->vue->confirmationEnvoiMail();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}