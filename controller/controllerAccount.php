<?php
require_once ("{$ROOT}{$DS}model{$DS}modelAccount.php");

if (!isset($_GET['action'])) $action = ""; 
else $action = $_GET['action'];

// NOUVEL ADMIN S'IL N'Y EN A PAS ENCORE
if (isset($_SESSION['account']['type']) && $_SESSION['account']['type']!='student'){
	require_once ("{$ROOT}{$DS}model{$DS}modelConfig.php");
	$res = ModelConfig::updateAdmin(CAS::getUser());
	if ($res!="") $notif_success = $res;
}
	
// CAS OU L'UTILISATEUR EST CONNECTE

if (isset($_SESSION['account']['type']) && $_SESSION['account']['type']!=NULL) switch ($action) {
	
	case "accueil":

		$pagetitle = "Accueil";
		$view = 'Accueil';

		break;
		
	default:
		
		$login = CAS::getUser();
		
		$pagetitle = "Profil";
		$view = 'Profil';
	
}

else {
	$pagetitle = "Accueil";
	$view = 'Accueil';	
}


require ("{$ROOT}{$DS}view{$DS}view.php");
?>