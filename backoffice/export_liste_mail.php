<?php

require __DIR__.'/../vendor/autoload.php';

use League\Csv\Writer;


// Connexion à la BD
include "../src/include/connexion.php";

$date = date('Y');
//we fetch the info from a DB using a PDO object
$export = $bdd->prepare(
	"SELECT m.mail AS adresse FROM Membre m Join Equipe e on m.id_membre=e.id_membre WHERE year(e.date_inscription)=$date AND e.paiement='ok' GROUP BY e.id_membre"
);

//because we don't want to duplicate the data for each row
// PDO::FETCH_NUM could also have been used
$export->setFetchMode(PDO::FETCH_ASSOC);
$test = $export->execute();

//we create the CSV into memory
$csv = Writer::createFromFileObject(new SplTempFileObject());

//we insert the CSV header
$csv->insertOne([
	'adresse mail'
	]);

// The PDOStatement Object implements the Traversable Interface
// that's why Writer::insertAll can directly insert
// the data into the CSV
$csv->insertAll($export);

// Because you are providing the filename you don't have to
// set the HTTP headers Writer::output can
// directly set them for you
// The file is downloadable
$csv->output('listing_mail_'.$date.'.csv');