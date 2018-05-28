<?php
	
require_once 'phpCAS/CAS.php';

class CAS {
	
	static function init(){
		// Load the CAS lib
		
		// Enable debugging
		phpCAS::setDebug();
		
		// Enable verbose error messages. Disable in production!
		phpCAS::setVerbose(true);
		
		// Initialize phpCAS
		phpCAS::client(CAS_VERSION_2_0,'cas.insa-toulouse.fr',443,'cas', true);
		
		// For production use set the CA certificate that is the issuer of the cert
		// on the CAS server and uncomment the line below
		// phpCAS::setCasServerCACert($cas_server_ca_cert_path);
		// For quick testing you can disable SSL validation of the CAS server.
		// THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
		// VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
		phpCAS::setNoCasServerValidation();
		
		// force CAS authentication
		phpCAS::forceAuthentication();
		
		// at this step, the user has been authenticated by the CAS server
	}
	
	
	static function getUser() {
		return phpCAS::getUser();
	}
	
	static function getVersion(){
		return phpCAS::getVersion();
	}
	
	static function logout($url){
		phpCAS::logoutWithRedirectService($url);
	}
	
}

?>
