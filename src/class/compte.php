<?php

class Compte extends Database{



	public function __construct(){
		parent::__construct();
	}


	public function getEquipeCpt(){
		$id=$_SESSION['Auth']['id_membre'];
		$date = date('Y');

		$req = $this->pdo->query("SELECT * FROM Equipe WHERE year(date_inscription)=$date AND paiement='ok' AND id_membre=".$id) ;	

		return $req->fetchAll();
	}

	public function getRepasCpt(){
		$id=$_SESSION['Auth']['id_membre'];
		$date = date('Y');

		$req = $this->pdo->query("SELECT SUM(nb_repas) AS quantite FROM Repas WHERE year(date_commande)=$date AND paiement='ok' AND id_membre=".$id) ;	
		$nb_repas = $req->fetch();

		return $nb_repas['quantite'];
	}

	public function getCommentaireCpt(){
		$id=$_SESSION['Auth']['id_membre'];

		$req = $this->pdo->query("SELECT * FROM Commentaire WHERE moderateur='ok' AND id_membre=".$id) ;	

		return $req->fetchAll();
	}




}