<?php
include "connexion.php";

$msg1_membre ="";
$msg2_membre ="";

if (isset($_POST['provenance'])){
	$_SESSION['provenance'] = $_POST['provenance'];
}


if (isset($_POST['connexionmbr'])){

	if (!empty($_POST['mailok']) && !empty($_POST['mdpok'])){
				
			$mailok = htmlspecialchars($_POST['mailok']);
			$mailok = trim($mailok);
			$mailok = strtolower($mailok);

			//encodage password	
			$mdpok = sha1($_POST['mdpok']);


			/*comparaison formulaire et BD
			Récupération de l'id_user*/

			$req = $bdd->prepare('SELECT id_membre FROM Membre WHERE mail=? AND password=?');
			$req->execute (array($mailok, $mdpok));
			$donnees = $req->fetch();

			

				/*si ok, initialisation de $_SESSION['Auth'] 
				tableau membre qui contient ce qui concerne l'authentification
				avec login et password correspondant aux données du formulaire (post)
				*/
				if ($donnees['id_membre'] > 0){
					
				$_SESSION['Auth'] = array(
					'mail' => $mailok,
					'mdp' => $mdpok,
					'id_membre' => $donnees['id_membre']
				);
					if(isset($_SESSION['provenance'])){
						$destination = $_SESSION['provenance'];			
						header('Location:?page=' . $destination);
					}
					else{
						header('Location:?page=inscription1');
					}

				}
				else {
					$msg1_membre = "Mauvais identifiants";
				}
			//pour quitter la requête 	
			$req->closeCursor();
	}

	else{
		$msg1_membre = "Tous les champs doivent être remplis";

	}

}
else{


	if (isset($_POST['inscriptionmbr'])){

		if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['mdp']) && !empty($_POST['mdp2'])){

			$nom = htmlspecialchars($_POST['nom']);
			$nom = trim($nom);
			$nom = strtolower($nom);
            $nom = ucwords($nom);

			$prenom = htmlspecialchars($_POST['prenom']);
			$prenom = trim($prenom);
			$prenom = strtolower($prenom);
            $prenom = ucwords($prenom);

			$mail = htmlspecialchars($_POST['mail']);
			$mail = trim($mail);
			$mail = strtolower($mail);

			$mdp = sha1($_POST['mdp']);
			$mdp2 = sha1($_POST['mdp2']);

			$regex = "/^([a-z\\sàâçèëéêîïôùûüñ-]+)$/si"; 


			$nomlenght = strlen($nom);
			if($nomlenght <= 20 && preg_match($regex,$nom)){

				$prenomlenght = strlen($prenom);
				if($prenomlenght <= 20 && preg_match($regex,$nom)){

					if(filter_var($mail, FILTER_VALIDATE_EMAIL)){

						$reqmail = $bdd->prepare("SELECT * FROM Membre WHERE mail = ? ");
						$reqmail->execute(array($mail));
						$mailexist = $reqmail->rowCount();
						if($mailexist==0){

							if($mdp == $mdp2){

								$insertmembre = $bdd->prepare('INSERT INTO Membre(nom, prenom, mail, password, date_inscription) VALUES(:nom, :prenom, :mail, :mdp, NOW())');

								$insertmembre->bindParam(':nom', $nom);
								$insertmembre->bindParam(':prenom', $prenom);
								$insertmembre->bindParam(':mail', $mail);
								$insertmembre->bindParam(':mdp', $mdp);

								$insertmembre->execute();
								
								$_SESSION['Auth'] = array(
								'mail' => $mail,
								'mdp' => $mdp
								);
								
								if(isset($_SESSION['provenance'])){
									$destination = $_SESSION['provenance'];			
									header('Location:?page=' . $destination);
								}
								else{
									header('Location:?page=inscription1');
								}
							}
							else{
								$msg2_membre = "Vos mots de passe ne correspondent pas";
							}
						}
						else{
							$msg2_membre = "Adresse mail déjà utilisée";
						}
					}
					else{
						$msg2_membre = "Votre adresse mail n'est pas valide";
					}
				}
				else{
					$msg2_membre = "Votre prenom n'est pas valide";
				}
			}
			else{
				$msg2_membre = "Votre nom n'est pas valide";
			}
		}
		else{
			$msg2_membre="Tous les champs doivent être remplis";
		}
	}
	else{
		$msg2_membre="";
	}
}
?>






