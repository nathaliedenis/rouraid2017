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
  <div class="back confirm">
 


<?php
  if ( isset($_POST['nom_table']) && !empty($_POST['nom_table']) ){
    $table = $_POST['nom_table'];
    $id_table = 'id_'.$table;
  }
  if ( isset($_POST['id']) && !empty($_POST['id']) ){
    $id = $_POST['id'];
  }
  if ($table == 'Photo' || $table == 'Sponsor' || $table == 'Resultats' || $table == 'Equipe' || $table == 'Repas'){
    $retour="import_export.php?table=".$table;
  }

  else{
    $retour='listing.php';
  }
  
?>



<!--AJOUTER-->


<?php
if(!empty($_POST['ajouter'])){

  $col_req1 = $bdd->query("SHOW COLUMNS FROM $table");
  $nom_col = $col_req1->fetchAll();
  $valeurs = '';
  $cols='';
  foreach($nom_col as $colonne) { 
    if ( isset($_POST[$colonne[0]]) && !empty($_POST[$colonne[0]]) ){
    $valeur = htmlspecialchars($_POST[$colonne[0]], ENT_QUOTES, 'UTF-8');
    $col=$colonne[0];
    }
    else{
      $valeur = '';
      $col='';
    }
    $valeurs .= "'".$valeur."'" .",";   
    $cols .=  $col.",";  
  } 
  
  $valeurs = substr($valeurs, 3, -1);
  $cols = substr($cols,1, -1);

  $ajout = "INSERT INTO $table($cols) VALUES ($valeurs)";

  $bdd->exec($ajout);

  if($bdd){

  //  $ajout = $bdd->prepare("INSERT INTO $table VALUES (DEFAULT, :valeurs)");
    
  //  $ajout->bindParam(':valeurs', $valeurs);
  //  $test = $ajout->execute();
  //  var_dump($valeurs);

  //  if($ajout->execute()){

    echo "<p>Ajouté à la base de données</p>";
  }
  else {
    echo "<p class='erreur'>erreur, veuillez reessayer</p>";
  }
}

?>

<!--MODIFIER-->
<?php
if(!empty($_POST['modifier'])){

  $col_req2 = $bdd->query("SHOW COLUMNS FROM $table");
  $nom_col = $col_req2->fetchAll();



  foreach($nom_col as $colonne) { 

      if ( isset($_POST[$colonne[0]]) && !empty($_POST[$colonne[0]]) ){
      $valeur = $_POST[$colonne[0]];
     
      }
      else{
        $valeur="";
      }


      $modif = $bdd->prepare("UPDATE $table SET $colonne[0]=:valeur WHERE $id_table = $id");

      $modif->bindParam(':valeur', $valeur);
               
      
    if($modif->execute()){
        echo "<p>". $colonne[0] . " modifié</p>";
    }
    else {
      echo "<p class='erreur'>erreur, veuillez reessayer</p>";
    }
  }
}


?>

 





<!--DELETE-->
<?php 
  if(!empty($_POST['supprimer'])){
    $supprime = $bdd->query("DELETE FROM {$table} WHERE {$id_table} = {$id}");
      $donnees = $supprime->fetch();
    if($bdd){
      echo "<p>La ligne " .$id. " a été supprimée</p>";
    }
    else{
      echo "<p class='erreur'>erreur, veuillez reessayer</p>";
    }
    $supprime->closeCursor();  
} 

?>




<!--UPLOAD photo/sponsor-->

<?php 

require __DIR__.'/../vendor/autoload.php';

use League\Csv\Reader;


  if(isset($_POST['upload'])){

      if(isset($_POST['nom_table']) && !empty($_POST['nom_table'])) {

          if($_POST['nom_table']=="Photo"){
          
          $date = date('Y');
              
              if(move_uploaded_file($_FILES['userfile']['tmp_name'], '../img/photo_rouraid/'.$_FILES['userfile']['name'])) {

                  $url = $_FILES['userfile']['name'];

                  $ajout = "INSERT INTO Photo(url,alt,annee_raid) VALUES ('$url','rouraid $date', $date)";

                  if ($bdd->exec($ajout)){     
                    echo "Transfert réussi<br>";
                    echo "Il s'agit du fichier :".$_FILES['userfile']['name']."<br>";
                    echo "De type mime : ".$_FILES['userfile']['type']."<br>";
                  }
                  else{
                      echo "Echec de l'insertion en base de données";
                  }
              }
              else{
                  echo "Echec de l'upload";
              }
          }
          else if($_POST['nom_table']=="Sponsor"){
              
              if(move_uploaded_file($_FILES['userfile']['tmp_name'], '../img/sponsor/'.$_FILES['userfile']['name'])) {

                  $url = $_FILES['userfile']['name'];

                  $ajout = "INSERT INTO Sponsor(url) VALUES ('$url')";

                  if ($bdd->exec($ajout)){     
                    echo "Transfert réussi<br>";
                    echo "Il s'agit du fichier :".$_FILES['userfile']['name']."<br>";
                    echo "De type mime : ".$_FILES['userfile']['type']."<br>";
                  }
                  else{
                      echo "Echec de l'insertion en base de données";
                  }
              }
              else{
                  echo "Echec de l'upload";
              }
          }
      }
  }
?>




<!--UPLOAD Resultat-->

<?php 
  if(isset($_POST['upload'])){

      if(isset($_POST['nom_table']) && !empty($_POST['nom_table'])) {

          if($_POST['nom_table']=="Resultats"){
              
              if(move_uploaded_file($_FILES['userfile']['tmp_name'], '../resultats/'.$_FILES['userfile']['name'])) {

                  //We are going to insert some data into the users table
                  $insert = $bdd->prepare(
                    "INSERT INTO Resultats (
                    dossard,
                    equipe_nom,
                    cat_sexe,
                    adulte_nom,
                    adulte_prenom,
                    enfant_nom,
                    enfant_prenom,
                    enfant_naissance,
                    classement_cross,
                    point_cross,
                    classement_vtt,
                    point_vtt,
                    classement_parcours,
                    point_parcours,
                    point_co,
                    point_tir,
                    point_quizz,
                    total_point,
                    total_classement,
                    annee_raid
                    ) VALUES (
                    :dossard,
                    :equipe_nom,
                    :cat_sexe,
                    :adulte_nom,
                    :adulte_prenom,
                    :enfant_nom,
                    :enfant_prenom,
                    :enfant_naissance,
                    :classement_cross,
                    :point_cross,
                    :classement_vtt,
                    :point_vtt,
                    :classement_parcours,
                    :point_parcours,
                    :point_co,
                    :point_tir,
                    :point_quizz,
                    :total_point,
                    :total_classement,
                    :annee_raid
                    )"
                  );

                  $csv = Reader::createFromPath("../resultats/".$_FILES['userfile']['name']);
                  $csv->setOffset(2); //because we don't want to insert the header
                  $nbInsert = $csv->each(function ($row) use (&$insert) {
                    //Do not forget to validate your data before inserting it in your database

                   
                    
                    $row[3] = ucwords(strtolower(trim($row[3])));
                    $row[5] = ucwords(strtolower(trim($row[5])));
                    $row[6] = ucwords(strtolower(trim($row[6])));
                    $row[7] = ucwords(strtolower(trim($row[7])));
                    $row[8] = ucwords(strtolower(trim($row[8])));

                    $insert->bindValue(':dossard', $row[2], PDO::PARAM_STR);
                    $insert->bindValue(':equipe_nom', $row[3], PDO::PARAM_STR);
                    $insert->bindValue(':cat_sexe', $row[4], PDO::PARAM_STR);
                    $insert->bindValue(':adulte_nom', $row[5], PDO::PARAM_STR);
                    $insert->bindValue(':adulte_prenom', $row[6], PDO::PARAM_STR);
                    $insert->bindValue(':enfant_nom', $row[7], PDO::PARAM_STR);
                    $insert->bindValue(':enfant_prenom', $row[8], PDO::PARAM_STR);
                    $insert->bindValue(':enfant_naissance', $row[9], PDO::PARAM_STR);
                    $insert->bindValue(':classement_cross', $row[10], PDO::PARAM_STR);
                    $insert->bindValue(':point_cross', $row[11], PDO::PARAM_STR);
                    $insert->bindValue(':classement_vtt', $row[12], PDO::PARAM_STR);
                    $insert->bindValue(':point_vtt', $row[13], PDO::PARAM_STR);
                    $insert->bindValue(':classement_parcours', $row[14], PDO::PARAM_STR);
                    $insert->bindValue(':point_parcours', $row[15], PDO::PARAM_STR);
                    $insert->bindValue(':point_co', $row[16], PDO::PARAM_STR);
                    $insert->bindValue(':point_tir', $row[17], PDO::PARAM_STR);
                    $insert->bindValue(':point_quizz', $row[18], PDO::PARAM_STR);
                    $insert->bindValue(':total_point', $row[19], PDO::PARAM_STR);
                    $insert->bindValue(':total_classement', $row[20], PDO::PARAM_STR);
                    $insert->bindValue(':annee_raid', date('Y'), PDO::PARAM_STR);

                    return $insert->execute(); //if the function return false then the iteration will stop

                  });
                  echo "Importation réussi<br>";
                  echo "Il s'agit du fichier :".$_FILES['userfile']['name']."<br>";
                  echo "De type mime : ".$_FILES['userfile']['type']."<br>";
                  
              }
              else{
                  echo "Echec de l'upload";
              }
              
          }
      }
  }
?>




  <?php
    // pour retour au listing correspondant à la table
    echo "<form method='POST' action='".$retour."'>";
    echo "\t<input type='submit' name='valider' value='RETOUR ".$table."' >"."\n"; 
    echo "\t<input type='hidden' name='nom_table' id='nom_table' value='".$table."' >"."\n";
    echo "</form>\n\n";
  ?>

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