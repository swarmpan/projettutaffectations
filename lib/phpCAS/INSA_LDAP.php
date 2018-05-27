<?php

require_once "configLDAP.php";

class INSA_Ldap_Class {

	// Parametres de LDAP

	static function INSA_LDAP_info() {
		require_once("LDAP.php");

		ini_set("display_errors", 1);

		$ldap = new Ldap_class(ConfigLDAP::getServer(), ConfigLDAP::getPort(), ConfigLDAP::getBase());
		$uid = phpCAS::getUser();
		$data=$ldap->fetch("uid=".$uid,array("mail","givenName","sn","eduPersonAffiliation","supannCivilite"));    
		return $data;
	}


	static function get($tab, $label) {
		return $tab["0"][$label]["0"];
	}

	static function INSA_LDAP_parse($data) {

		return array(
			"civilite" 	=> INSA_Ldap_Class::get($data, "supanncivilite"),
			"nom" 		=> INSA_Ldap_Class::get($data, "sn"),
			"prenom" 	=> INSA_Ldap_Class::get($data, "givenname"),
			"mail" 		=> INSA_Ldap_Class::get($data, "mail"),
			"type" 		=> INSA_Ldap_Class::get($data, "edupersonaffiliation")
		);
	}
}

?>
