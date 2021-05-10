<?php
// Initialisation des sessions
	include "session.php";



/*ecrase le tableau de session (sécurité supplementaire)
detruit la session et redirige vers index*/
$_SESSION = array();
session_destroy();
header("Location:../index.php");
?>
