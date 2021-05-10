
$(document).ready(function(){



	///////////////////////////////////////////////////////
	/* ICON BURGER MENU */
	///////////////////////////////////////////////////////

	$('.iconburger').click(function(){
		$(this).toggleClass('change');
		$('nav ul').toggleClass('visible');

	});

	///////////////////////////////////////////////////////
	/* VALIDATION FORMULAIRE */
	///////////////////////////////////////////////////////

	
	function donneNiveau() {
		$("input#niveau").val( $("select#enfant_naissance option:selected").attr("class") );
	}

	function nbRepas(){
		if ($("input#repas_sup").is(":checked")) {
			$("label[for='nb_repas']").css("visibility", "visible");
            $('#nb_repas').css("visibility", "visible");
        }
        else{
        	$("label[for='nb_repas']").css("visibility", "hidden");
        	$('#nb_repas').css("visibility", "hidden");
        }	
	}



	///////////////////////////////////////////////////////
	
	$( "select#enfant_naissance" ).change( donneNiveau );
	$("input[name='checkrepas']").change(nbRepas);

	///////////////////////////////////////////////////////



	function validEquipe(){

		if($.trim($(this).val()).length > 40){
			$(this).css("boxShadow", "0px 0px 3px red");
	        $(this).next(".errorjs").text("Veuillez rentrer un nom valide");
	        $(this).next(".errorjs").css("visibility", "visible");
		}
			else if(!$(this).val().match(/^([a-z0-9\\ sàâçèëéêîïôùûüñ-]+)$/i) ){
				$(this).css("boxShadow", "0px 0px 3px red");
	        	$(this).next(".errorjs").text("Veuillez rentrer un nom valide");
	        	$(this).next(".errorjs").css("visibility", "visible");
			}
				else{
					$(this).css("boxShadow", "none");
					$(this).next(".errorjs").css("visibility", "hidden");
				}
	}





	///////* AJAX */////////

	function existEquipe(){
		
		var equipe_nom = $.trim( $("input#equipe_nom").val() );

		if (equipe_nom != "") {
			
			$.post( "src/include/verifequipe.php",{equipe_nom:equipe_nom}, function( data,status ){
				
				if (data == "indisponible"){
					$("input#equipe_nom").css("boxShadow", "0px 0px 3px red");
	        		$("input#equipe_nom").next(".errorjs").text("Nom d'équipe déjà existant");
	        		$("input#equipe_nom").next(".errorjs").css("visibility", "visible");
				}	
			});
		}
		else {
			$("input#equipe_nom").css("boxShadow", "0px 0px 3px black");
			$("input#equipe_nom").next(".errorjs").css("visibility", "hidden");
		}		
	}

	//////////////////////


	function validNom(){
		
		if($.trim($(this).val()).length > 20){
			$(this).css("boxShadow", "0px 0px 3px red");
	        $(this).next(".errorjs").text("Veuillez rentrer un nom valide");
	        $(this).next(".errorjs").css("visibility", "visible");
		}
			else if(!$(this).val().match(/^([a-z\\ sàâçèëéêîïôùûüñ-]+)$/i) ){
				$(this).css("boxShadow", "0px 0px 3px red");
	        	$(this).next(".errorjs").text("Veuillez rentrer un nom valide");
	        	$(this).next(".errorjs").css("visibility", "visible");
			}
		else{
			$(this).css("boxShadow", "none");
			$(this).next(".errorjs").css("visibility", "hidden");
		}
	}



	function validPass(){

	    if($(this).val() != $("input#mdp").val()){ // si la confirmation est différente du mot de passe
	        $(this).css("boxShadow", "0px 0px 3px red");
		    $(this).next(".errorjs").text("Mot de passe incorrect");
		    $(this).next(".errorjs").css("visibility", "visible");
	    }
		else{
			$(this).css("boxShadow", "none");
			$(this).next(".errorjs").css("visibility", "hidden");
		}
	}


	function verifier(champ){

	    if($.trim(champ.val()) == ""){ // si le champ est vide
	    	champ.css("boxShadow", "0px 0px 3px red");
		    champ.next(".errorjs").text("champ obligatoire");
		    champ.next(".errorjs").css("visibility", "visible");
	    	return false;
	    }
	    else{
	    	return true;
	    }
    }



    function validMail(mail){
    email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;

   		if(!email_regex.test($.trim(mail.val()))){ 
   			mail.css("boxShadow", "0px 0px 3px red");
	    	mail.next(".errorjs").text("Mail invalide");
	    	mail.next(".errorjs").css("visibility", "visible");
	    	return false;
	    }
	    else{
	    	return true;
	    }
    }





    function verifRadio(radio){

	    if ( (radio).is(':checked') ) {
	    	return true;
	    }
	    else{
		    $('div.errorjs.radio').text("cases à cocher");
		    $('div.errorjs.radio').css("visibility", "visible");
	    	return false;
	    }
    }

    function retabliCheckbox(){
    	if ( $(this).is(':checked') ) {
    		$('div.errorjs.radio').css("visibility", "hidden");
    		$('div.errorjs.nbrepas').css("visibility", "hidden");
    	}
    }

    function retabliSelect(){
    	if($(this).val() != ""){ // si le champ est vide
	    	$(this).css("boxShadow", "none");
		    $(this).next(".errorjs").text("");
		    $(this).next(".errorjs").css("visibility", "hidden");
	    }
    }


    function retabliMail(){

    	email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;

   		if(email_regex.test($.trim($(this).val()))){ 

   			$(this).css("boxShadow", "none");
	    	$(this).next(".errorjs").text("Mail valide");
	    	$(this).next(".errorjs").css("visibility", "hidden");
	    }
    }


	///////////////////////////////////////////////////////



    $('.creation input.envoi').click(function(e){
   
    	if ( verifier($("#nom")) ){
    		valid = true;
    	}
    	else{
    		return false;
    	}
	    if ( verifier($("#prenom")) ){
	    	valid=true;
	    }
	    else{
    		return false;
    	}
		if ( verifier($("#mail")) ){
    		valid=true;
    	}
    	else{
    		return false;
    	}
		if ( validMail($("#mail")) ){
			valid=true;
		}
		else{
    		return false;
    	}
		if ( verifier($("#mdp")) ){
			valid=true;
		}
		else{
    		return false;
    	}
		if ( verifier($("#mdp2")) ){
			valid=true;
		}
		else{
    		return false;
    	}
		return valid;
    });



    $('.membre input.envoi').click(function(e){

        if ( verifier($("#mailok")) ){
    		valid=true;
    	}
    	else{
    		return false;
    	}
		if ( validMail($("#mailok")) ){
			valid=true;
		}
		else{
    		return false;
    	}
		if ( verifier($("#mdpok")) ){
			valid=true;
		}
		else{
    		return false;
    	}
		return valid;
    });	


////////********////////


    $('input#info_equipe').click(function(){
    	
        if ( verifier($("#equipe_nom")) ){
    		valid=true;
    	}
    	else{
    		return false;
    	}
		if ( verifier($("#adulte_nom")) ){
			valid=true;
		}
		else{
    		return false;
    	}
		if ( verifier($("#adulte_prenom")) ){
			valid=true;
		}
		else{
    		return false;
    	}
    	if ( verifier($("#lien_avec_enfant")) ){
    		valid=true;
    	}
    	else{
    		return false;
    	}
    	if ( verifier($("#enfant_nom")) ){
    		valid=true;
    	}
    	else{
    		return false;
    	}
    	if ( verifier($("#enfant_prenom")) ){
    		valid=true;
    	}
    	else{
    		return false;
    	}
    	if ( verifRadio($("input[name='enfant_sexe']")) ){
    		valid=true;
    	}
    	else{
    		return false;
    	}
    	if ( verifier($("#enfant_naissance")) ){
    		valid=true;
    	}
    	else{
    		return false;
    	}
		return valid;
    });	

////////********///////


    $(".inscription.repas input[name='repas']").click(function(){
        
    	if ( verifRadio($("input[name='checkrepas']")) ){

    		if( $("input[name='checkrepas']:checked").val() == 'non'){

    			valid=true;
    		}
    		else{

    			if ( verifier($("input[name='nb_repas']"))){
    				valid=true;
    			}
    			else{
    				 return false;
    			}
    		}

    	}
    	else{
    		return false;
    	}
    	
		return valid;
    });	


////////********////////



$(".inscription.repas input[name='repas_seul']").click(function(){

    	if ( verifier($("input[name='nb_repas']")) ){

			valid=true;
    	}
    	else{
    		valid=false;
    	}
		return valid;
    });	


////////********///////


    $("input[name='validerinscription']").click(function(){
    	
    	if ( verifRadio($("input[name='condition']")) ){
    		valid=true;
    	}
    	else{
    		valid=false;
    	}
		return valid;
    });	


////////********///////





    $('.infos input.envoi').click(function(e){

        return validMail($("#email"));

    });	



	///////////////////////////////////////////////////////
	

	$("input.verif").keyup(validNom);
	$("input.verif").change(validNom);
	$("input.verifequipe").keyup(validEquipe);
	$("input.verifequipe").change(validEquipe);
	$("input.verifequipe").keyup(existEquipe);
	$("input.verifequipe").change(existEquipe);
	$("input#mdp2").keyup(validPass);
	$("input#mdp2").change(validPass);
	$("input.mail").keyup(retabliMail);
	$("input.mail").change(retabliMail);
	$("input[name='enfant_sexe']").click(retabliCheckbox);
	$("select[name='lien_avec_enfant']").change(retabliSelect);
	$("select[name='enfant_naissance']").change(retabliSelect);
	$("input[name='checkrepas']").click(retabliCheckbox);
	$("input[name='condition']").click(retabliCheckbox);

	$("input[name='nb_repas']").click(retabliSelect);

	///////////////////////////////////////////////////////





	///////////////////////////////////////////////////////
	/* DIAPORAMA */
	///////////////////////////////////////////////////////

	///////* AJAX */////////

	setInterval(function photoUn() {

		var memoire = $(".photoun").css( 'backgroundImage' );

		$.get( "src/include/diapo1.php", {memoire : memoire}, function( data,status ) {
			
			$(".photoun div").fadeOut( function(){
				$(".photoun div").css( 'backgroundImage', data );
			});
			$(".photoun div").fadeIn(1500);
			$(".photoun").css( 'backgroundImage', data );
		});
	}, 4000);

	
	setInterval(function photoDeux() {

		var memoire = $(".photodeux").css( 'backgroundImage' );

		$.get( "src/include/diapo2.php", {memoire : memoire}, function( data,status ) {
			$(".photodeux div").fadeOut( function(){
				$(".photodeux div").css( 'backgroundImage', data );
			});
			$(".photodeux div").fadeIn(1500);
			$(".photodeux").css( 'backgroundImage', data );
		});
	}, 5000);

	/////////////////////////////////////////////////////////




	///////////////////////////////////////////////////////
	/* OFFRE REDUCTION FAMILLE */
	///////////////////////////////////////////////////////

	function reduction(){
		var prix_initial = Number($('td#total').attr('data-montant'));

		if ($("input#reduction").is(":checked")) {
			$.post( "src/include/reduction.php",{reduction:true}, function( data,status ){
				
				var nouveau_prix = prix_initial - Number(data);
				$('td#total').text(nouveau_prix + '€');
				$('.panier table').append('<tr id="promo"><th>Reduction :</th><td>- ' + data + ' €</td></tr>');
				$('input#prix').val(nouveau_prix);
			});
		}
		else{
			$('td#total').text(prix_initial + '€');
			$('tr#promo').remove();
			$('input#prix').val(prix_initial);
		}
	}
	///////////////////////////////////////////////////////
	$("input[name='reduction']").change(reduction);
	///////////////////////////////////////////////////////






	///////////////////////////////////////////////////////
	/* GESTION DES SOUS PAGES */
	///////////////////////////////////////////////////////
	function changeMenu(){
		var lien = $(this).attr('data-lien');
		$(".sousmenu li").css('background', '#799aed');
		$(this).css('background', '#79b530');
	    $('div.souspage').hide();
	    $('div#' + lien).show();
	}


	///////////////////////////////////////////////////////
	$(".sousmenu li").click(changeMenu);
	///////////////////////////////////////////////////////





	///////////////////////////////////////////////////////
	/* GESTION DES SOUS PAGES EPREUVES */
	///////////////////////////////////////////////////////
	function changeEpreuve(){
		var lien = $(this).attr('data-lien');
		$(".menuepreuve li").attr('class', '');
		$(this).attr('class', 'ok rubberBand animated');
		$('.photoepreuve').attr('src', 'img/epreuve'+lien+'.jpg');
	    $('div.souspage').hide();
	    $('div#' + lien).show();
	    $('div#' + lien).attr('class', 'texte souspage actif');
	}


	///////////////////////////////////////////////////////
	$(".menuepreuve li").click(changeEpreuve);
	///////////////////////////////////////////////////////






	///////////////////////////////////////////////////////
	/* GESTION DES SOUS PAGES GALERIE ANNEE */
	///////////////////////////////////////////////////////
	function changeGalerie(){
		var lien = $(this).attr('data-lien');
		$(".annee li").attr('class', '');
		$(this).attr('class', 'actif rubberBand animated');
	    $('.album>ul>li').css('display', 'none');
	    $('.album>ul>li.' + lien).css('display', 'block');
	}


	///////////////////////////////////////////////////////
	$(".annee li").click(changeGalerie);
	///////////////////////////////////////////////////////



	///////////////////////////////////////////////////////
	/* ZOOM SUR PHOTO GALERIE */
	///////////////////////////////////////////////////////
	function zoom() {
		var photo = $(this).attr( "src" );
		$( "#zoom img" ).attr( "src", photo );
		$(".mini").css("opacity",0.4);
		$( "#zoom" ).fadeIn();
	}
	
	$( "#zoom" ).click(function() {
		$(".mini").css("opacity",1.0);
		$(this).fadeOut();
	});
	///////////////////////////////////////////////////////
	$(".mini img").click(zoom);
	///////////////////////////////////////////////////////


});
