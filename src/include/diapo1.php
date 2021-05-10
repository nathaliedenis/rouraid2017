<?php

	include "connexion.php";

	$photos= array();

	$req = "SELECT url FROM Photo WHERE id_photo %2 = 1";

	foreach  ($bdd->query($req) as $row) {
		if ($_GET['memoire'] != "url(./img/photo_rouraid/" . $row['url'] . ")" ){
			$photos[] = "url(./img/photo_rouraid/" . $row['url'] . ")";
		}
	}

	echo $photos[ rand(0,count($photos) - 1) ];
	
