<?php

require __DIR__.'/../vendor/autoload.php';

use League\Csv\Writer;


// Connexion à la BD
include "../src/include/connexion.php";

$date = date('Y');
//we fetch the info from a DB using a PDO object
$export = $bdd->prepare(
	"SELECT SUM(r.nb_repas) AS quantite, m.nom, m.prenom FROM Repas r Join Membre m on r.id_membre=m.id_membre WHERE year(r.date_commande)=$date AND r.paiement='ok' GROUP BY r.id_membre"
);

// SELECT SUM(nb_repas) AS quantite, Membre.nom FROM Repas, Membre WHERE Repas.id_membre=Membre.id_membre year(date_commande)=2017 AND paiement='ok' GROUP BY Repas.id_membre

//because we don't want to duplicate the data for each row
// PDO::FETCH_NUM could also have been used
$export->setFetchMode(PDO::FETCH_ASSOC);
$test = $export->execute();

//we create the CSV into memory
$csv = Writer::createFromFileObject(new SplTempFileObject());

//we insert the CSV header
$csv->insertOne([
	'nb_repas',
	'nom',
	'prenom'
	]);

// The PDOStatement Object implements the Traversable Interface
// that's why Writer::insertAll can directly insert
// the data into the CSV
$csv->insertAll($export);

// Because you are providing the filename you don't have to
// set the HTTP headers Writer::output can
// directly set them for you
// The file is downloadable
$csv->output('liste_repas_'.$date.'.csv');