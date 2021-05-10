/* verification des formulaires du backoffice */

function verifBack(){
	var input = document.querySelectorAll("input");
	var textarea = document.querySelectorAll("textarea");

	for(var i = 0; i < input.length ; i++){
		if (input[i].getAttribute("type") != "hidden"){

		var champs = input[i].value.trim();
		var name = input[i].getAttribute("name");
			if ( champs.length == 0 ) {
				alert (name + " non rempli");
				return false;
			}
		}
	}
	for(var i = 0; i < textarea.length ; i++){
		var champs = textarea.innerHTML.trim();
		if ( champs.length == 0 ) {
			alert ("Description non rempli");
			return false;
		}
	}

}