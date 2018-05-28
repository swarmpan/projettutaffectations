<?php

class Security {

	static function chiffrer($texte_en_clair) {
		$texte_en_clair .= Config::getSeed();
	  	$texte_crypte = hash('sha256', $texte_en_clair);
	  	return $texte_crypte;
	}

	static function generateRandomHex() {
	  	// Generate a 32 digits hexadecimal number
	  	$numbytes = 8; // Because 32 digits hexadecimal = 16 bytes
	  	$bytes = openssl_random_pseudo_bytes($numbytes); 
	  	$hex   = bin2hex($bytes);
	  	return $hex;
	}

}