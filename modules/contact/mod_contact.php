<?php

require_once 'modules/generique/mod_generique.php';
require_once 'cont_contact.php';

class ModContact extends ModGenerique
{

	public function __construct($url)
	{
        $controllContact = new ContContact();
		{
			if (isset($url[1])) {
				$action = $url[1];
				switch ($action) {
					case 'envoi-mail':
						$controllContact->envoiMail();
						break;
					default:
						$controllContact->actionInexistante();
						break;
				}
            }
            else {
                $controllContact->pageContact();
            }
        }

    }

}
?>

<?php
    $modContact = new ModContact((isset($url)) ? $url : null);
?>