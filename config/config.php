<?php
class Config {

	static private $databases = array(
		'hostname' => 'localhost',
		'database' => 'projet_tutore',
		'login'    => 'projet_tutore',
		'password' => 'projet_tutore'
	);
	static public function getLogin(){return self::$databases['login'];}
	static public function getHostname(){return self::$databases['hostname'];}
	static public function getDatabase(){return self::$databases['database'];}
	static public function getPassword(){return self::$databases['password'];}
	
	static private $seed = 'apresMonMdp';
	static public function getSeed() {
	  return self::$seed;
	}
  
	static private $debug = True; 
	static public function getDebug() {
		return self::$debug;
	}
	
	static private $website_name = "Projet Tutoré"; 
	static public function getWebsiteName() {
		return self::$website_name;
	}
	
	static private $website_url = "http://localhost/projet_tutore"; 
	static public function getWebsiteURL() {
		return self::$website_url;
	}
	
	
   
}
?>
