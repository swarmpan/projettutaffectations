function deleteIntervention(id,url){
	
	event.preventDefault();
	
	if (confirm("\nVoulez-vous vraiment supprimer ce projet ?\n\nCette opération sera irréversible.\n")){
		
		var formulaire = document.createElement("form");
		formulaire.setAttribute("action",url);
		formulaire.setAttribute("method","post");
		formulaire.innerHTML='<input type="hidden" name="action" value="Supprimer le Projet" /><input type="hidden" name="id" value="'+id+'" />';
		document.querySelector('main').appendChild(formulaire);
		formulaire.submit();
	}
	
}

var deleteButtons = [].slice.call(document.querySelectorAll('input[value=Supprimer]'));

if (deleteButtons.length!=0) for (var i=0;i<deleteButtons.length;i++){
	(function (i) {
		deleteButtons[i].addEventListener("click",function () {deleteIntervention(deleteButtons[i].parentNode.parentNode.id,"index.php?controller=project");});
	}(i));
}
