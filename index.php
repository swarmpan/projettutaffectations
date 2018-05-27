<?php
session_start();

$ROOT = __DIR__;
$DS = DIRECTORY_SEPARATOR;

// Contrôle CAS
if (isset($_GET['login']) || isset($_SESSION['account'])){
	
	require_once 'lib/phpCAS/CAS.php';
	CAS::init();
	
	require_once("lib/phpCAS/INSA_LDAP.php");
	//$infos = INSA_Ldap_Class::INSA_LDAP_parse(INSA_Ldap_Class::INSA_LDAP_info());
	//echo $infos['civilite'] ." Nom : " . $infos['nom'] . ", prenom : " . $infos['prenom'] . ", " . $infos['type'] . ", mail : " .$infos['mail'];
	
	$_SESSION['account'] = array(
		"type" => (isset($_SESSION['account']['type'])) ? $_SESSION['account']['type'] : 'student',
		"qqchose" => 'valeur',
	);
}

// PROVISOIRE POUR L'ADMINISTRATION
if(isset($_GET['switch']) && $_GET['switch']!='')
	$_SESSION['account']['type']=$_GET['switch'];


// Juste pour enlever le sigle "login" dans l'URL
if(isset($_GET['login'])){
	
	require_once "model/Model.php";
	Model::mainPage();
	
} 

// Attention à bien paramétrer l'URL du site !!! (fichier config)
if(isset($_GET['logout'])){
	
	require_once 'lib/phpCAS/CAS.php';
	
	session_unset(); 
	session_destroy();
	
	require_once 'config/config.php';
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
