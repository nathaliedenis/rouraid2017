<?php

require __DIR__.'/../vendor/autoload.php';

use League\Csv\Writer;


// Connexion à la BD
include "../src/include/connexion.php";

$date = date('Y');
//we fetch the info from a DB using a PDO object
$export = $bdd->prepare(
	"SELECT 
	equipe_nom,
	adulte_nom,
	adulte_prenom,
	lien_avec_enfant,
	enfant_nom,
	enfant_prenom,
	enfant_sexe,
	enfant_naissance,
	niveau
	FROM Equipe WHERE year(date_inscription)=$date AND paiement='ok'"
);

//because we don't want to duplicate the data for each row
// PDO::FETCH_NUM could also have been used
$export->setFetchMode(PDO::FETCH_ASSOC);
$test = $export->execute();

//we create the CSV into memory
$csv = Writer::createFromFileObject(new SplTempFileObject());

//we insert the CSV header
$csv->insertOne([
	'Nom d\'equipe', 
	'adulte nom', 
	'adulte prenom', 
	'lien avec enfant', 
	'enfant nom', 
	'enfant prenom', 
	'enfant sexe', 
	'annee naissance', 
	'niveau'
	]);

// The PDOStatement Object implements the Traversable Interface
// that's why Writer::insertAll can directly insert
// the data into the CSV
$csv->insertAll($export);

// Because you are providing the filename you don't have to
// set the HTTP headers Writer::output can
// directly set them for you
// The file is downloadable
$csv->output('liste_equipe_'.$date.'.csv');