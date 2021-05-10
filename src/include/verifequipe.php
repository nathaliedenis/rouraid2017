<?php

include "connexion.php";

if ( isset($_POST['equipe_nom']) && !empty($_POST['equipe_nom'])){
	$equipe_nom = htmlspecialchars($_POST['equipe_nom']);
    $equipe_nom = trim($equipe_nom);
    $equipe_nom = strtolower($equipe_nom);
    $equipe_nom = ucwords($equipe_nom);	

	$req = $bdd->query("SELECT * FROM Equipe WHERE equipe_nom = '$equipe_nom'");
	$donnees = $req->fetch();

	if ($donnees['id_equipe'] > 0){
		echo "indisponible";
	}
	else{
		echo ".";
	}
}