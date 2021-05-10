<?php

class Resultat extends Database{


	public function __construct(){
		parent::__construct();
	}



	public function getResultat(){
		$date = date('Y');
		$tri="cat_sexe,total_classement";
			if (isset($_GET['tri'])){
        	$tri = $_GET['tri'];
        }	
		$req = $this->pdo->query("SELECT * FROM Resultats WHERE annee_raid=$date ORDER BY $tri") ;	

		return $req->fetchAll();
	}


	public function getScore(){

	$date = date('Y');

	    if ( isset($_POST['envoidossard']) ){

	    	if (isset($_POST['dossard']) && !empty($_POST['dossard']) ){

		        $dossard=$_POST['dossard'];

		        $req = $this->pdo->query("SELECT * FROM Resultats WHERE annee_raid=$date AND dossard=$dossard") ;
		        

		        return $req->fetchAll();
		   	}
		}	
	}
}