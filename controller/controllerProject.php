<?php
require_once ("{$ROOT}{$DS}model{$DS}modelProject.php");

if (!isset($_GET['action'])) $action = ""; 
else $action = $_GET['action'];

// JE VERIFIE AU CAS OU QU'UN MALIN N'ESSAYE PAS DE RENTRER SANS AUTORISATION ICI
if (!isset($_SESSION['account']))
		Model::mainPage();
	
// -------------------------- JE TRAITE LES ENTREES DE FORMULAIRES ------------------------------
if (isset($_POST['action'])){
	
	if ($_POST['action']=='Ajouter le Projet'){
		
		$project = new ModelProject(NULL,CAS::getUser(),$_POST['name'],$_POST['description'],$_POST['nbMinStudent'],$_POST['nbMaxStudent'],$_POST['nbMaxGroup']);
		$res = $project->save();
			
		if ($res == '')
			$notif_success = "Projet ajouté";
		else
			$notif_error = 'Erreur : '.$res;
	}
	
	else if ($_POST['action']=='Supprimer le Projet'){
		
		ModelProject::delete($_POST['id']);
		$notif_success = "Projet supprimé";
	
	}
	
}
// ----------------------------- JE SUIS PRET A FAIRE LE RESTE ---------------------------------

switch ($action) {
		
	case "wish":
	
		// Saisie des voeux pour les étudiants
		
		$pagetitle = "Saisie des voeux";
		$view = 'All';
		break;
	
	default:
	
		if ($_SESSION['account']['type']!='student'){
			$myprojects = ModelProject::getProjectByTutor(CAS::getUser());
			$projects = ModelProject::getProjectByNotTutor(CAS::getUser());
			$color = 0;
		
			$pagetitle = "Liste des Projets";
			$view = 'AllTeacher';
		}
	
		else{
			$projects = ModelProject::getAllOrderByName();
			$color = 0;
		
			$pagetitle = "Liste des Projets";
			$view = 'AllStudent';
		}
	
}


require ("{$ROOT}{$DS}view{$DS}view.php");
?>