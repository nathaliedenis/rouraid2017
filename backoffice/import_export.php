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


	<?php
	
	if (isset($_GET['table']) && !empty($_GET['table'])){
		$table = $_GET['table']; 
	}
    
	?>

	<div class="back listing equipe">
		<h1><?php echo $table ?></h1>

		<?php
		if ($table == 'Equipe'){
			$date=date('Y');
			$cpt = $bdd->query("SELECT COUNT(*) as nombre FROM Equipe WHERE year(date_inscription)=$date AND paiement='ok'");
			$nb_equipe = $cpt->fetch();

			echo "<a href='export_liste_equipe.php'>EXTRAIRE LA LISTE DES EQUIPES INSCRITES</a><br/>";
			echo "<a href='export_liste_mail.php'>LISTING EMAIL</a>";
			echo "<p> Il y a actuellement <strong>" .$nb_equipe['nombre']. "</strong> équipe(s) inscrite(s).<p/>";

		}
		else if ($table == 'Repas'){
			$date=date('Y');
			$cpt = $bdd->query("SELECT SUM(nb_repas) AS quantite FROM Repas WHERE year(date_commande)=$date AND paiement='ok'");
			$nb_repas = $cpt->fetch();
			echo "<a href='export_liste_repas.php'>EXTRAIRE LA LISTE DES REPAS RESERVES</a><br/>";
			echo "<p> Il y a actuellement <strong>" .$nb_repas['quantite']. "</strong> repas supplémentaires réservés.<p/>";

		}
		else{
		?>
		

		<div class="upload">

			<form enctype="multipart/form-data" action="confirm.php" method="post">
				<input type='hidden' name='nom_table' value='<?php echo $table ?>'>
				<!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
				<!-- et doit tenir compte de la nature des fichiers attendus -->
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
				<!-- Le nom de l'élément input détermine -->
				<!-- le nom dans le tableau $_FILES -->
				<label for="idfile">Selectionner un fichier</label>
				<input id="idfile" name="userfile" type="file" />
				<input name ="upload" type="submit" value="AJOUTER" />
			</form>

		</div>

		<?php
		}
		?>


			<table>
			<?php
				$col_req = $bdd->query("SHOW COLUMNS FROM $table");
				$index_col = $col_req->fetchAll();

				
					
					echo "\t<tr>\n";
					
					
				foreach($index_col as $colonne) {	
					echo "\t\t<th>" . $colonne[0] . "</th>\n";
				}

					if($table == 'Equipe'){
						echo "<th>adresse mail</th>";
					}

					echo "\t</tr>\n";

				$col_req->closeCursor();
			?>
		

	
			<?php
			if($table=='Resultats'){
				$date=date('Y');
				$req = $bdd->query("SELECT * FROM Resultats WHERE annee_raid=$date ORDER BY total_point DESC");
			}
			else if($table=='Equipe'){
					$date=date('Y');
					$req = $bdd->query("SELECT * FROM Equipe WHERE year(date_inscription)=$date ORDER BY date_inscription ASC");
				}
				else{
					$req = $bdd->query("SELECT * FROM $table");
				}

			foreach ($req as $value) {
				$id = $value[0];

				
				
			?>
			
				<tr>
					<td><?php echo $id; ?></td>

					<?php 
					
					for ($i = 1 ; $i < count($index_col); $i++){
						echo "\t\t<td><div class='scroll'>" . nl2br($value[$i]) . "</div></td>\n";
					}

						if($table == 'Equipe'){

							$id_membre = $value['id_membre'];
							$reqmail = $bdd->query('SELECT mail FROM Membre WHERE id_membre ="'.$id_membre.'"');
							foreach ($reqmail as $mail)	{
								$mail = $mail['mail'];
								echo "<td>" . $mail . "</td>";
							}	
						}

					?>

					<td class="modif">
					<form method="POST" action="update.php">
					<input type="hidden" name="nom_table" value="<?php echo $table ?>">
					<input type="hidden" name="id" value="<?php echo $id ?>">
					<input type="submit" name="modifier" value="MODIFIER">
					</form>
					</td>

					<td class="supprim">
					<form method="POST" action="update.php">
					<input type="hidden" name="nom_table" value="<?php echo $table ?>">
					<input type="hidden" name="id" value="<?php echo $id ?>">
					<input type="submit" name="supprimer" value="SUPPRIMER">
					</form>
					</td>
				</tr>

			<?php
			}
			$req->closeCursor();
			?>
			
			</table>
		
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