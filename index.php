<?php
session_start();
require 'config/config.php';

$ROOT = __DIR__;
$DS = DIRECTORY_SEPARATOR;

// Contrôle CAS
if (isset($_GET['login']) || isset($_SESSION['account'])){
	
	require_once 'lib/CAS/CAS.php';
	CAS::init();
	
	if(strpos(Config::getWebsiteURL(),"insa-toulouse.fr") !== false){
		require_once("lib/LDAP/INSA_LDAP.php");
		$infos = INSA_Ldap_Class::INSA_LDAP_parse(INSA_Ldap_Class::INSA_LDAP_info(CAS::getUser()));
		$_SESSION['account'] = array(
			"login" => CAS::getUser(),
			"type" => (isset($_SESSION['account']['type'])) ? $_SESSION['account']['type'] : 'student',//$infos['type']
			"civilite" => $infos['civilite'],
			"nom" => $infos['nom'],
			"prenom" => $infos['prenom'],
			"mail" => $infos['mail'],
		);
	}
	else{
		$_SESSION['account'] = array(
			"login" => CAS::getUser(),
			"type" => (isset($_SESSION['account']['type'])) ? $_SESSION['account']['type'] : 'student',
		);
	}
	
}

// PROVISOIRE POUR L'ADMINISTRATION
if(isset($_GET['switch']) && $_GET['switch']!='' && $_SESSION['account']['login'] == "mega")
	$_SESSION['account']['type']=$_GET['switch'];

// Attention à bien paramétrer l'URL du site !!! (fichier config)
if(isset($_GET['logout'])){
	
	require_once 'lib/CAS/CAS.php';
	
	session_unset(); 
	session_destroy();
	
	CAS::logout(Config::getWebsiteURL());
	
} 

if (!isset($_GET['controller']) || empty($_GET['controller'])) $controller = "account";
else $controller = $_GET ['controller'];


switch ($controller) {
	case "account" :
		require "{$ROOT}{$DS}controller{$DS}controllerAccount.php";
		break;
	case "project" :
		require "{$ROOT}{$DS}controller{$DS}controllerProject.php";
		break;
	case "test" :
		require "{$ROOT}{$DS}controller{$DS}controllerTest.php";
		break;
	default :
		header('Location: index.php');
		die();
}

?>
