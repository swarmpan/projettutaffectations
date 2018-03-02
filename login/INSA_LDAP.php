<?php

	require_once("CAS.php");

	// Parametres de LDAP
	define('LDAP_SERVER', "srv-ldap1");
	define('LDAP_PORT', 389);// ou 8389 | securisé ?;
	define('LDAP_BASE', "ou=people, dc=insa-toulouse, dc=fr");


	function INSA_LDAP_info() {
		require_once("LDAP.php");

		ini_set("display_errors", 1);

		$ldap = new Ldap_class(LDAP_SERVER, LDAP_PORT, LDAP_BASE);
		$uid = phpCAS::getUser();
		$data=$ldap->fetch("uid=".$uid,array("mail","givenName","sn","eduPersonAffiliation","supannCivilite"));    
		return $data;
	}


	function get($tab, $label) {
		return $tab["0"][$label]["0"];
	}

	function INSA_LDAP_parse($data) {

		return array(
			"civilite" 	=> get($data, "supanncivilite"),
			"nom" 		=> get($data, "sn"),
			"prenom" 	=> get($data, "givenname"),
			"mail" 		=> get($data, "mail"),
			"type" 		=> get($data, "edupersonaffiliation")
		);
	}



?>
