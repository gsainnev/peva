<?php
namespace Core\Database;

use \PDO; // because PDO not in App namespace

class MysqlDatabase extends Database{

	private $db_name;
	private $db_user;
	private $db_pass;
	private $db_host;

	private $pdo;

	public function __construct($db_name, $db_user='root', $db_pass='', $db_host='localhost'){
		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_host = $db_host;
	}

	private function getPDO(){

		if($this->pdo === null){ //allows to reuse pdo if already initialized once
			$pdo = new PDO('mysql:host=localhost;dbname=peva_admin','root','');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo=$pdo;
		}
		return $this->pdo;
	}

	public function query($statement, $class_name=null, $one = false){
		$req = $this->getPDO()->query($statement);
		//bloc if car on n'a pas besoin de récupérer les enregistrements
		// pour les requetes de type update, insert ou delete
		// du coup pas besoin de fetch et on retourne direct la requete
		// strpos pour tester le premier mot du statement
		if(
			strpos($statement, 'UPDATE') === 0 ||
			strpos($statement, 'INSERT') === 0 ||
			strpos($statement, 'DELETE') === 0
		){
			return $req;
		}

		if ($class_name===null) {
			$req->setFetchMode(PDO::FETCH_OBJ);
		}
		else{
			$req->setFetchMode(PDO::FETCH_CLASS,$class_name);
		}

		if($one){
			$datas = $req->fetch();
		}
		else{
			$datas = $req->fetchAll();
		}

		return $datas;
	}

	public function prepare($statement, $attributes, $class_name=null, $one = false){
		$req = $this->getPDO()->prepare($statement);
		$res = $req->execute($attributes);

		if(
			strpos($statement, 'UPDATE') === 0 ||
			strpos($statement, 'INSERT') === 0 ||
			strpos($statement, 'DELETE') === 0
		){
			return $res;
		}

		if ($class_name===null) {
			$req->setFetchMode(PDO::FETCH_OBJ);
		}
		else{
			$req->setFetchMode(PDO::FETCH_CLASS,$class_name);
		}

		if($one){
			$datas = $req->fetch();
		}
		else{
			$datas = $req->fetchAll();
		}
		
		return $datas;
	}

	public function lastInsertId(){
		return $this->getPDO()->lastInsertId(); //retourne l'id du dernier enregistrement affécté par PDO
	}
}