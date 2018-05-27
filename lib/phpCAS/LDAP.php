<?php

/**
 * Classe d'abstraction pour se connecter et interroger un annuaire
 * LDAP.
 *
 */

class Ldap_Class {

/**
 * @var $ldap attribut de la classe (connexion courante)
 * @var $ldap attribut rdn sous sa forme partielle
 */
	var $ldap;
	var $rdn;
	
/**
 * Constructeur
 * @param string $ldaphost
 * @param string $ldapport
 * @param string $ldaprdn
 */
	function Ldap_Class($ldaphost, $ldapport, $ldaprdn)
	{
		$this->ldap = ldap_connect($ldaphost, $ldapport) or die('Impossible de se connecter au serveur LDAP.');
		$this->rdn  = $ldaprdn;
		
		if (ldap_set_option($this->ldap, LDAP_OPT_PROTOCOL_VERSION, 3)) {
   	 	//echo "Utilisation de LDAPv3 \n";
 		} 	else {
    		echo "Impossible d'utiliser LDAP V3\n";
  	  	exit;
 		}
	}
	
/**
 * Methode permettant d'effectuer une authentification LDAP
 * @param string $login
 * @param string $password
 * @param string $mode 0=normal, 1=test
 * @return boolean $allowed
 */
	function bind($login, $password, $mode)
	{
		$ldaprdn = "uid=$login, " . $this->rdn;		
		if ($this->ldap) {
			// Bind au serveur LDAP
			return @ldap_bind($this->ldap, $ldaprdn, $password);
		} else { // Pas de connexion a l'annuaire
			return false;
		}
	}
	
/**
 * Methode permettant d'effectuer une recherche dans l'annuaire LDAP
 * et de recuperer les resultats sous la forme d'un tableau associatif.
 *
 * Cette methode est un wrapper combinant ldap_search et ldap_get_entries.
 * Les attributs de l'objet ($this->ldap, $this->rdn) sont reutilises.
 *
 * @param string $filter
 * @param array $attr
 * @return mixed $results
 */
	function fetch($filter, $attr)
	{
		if ($this->ldap) {
			// Recherche dans l'annuaire LDAP
			$sr   = ldap_search($this->ldap, $this->rdn, $filter, $attr);
			$info = ldap_get_entries($this->ldap, $sr);
			if ($info && ($info['count'] > 0))
				return $info;
			else {
				echo "else de la recherche dans l'annuaire dans fetch ";
				return false;
			}
		} else { // Pas de connexion a l'annuaire
			echo "else pas de connexion dans fetch " ;
			return false;
		}
	}

/**
 * Methode permettant de fermer la connexion a l'annuaire
 */
	function close()
	{
		if ($this->ldap) {
			ldap_close($this->ldap);
		}
	}
}
