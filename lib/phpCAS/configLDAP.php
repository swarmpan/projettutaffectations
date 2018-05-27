<?php
class ConfigLDAP {
	
	static private $LDAP_SERVER = "srv-ldap1"; //"srv-ldap1"
	static public function getServer() {
	  return self::$LDAP_SERVER;
	}
  
	static private $LDAP_PORT = 389; //389 ou 8389
	static public function getPort() {
		return self::$LDAP_PORT;
	}
	
	static private $LDAP_BASE = "ou=people, dc=insa-toulouse, dc=fr"; //"ou=people, dc=insa-toulouse, dc=fr"
	static public function getBase() {
		return self::$LDAP_BASE;
	}
   
}
?>
