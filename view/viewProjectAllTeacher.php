<h2><?php echo $pagetitle; ?></h2>

<form action="index.php?controller=project" method="post">

	<h3>Vos Propositions de Projets
		<input class="<?php echo (isset($notif_error) && isset($_POST['action']) && $_POST['action']=='Ajouter le Projet') ? 'hidden' : ''; ?>" id="ajouter" style="margin-left:20px;width:70px;" type="submit" value="Ajouter">
		<input class="<?php echo (isset($notif_error) && isset($_POST['action']) && $_POST['action']=='Ajouter le Projet') ? '' : 'hidden'; ?>" id="annulerAjout" style="margin-left:20px;width:70px;" type="submit" value="Annuler">
	</h3>
	
	<table style='width:100%; border:0px solid black;'>
		<tr bgcolor='#CCC'>
			<td class="projet name">Nom</td>
			<td class="projet desc">Description</td>
			<td class="projet stud">Nombre d'Eleves</td>
			<td class="projet grp">Nombre Max Groupes</td>
			<td class="projet act">Actions</td>
		</tr>
		
		<tr id='form' class='<?php echo (isset($notif_error) && isset($_POST['action'])) ? '' : 'hidden'; ?>' bgcolor='#EEE'>
			<td class="projet name"><input value="<?php if(isset($_POST['name'])) echo $_POST['name'] ; ?>" name="name" type="text"  style="width:99%;" required></td>
			<td class="projet desc"><textarea name="description" style="width:99%;height:100px;" required><?php if(isset($_POST['description'])) echo $_POST['description'] ; ?></textarea></td>
			<td class="projet stud">
				De <input value="<?php if(isset($_POST['nbMinStudent'])) echo $_POST['nbMinStudent'] ; ?>" name="nbMinStudent" type="number" step="1" min="0" style="width:30%;" required>
				à <input value="<?php if(isset($_POST['nbMaxStudent'])) echo $_POST['nbMaxStudent'] ; ?>" name="nbMaxStudent" type="number" step="1" min="0" style="width:30%;" required>
			</td>
			<td class="projet grp"><input value="<?php if(isset($_POST['nbMaxGroup'])) echo $_POST['nbMaxGroup'] ; ?>" name="nbMaxGroup" type="number" step="1" min="0" style="width:95%;" required></td>
			<td class="projet act"><input id="validerAjout" name="action" style="width:140px;" type="submit" value="Ajouter le Projet"></td>
		</tr>
		
<?php if (count($myprojects)==0) { ?>
	</table>
<h3 style='text-align:center;'>Aucun projet à afficher</h3>
<?php } else { ?>

		
	<?php foreach ($myprojects as $myproject) { ?>
		
		<tr bgcolor='<?php echo ($color%2 != 0) ? '#EEE' : ''; $color++; ?>' id="<?php echo $myproject->getIDProject(); ?>">
			<td class="projet name"><?php echo $myproject->getName(); ?></td>
			<td class="projet desc">
				<!-- #ONSEARETEICI -->
				<span><?php echo nl2br($myproject->getShortDescription()); ?><p style="text-align:center;margin:0px;margin-top:8px"><input type="submit" id="<?php echo $myproject->getIDProject();?>" value="Show"></p></span>
				<span class="hidden"><?php echo nl2br($myproject->getDescription()); ?><p style="text-align:center;margin:0px;margin-top:8px"><input type="submit" id="<?php echo $myproject->getIDProject();?>" value="Hide"></p></span>
			</td>
			<td class="projet stud"><?php echo ($myproject->getNbMinStudent() != $myproject->getNbMaxStudent()) ? 'De <b>'.$myproject->getNbMinStudent().'</b> à <b>'.$myproject->getNbMaxStudent().'</b>' : '<b>'.$myproject->getNbMaxStudent().'</b>'; ?></td>
			<td class="projet grp"><?php echo $myproject->getNbMaxGroup(); ?></td>
			<td class="projet act">
				<input id="modifier" style="width:75px;" type="submit" value="Modifier">
				<input id="supprimer" style="width:75px;" type="submit" value="Supprimer">
			</td>
		</tr>
			
	<?php } ?>
	
	</table>
<?php } ?>
</form>

<?php $color = 0; ?>

<h3>Autres Projets Proposés</h3>

<table style='width:100%; border:0px solid black;'>
	<tr bgcolor='#CCC'>
		<td class="projet name">Nom</td>
		<td class="projet desc">Description</td>
		<td class="projet stud">Nombre d'Eleves</td>
		<td class="projet grp">Nombre Max Groupes</td>
		<td class="projet act">Tuteur</td>
	</tr>
	
<?php if (count($projects)==0) { ?>
</table>
<h3 style='text-align:center;'>Aucun projet à afficher</h3>
<?php } else { ?>

		
	<?php foreach ($projects as $project) { ?>
		
		<tr bgcolor='<?php echo ($color%2 != 0) ? '#EEE' : ''; $color++; ?>' id="<?php echo $project->getIDProject(); ?>">
			<td class="projet name"><?php echo $project->getName(); ?></td>
			<td class="projet desc"><span><?php echo nl2br($project->getDescription()); ?></span></td>
			<td class="projet stud"><?php echo ($project->getNbMinStudent() != $project->getNbMaxStudent()) ? 'De <b>'.$project->getNbMinStudent().'</b> à <b>'.$project->getNbMaxStudent().'</b>' : '<b>'.$project->getNbMaxStudent().'</b>'; ?></td>
			<td class="projet grp"><?php echo $project->getNbMaxGroup(); ?></td>
			<td class="projet act"><?php echo $project->getIDTutor(); ?></td>
		</tr>
		
	<?php } ?>
	
</table>
<?php } ?>

<script type="text/javascript" src="script/projectDelete.js?v=<?=time();?>"></script>
<script type="text/javascript" src="script/projectManagement.js?v=<?=time();?>"></script>
