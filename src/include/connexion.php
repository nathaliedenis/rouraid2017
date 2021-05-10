<?php
// On se connecte à MySQL
/* A changer le nom de la BDD 
et le passwd : vide '' pour Windows et 'root' pour OSX */
try{   
    $bdd = new PDO('mysql:;
			dbname=;
			port=3306;
			charset=utf8',
			'',
			'');
}
// En cas d'erreur, on affiche un message et on arrête tout
catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}



