<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title><?php echo $pagetitle; ?> - <?php echo Config::getWebsiteName();?></title>
		<link rel="icon" type="image/x-icon" href="favicon.ico" />
		<link rel="stylesheet" href="style/default.css?v=<?=time();?>" type="text/css" title="default" media="screen" />
		<script type="text/javascript" src=""></script>
		<?php $taille_colonne_gauche=18; ?>
	</head>
		
	<body>
	
		<header>
		
			<table border=0 height="100%" width="100%" cellSpacing="0">
		
				<tr height="90">
				
					<td width="<?php echo $taille_colonne_gauche; ?>%" align="center" style="BORDER-RIGHT: #6593b5 2px solid;">
						<a href="https://www.insa-toulouse.fr"><img src="style/logos/insa_logo.gif"></a>
					</td>
					
					<td align="center" style="BORDER-BOTTOM: #6593b5 2px solid;">
						<h1>Espace Projet Tutoré</h1>
					</td>
					
				</tr>
				
			</table>
		
		</header>
		
		<main>

			<table border=0 height="100%" width="100%" cellSpacing="0">
		
				<tr valign="top">
				
					<td width="<?php echo $taille_colonne_gauche; ?>%" style="BORDER-BOTTOM: #6593b5 2px solid;BORDER-RIGHT: #6593b5 2px solid;">
						
						<br>
							<a class="button" href="index.php?action=accueil">Accueil</a>
							
						<?php if (isset($_SESSION['account']['qqchose']) && $_SESSION['account']['qqchose']!=NULL) { ?>
						
							<a class="button" href="index.php?action=profil">Mon Profil</a>
							<a class="button" href="index.php?controller=project">Liste des Projets</a>
							<a class="button" href="index.php?logout=">Se déconnecter</a>
							
							<?php if ($_SESSION['account']['type']!='teacher') { ?>
								<a class="button_admin" href="index.php?switch=teacher">Passer en mode Enseignant</a>
							<?php } ?>
							<?php if ($_SESSION['account']['type']!='student') { ?>
								<a class="button_admin" href="index.php?switch=student">Passer en mode Etudiant</a>
							<?php } ?>
							
							
						<?php } ?>
						
						<?php if (!isset($_SESSION['account']['qqchose']) || $_SESSION['account']['qqchose']==NULL) { ?>
						
							<a class="button" href="index.php?login=">Se connecter</a>
						<?php } ?>	
						
						<br>
						
					</td>
					
					<td style="BORDER-BOTTOM: #6593b5 2px solid;PADDING-LEFT: 10px;PADDING-RIGHT: 10px;PADDING-BOTTOM: 10px;">

						<?php if (isset($notif_error)){ ?>
							<br>
							<div class="notification-error">
								<a href="" id="close"><img src="./style/buttons/cross.png" style="float:right;padding-top:4px;padding-right:5px;"></img></a>
								<p style="text-align:center"><?php echo $notif_error; ?></p>
							</div>
						<?php } ?>
					
						<?php if (isset($notif_warning)){ ?>
							<br>
							<div class="notification-info">
								<a href="" id="close"><img src="./style/buttons/cross.png" style="float:right;padding-top:4px;padding-right:5px;"></img></a>
								<p style="text-align:center"><?php echo $notif_warning; ?></p>
							</div>
						<?php } ?>
					
						<?php if (isset($notif_success)){ ?>
							<br>
							<div class="notification">
								<a href="" id="close"><img src="./style/buttons/cross.png" style="float:right;padding-top:4px;padding-right:5px;"></img></a>
								<p style="text-align:center"><?php echo $notif_success; ?></p>
							</div>
						<?php } ?>
					
						<?php
							$filename = "view" . ucfirst ( $controller ) . ucfirst ( $view ) . '.php';
							require "{$ROOT}{$DS}view{$DS}{$filename}";
						?>
					
					</td>
				</tr>
			</table>
		
		</main>

		<footer>
			<p style="text-align:right;padding-right:3em;">Powered by Mega Technologies ©</p>
		</footer>
		
		<script type="text/javascript" src="script/notificationClose.js?v=<?=time();?>"></script>
		
	</body>
	
</html>