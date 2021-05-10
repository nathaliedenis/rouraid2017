<?php 

	class Database{

		protected $pdo;

		public function __construct(){
		$this->pdo=new
		PDO('mysql:host=;
			dbname=;
			port=3306;
			charset=utf8',
			'',
			'');

		return $this->pdo;
		}

		public function __destruct() {}
}