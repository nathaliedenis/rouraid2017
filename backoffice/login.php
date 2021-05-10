<?php
// Initialisation des sessions
include "session.php";


//récupération des données du formulaire de connexion
if (isset($_POST) && !empty($_POST['login']) && !empty($_POST['password'])){
	extract($_POST);

//encodage password	
	$password = sha1($password);

// Connexion à la BD
include "../src/include/connexion.php";


/*comparaison formulaire et BD
Récupération de l'id_user*/


	$req = $bdd->prepare('SELECT id_admin FROM Admin WHERE login=? AND password=?');
	$req->execute (array($login, $password));
	$donnees = $req->fetch();

	

/*si ok, initialisation de $_SESSION['Auth'] 
tableau Auth qui contient ce qui concerne l'authentification
avec login et password correspondant aux données du formulaire (post)
et role (récupéré de la BD)*/
	if ($donnees['id_admin'] > 0){
		$_SESSION['Back'] = array(
			'login' => $login,
			'password' => $password
		);
//redirection vers le backoffice
		header("Location:menu.php");
	}
	else {
		echo "<p class='erreur'> Mauvais identifiants </p>";
	}
//pour quitter la requête 	
	$req->closeCursor();
}
?>

<!DOCTYPE html>
<html lang="fr" >
	<head>
		<title>login</title>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="backstyle.css">
		<script type="text/javascript" src="../js/scriptback.js"></script>
	</head>

	<body>

<!--Formulaire authentification Admin-->
	<div class="back login">
		<form action="login.php" method="post">			
			<label>Login : </label>
			<input type="text" name="login"/><br/>
			<label>Mot de Passe : </label>
			<input type="password" name="password"/><br/>
			<input type="submit" value="CONNEXION"/>
		</form>
	</div>
	
	<!--déconnexion du backoffice-->

	<form method="POST" action="logout.php">
	<input type="submit" value="DECONNEXION"/>
	</form>

	
		
	</body>
</html>