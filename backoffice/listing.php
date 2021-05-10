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
        if ( isset($_POST['nom_table']) && !empty($_POST['nom_table']) ){
        	$table = $_POST['nom_table'];
        }
	?>
	<div class="back listing">
		<h1><?php echo $table ?></h1>

		<?php
		if($table != "Info_raid" && $table != "Tarif"){
		?>	

		<form method="POST" action="update.php">
		<input type="hidden" name="nom_table" value="<?php echo $table ?>">
		<input type="hidden" name="id" value="new">
		<input type="submit" name="ajouter" value="AJOUTER">
		</form>

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

					echo "\t</tr>\n";

				$col_req->closeCursor();
			?>
		

		<!--recupération de la table menu de la BD pour remplir le tableau listing-->
			<?php
			$req = $bdd->query("SELECT * FROM $table");
			
			
			
			foreach ($req as $value) {
				$id = $value[0];
				


				

			?>
			
				<tr>
					<td><?php echo $id; ?></td>

					<?php 
					
					for ($i = 1 ; $i < count($index_col); $i++){
						echo "\t\t<td><div class='scroll'>" . nl2br($value[$i]) . "</div></td>\n";
					}
					?>


					<td class="modif">
					<form method="POST" action="update.php">
					<input type="hidden" name="nom_table" value="<?php echo $table ?>">
					<input type="hidden" name="id" value="<?php echo $id ?>">
					<input type="submit" name="modifier" value="MODIFIER">
					</form>
					</td>

					<?php
						if($table != "Info_raid" && $table != "Tarif"){
					?>
					<td class="supprim">
					<form method="POST" action="update.php">
					<input type="hidden" name="nom_table" value="<?php echo $table ?>">
					<input type="hidden" name="id" value="<?php echo $id ?>">
					<input type="submit" name="supprimer" value="SUPPRIMER">
					</form>
					</td>
					<?php
					}
					?>
				</tr>
		
		

			<?php
			}
			$req->closeCursor();
			?>
			
			</table>
		

		
		<a href="choixtable.php">RETOUR AU CHOIX DES TABLES</a>
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