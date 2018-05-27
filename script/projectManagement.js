var ajouter      = document.querySelector('input[id=ajouter]');
var annulerAjout = document.querySelector('input[id=annulerAjout]');
var validerAjout = document.querySelector('input[id=validerAjout]');
var table        = document.querySelector('tr[id=form]');

var namee          = document.querySelector('input[name=name]');
var description   = document.querySelector('textarea[name=description]');
var nbMinStudent  = document.querySelector('input[name=nbMinStudent]');
var nbMaxStudent  = document.querySelector('input[name=nbMaxStudent]');
var nbMaxGroup    = document.querySelector('input[name=nbMaxGroup]');


ajouter.addEventListener('click',function () {
	
	event.preventDefault();
	
	ajouter.className='hidden';
	
	annulerAjout.className='';
	table.className='';
	
	namee.value='';
	description.value='';
	nbMinStudent.value='';
	nbMaxStudent.value='';
	nbMaxGroup.value='';
	
});

annulerAjout.addEventListener('click',function () {
	
	event.preventDefault();
	
	annulerAjout.className='hidden';
	table.className='hidden';
	
	ajouter.className='';
	
});

function stopFromValidate(e){
	var key=e.which || e.keyCode;if (key === 13) event.preventDefault();
}

namee.addEventListener('keypress',function (e) {stopFromValidate(e);});
nbMinStudent.addEventListener('keypress',function (e) {stopFromValidate(e);});
nbMaxStudent.addEventListener('keypress',function (e) {stopFromValidate(e);});
nbMaxGroup.addEventListener('keypress',function (e) {stopFromValidate(e);});
