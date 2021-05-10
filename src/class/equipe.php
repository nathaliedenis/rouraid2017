<?php

class Equipe extends Database{



	public function __construct(){
		parent::__construct();
	}



	public function getEquipe(){
		$date = date('Y');
		$tri="equipe_nom ASC";
			if (isset($_GET['tri'])){
        	$tri = $_GET['tri'];
        }	
		$req = $this->pdo->query("SELECT * FROM Equipe WHERE year(date_inscription)=$date AND paiement='ok' ORDER BY $tri") ;	

		return $req->fetchAll();
	}




}