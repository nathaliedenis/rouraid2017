<?php


class Back{

/*fonction qui vérifie que l'utilisateur est logué (retourne true)
En vérifiant que le tableau session contient Auth 
et qu'il a un login et un password*/
	static function isLogged(){
		if(isset($_SESSION['Back']) && isset($_SESSION['Back']['login']) && isset($_SESSION['Back']['password'])){
			extract($_SESSION['Back']);


			// Connexion à la BD
			include "../src/include/connexion.php";

			/*Sécurité supplémentaire :
			Comparaison du login et password du tableau session Auth avec la BD.
			Vérifie qu'une personne n'a pas créer une variable de session avec des faux identifiants*/

			$req = $bdd->query("SELECT id_admin FROM Admin WHERE login='$login' AND password='$password'");
			$donnees = $req->fetch();
			if ($donnees['id_admin'] > 0){
				return true;
			}
			else{
				return false;
			}


		}
		else{
			return false;
		}
	}
}

?>