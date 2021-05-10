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

	<nav class="menu">
		<ul>
			
			<li><a href="choixtable.php">MODIFIER DU<br/><span>TEXTE</span></a></li>
			<li><a href="import_export.php?table=Photo">AJOUTER DES<br/><span>PHOTOS</span></a></li>
			<li><a href="import_export.php?table=Sponsor">AJOUTER DES<br/><span>SPONSORS</span></a></li>
			<li><a href="import_export.php?table=Resultats">AJOUTER LES<br/><span>RESULTATS</span></a></li>
			<li><a href="import_export.php?table=Equipe">LISTE DES<br/><span>EQUIPES</span></a></li>
			<li><a href="import_export.php?table=Repas">RESERVATION<br/><span>REPAS SUP</span></a></li>
			
		</ul>
	</nav>

<!--déconnexion du backoffice-->

	<form method="POST" action="logout.php">
	<input type="submit" value="DECONNEXION"/>
	</form>


	</body>
</html>
