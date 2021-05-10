<?php
include "connexion.php";

if (isset($_GET['id']) && !empty($_GET['id']) ) {

	$id = $_GET['id'];

	$req = $bdd->prepare('SELECT * FROM Commentaire WHERE id_commentaire=?');
	$req->execute (array($id));
	$newCommentaire = $req->fetch();

    if(isset($_POST['valider'])){

    	$id_commentaire = $_POST['id_commentaire'];

    	$valid = $bdd->prepare("UPDATE Commentaire SET moderateur='ok' WHERE id_commentaire=?");

		if ($valid->execute (array($id_commentaire))){
			echo "Commentaire validé";
		}
		else{
			echo "Une erreur s'est produite";
		}
	}
	else{
		echo "<h1> Nouveau commentaire :</h1><p>" . $newCommentaire['texte'] . "</p>";
		echo "<form method='POST' ACTION=''> ";
		echo "<input type='hidden' name='id_commentaire' value='".$id."'>";
    	echo "<input type='submit' name='valider' value='VALIDER CE COMMENTAIRE'>";
    	echo "</form>";
	}
}
