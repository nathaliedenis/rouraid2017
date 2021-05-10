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
    <script type="text/javascript" src="../js/scriptback.js"></script>
	</head>

	<body>
    <div class="back update">

    <?php
    if ( isset($_POST['nom_table']) && !empty($_POST['nom_table']) ){
                  $table = $_POST['nom_table'];
                }
    if ( isset($_POST['id']) && !empty($_POST['id']) ){
      $id = $_POST['id'];
    }

    echo "<h1>" . $table . "</h1>";
    ?>

    <!--AJOUTER-->
    	<?php
    	if(isset($_POST['ajouter'])){ 
    		$req1 = $bdd->query("SELECT * FROM $table");
          	$donnees = $req1->fetchAll(PDO::FETCH_ASSOC);
    		    $primarybis = true;
          	echo "<form method='POST' ACTION='confirm.php' onsubmit='return verifBack();'> ";
          	foreach ($donnees[0] as $key => $value) { 
               
              echo "\n";
                if ($primarybis)	{
                  
                  $primarybis = false;
                }
                else{
                 	echo"<label>" . $key ."</label><br/>";
                  echo "\n";

                  if (substr($key,0 ,5) == "texte"){
                    echo"<textarea class='texte' name='" . $key. "'></textarea><br/>";
                    echo "\n";
                  }
                  else{
                   	echo"<textarea name='" . $key. "'></textarea><br/>";
                    echo "\n";
                 	}
                }       
            }    
          echo "<input type='hidden' name='nom_table' value='".$table."'>";
          echo "<input type='submit' name='ajouter' value='AJOUTER'>";
          echo "</form>";
        	$req1->closeCursor();
      }
    	?>






    <!--MODIFIER-->
    	<?php
    	if(isset($_POST['modifier'])){
                
              echo "<p>Pour mettre du texte en gras le placer entre des balises &lt;strong&gt;<strong>le texte en gras</strong>&lt;/strong&gt; et modifier</p>";

               $req2 = $bdd->query("SELECT * FROM $table WHERE id_$table = '$id'");
               
               $donnees = $req2->fetchAll(PDO::FETCH_ASSOC);
    			     $primary = true;
               echo "<form method='POST' ACTION='confirm.php' onsubmit='return verifBack();'> ";
               echo "\n";
               
               foreach ($donnees[0] as $key => $value) {       
                echo "<div>";
                  if ($primary) {
                    
                    echo"<input type='hidden' name='" . $key . "' value='".$value."'>";
                    echo "\n";
                    
                    $primary = false;
                  }
                  else{
                 		echo "<label>".$key."</label><br/>";
                    echo "\n";
                    if (substr($key,0 ,5) == "texte"){
                      echo"<textarea class='texte' name='" . $key. "'>" . $value . "</textarea>";
                      echo "\n";
                    }
                    else{
                   		echo"<textarea name='" . $key. "'>" . $value . "</textarea>";
                      echo "\n";
                    }
                  }
                echo "</div>";
                echo "\n";
                }
                $req2->closeCursor();
                echo "<input type='hidden' name='nom_table' value='".$table."'>";
                echo "\n";
                echo "<input type='hidden' name='id' value='".$id."'>";
                echo "\n";
                echo "<input type='hidden' name='key' value='".$key."'>";
                echo "\n";
               	echo "<input type='submit' name='modifier' value='MODIFIER'>";
                echo "</form>";


      }   

    	?>




    <!--SUPPRIMER-->
    	<?php
    	if(isset($_POST['supprimer'])){
      
    			$req3 = $bdd->query("SELECT * FROM $table WHERE id_$table = '$id'");
               	$donnees = $req3->fetchAll(PDO::FETCH_ASSOC);
               	echo "<p>Vous êtes sur le point de supprimer la ligne ci-dessous :</p>" ;
    			
               	echo "<form method='POST' ACTION='confirm.php'> ";
               	foreach ($donnees[0] as $key => $value) {
                  echo "\n";
                 	echo "<p>".$key. " :<br/><span>" .nl2br($value). "</span></p>";
                  echo "\n";
               	}
                echo "<input type='hidden' name='nom_table' value='".$table."'>";
                echo "<input type='hidden' name='id' value='".$id."'>";
               	echo "<input type='submit' name='supprimer' value='SUPPRIMER'>";
    			      echo "</form>";

            	$req3->closeCursor();

        }

    	?>
      

<!--RETOUR CHOIXTABLE OU LISTING-->
  </div>

  <?php
    // pour retour au listing crrespondant à la table
    echo "<form method='POST' action='listing.php'>";
    echo "\t<input type='submit' name='valider' value='ANNULER' >"."\n"; 
    echo "\t<input type='hidden' name='nom_table' id='nom_table' value='".$table."' >"."\n";
    echo "</form>\n\n";
  ?>
	
  <form method="POST" action="menu.php">
  <input type="submit" value="RETOUR MENU"/>
  </form>
 


<!--déconnexion du backoffice-->

	<form method="POST" action="logout.php">
	<input type="submit" value="DECONNEXION"/>
	</form>

	</body>
</html>