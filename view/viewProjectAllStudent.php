<h3>Projets Proposés</h3>

<table style='width:100%; border:0px solid black;'>
	<tr bgcolor='#CCC'>
		<td class="projet name">Nom</td>
		<td class="projet desc">Description</td>
		<td class="projet stud">Nombre d'Eleves</td>
		<td class="projet grp">Nombre Max Groupes</td>
		<td class="projet tut">Tuteur</td>
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
			<td class="projet tut"><?php echo $project->getIDTutor(); ?></td>
		</tr>
		
	<?php } ?>
	
</table>
<?php } ?>

<script type="text/javascript" src="script/projectManagement.js?v=<?=time();?>"></script>