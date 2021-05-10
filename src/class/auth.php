<?php

//creation d'une class Auth (authentification)

class Auth extends Database{

	protected $pdo;

	public function __construct() {
		parent::__construct();
    }

/*fonction qui vérifie que l'utilisateur est logué (retourne true)
En vérifiant que le tableau session contient Auth 
et qu'il a un login et un password*/
	public function isLogged(){


		if(isset($_SESSION['Auth']) && isset($_SESSION['Auth']['mail']) && isset($_SESSION['Auth']['mdp'])){
			

			$mail = $_SESSION['Auth']['mail'];
			$mdp = $_SESSION['Auth']['mdp'];

			/*connexion à la bdd*/
			//$bdd = new PDO('mysql:host=localhost;dbname=rouraid;charset=utf8', 'root', 'root');
			/*Sécurité supplémentaire :
			Comparaison du login et password du tableau session Auth avec la BD.
			Vérifie qu'une personne n'a pas créer une variable de session avec des faux identifiants*/

			$req = $this->pdo->query("SELECT * FROM Membre WHERE mail='$mail' AND password='$mdp'");
			$donnees = $req->fetch();

			if ($donnees['id_membre'] > 0){
				
				return array($donnees['id_membre'], $donnees['prenom'], $donnees['nom'], $donnees['mail']);
			}

			else{

				return false;
				
			}


		}
		else{
			return false;
			
		}
	}

	public function __destruct() {}

	public function deconnect(){
		$_SESSION = array();
		session_destroy();
		header('Location:index.php');
	}
}

