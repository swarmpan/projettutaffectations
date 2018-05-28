///////////////////////////// PARTIE DESCRIPTION \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

function showDescription(shortDescription){
	
	event.preventDefault();
	
	if (hideButtons.length!=0) for (var i=0;i<hideButtons.length;i++){
		(function (i) {
			hideButtons[i].parentNode.parentNode.className="hidden";
		}(i));
	}
	
	if (showButtons.length!=0) for (var i=0;i<showButtons.length;i++){
		(function (i) {
			showButtons[i].parentNode.parentNode.className="";
		}(i));
	}
	
	shortDescription.className="hidden";
	
	document.querySelector("span[name=longDescription][id=\'"+shortDescription.id+"\']").className="";
	
}

function hideDescription(longDescription){
	
	event.preventDefault();
	
	longDescription.className="hidden";
	
	document.querySelector("span[name=shortDescription][id=\'"+longDescription.id+"\']").className="";
	
}

var showButtons = [].slice.call(document.querySelectorAll('input[value=Show]'));
var hideButtons = [].slice.call(document.querySelectorAll('input[value=Hide]'));

if (showButtons.length!=0) for (var i=0;i<showButtons.length;i++){
	(function (i) {
		showButtons[i].addEventListener("click",function () {showDescription(showButtons[i].parentNode.parentNode);});
	}(i));
}

if (hideButtons.length!=0) for (var i=0;i<hideButtons.length;i++){
	(function (i) {
		hideButtons[i].addEventListener("click",function () {hideDescription(hideButtons[i].parentNode.parentNode);});
	}(i));
}

