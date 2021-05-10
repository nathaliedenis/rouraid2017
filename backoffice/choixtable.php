<?php
// Initialisation des sessions
	include "session.php";
?>	

<?php
// Connexion à la BD
	include "../src/include/connexion.php";
?>

<?php
/*vérifie que les utilisateurs sont enregistré grâce à 
la fonction isLogged (de class Auth) définie dans la page auth.php 
*/
require("back.php");
if (Back::isLogged()){
	
}

/*sinon redirection vers page login.
On peut utiliser la fonction header 
qu'en début de script (pas de contenu avant) */
else{
	header("Location:login.php");
}
?>


<!DOCTYPE html>
<html lang="fr" >
	<head>
		<title>BACKOFFICE</title>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="backstyle.css">
	</head>
	

	<body>


<!--recuperation des noms des tables existantes
et renvoie sur le listing de la table selectionnée-->
	<div class="back choix">
		<h1>Selectionnez une table :</h1>

		<form method="POST" action="listing.php">
			<input type='submit' name='nom_table' value='Info_raid' >
			<input type='submit' name='nom_table' value='Presentation' >
			<input type='submit' name='nom_table' value='Programme' > <br/>
			<input type='submit' name='nom_table' value='Epreuve' >
			<input type='submit' name='nom_table' value='Reglement' >
			<input type='submit' name='nom_table' value='Cat_reglement' > <br/>
			<input type='submit' name='nom_table' value='Tarif' >
			<input type='submit' name='nom_table' value='Commentaire' >
			<input type='submit' name='nom_table' value='Contact' >
		</form>
	</div>

	<form method="POST" action="menu.php">
	<input type="submit" value="RETOUR MENU"/>
	</form>

<!--déconnexion du backoffice-->

	<form method="POST" action="logout.php">
	<input type="submit" value="DECONNEXION"/>
	</form>

	</body>
</html>
