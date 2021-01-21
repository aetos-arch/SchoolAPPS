<?php

require_once 'modules/generique/modele_generique.php';

class ModeleContact extends ModeleGenerique
{
	public function __construct()
	{
	}
	
	public function envoiMail ($result) {
		$from = 'nico.ts@hotmail.fr';
		$to = $result['email'];
		$subject = $result['sujet'];
		$message = $result['message'];
		$headers = "De :" . $from;
		mail($to,$subject,$message, $headers);
	}
}
