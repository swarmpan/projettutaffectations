<h2><?php echo $pagetitle; ?></h2>
	
<p><b>Login : </b><?php echo CAS::getUser(); ?></p>
<p><b>Type : </b><?php echo ($_SESSION['account']['type']=='student') ? "Etudiant" : "Enseignant"; ?></p>

<?php if(strpos(Config::getWebsiteURL(),"insa-toulouse.fr") !== false){ ?>

	<p><b>Genre : </b><?php echo ($_SESSION['account']['civilite'] == 'M.') ? "Masculin" : "Féminin"; ?></p>
	<p><b>Nom : </b><?php echo $_SESSION['account']['nom']; ?></p>
	<p><b>Prénom : </b><?php echo $_SESSION['account']['prenom']; ?></p>
	<p><b>Mail : </b><?php echo $_SESSION['account']['mail']; ?></p>
		
<?php } ?>


