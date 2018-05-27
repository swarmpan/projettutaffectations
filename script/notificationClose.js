var notifs = [].slice.call(document.querySelectorAll('a[id=close]'));

if (notifs.length!=0) for (var i=0;i<notifs.length;i++){
	(function (i) {
		notifs[i].addEventListener("click",function () {
			event.preventDefault();
			notifs[i].parentElement.parentElement.removeChild(notifs[i].parentElement.parentElement.querySelector('br'));
			notifs[i].parentElement.parentElement.removeChild(notifs[i].parentElement);
		});
	}(i));
}