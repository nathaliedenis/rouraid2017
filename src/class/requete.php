<?php 

class Requete extends Database{

	protected $pdo;

	public $langue;


	public function __construct($langue){
		parent::__construct();
		$this->langue=$langue;
	}



	public function getTable($table){
		
		$req = $this->pdo->query("SELECT * FROM $table WHERE langue='$this->langue'");
		
		return $req->fetchAll();
		
	}


	public function getTableOrder($table, $order){
		
		$req = $this->pdo->query("SELECT * FROM $table WHERE langue='$this->langue' ORDER BY $order");
		
		return $req->fetchAll();
		
	}



	public function getTableFr($table){
		
		$req = $this->pdo->query("SELECT * FROM $table");
		
		return $req->fetchAll();
		
	}



	public function getTableOrderFr($table, $order){
		
		$req = $this->pdo->query("SELECT * FROM $table ORDER BY $order");
		
		return $req->fetchAll();
		
	}



	public function getTableDistinctFr($table, $distinct){
		
		$req = $this->pdo->query("SELECT DISTINCT $distinct FROM $table");
		
		return $req->fetchAll();
		
	}

	public function getPrix(){
		
		$req = $this->pdo->query("SELECT * FROM Tarif");
		
		return $req->fetch();
		
	}



	public function __destruct() {}

}