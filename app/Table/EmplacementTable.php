<?php

namespace App\Table;

use \Core\Table\Table;

class EmplacementTable extends Table{
	protected $table = 'emplacement';
	protected $id = 'emplacement_id';

	/**
	* Récupère les emplacements en joignant les users associés
	* @return array
	*/
	public function getEmplacements($type){
		return $this->query('
			SELECT * FROM emplacement
			LEFT JOIN user
			ON emplacement_owner = user_id
			WHERE emplacement_type = ?
			ORDER BY user_name',[$type]);
	}

	public function extractByType($key, $value, $type){ 
		$records = $this->query('SELECT * FROM emplacement WHERE emplacement_type = ? ORDER BY emplacement_owner',[$type]);
		$return = [];
		foreach ($records as $v) {
			$return[$v->$key] = $v->$value;
		}
		return $return;
	}

	/* Récupère les webcams d'un utilisateur
	* @param $user_id int
	* @return array
	*/
	public function getEmplacementsByUser($user_id){
		return $this->query("
			SELECT * FROM emplacement
			LEFT JOIN user
			ON emplacement_owner = user_id
			WHERE user_id = ?",[$user_id]);
	}


	public function extractByTypeAndUser($key, $value, $type, $user){ 
		$records = $this->query('SELECT * FROM emplacement WHERE emplacement_type = ? AND emplacement_owner = ? ORDER BY emplacement_name',[$type, $user]);
		$return = [];
		foreach ($records as $v) {
			$return[$v->$key] = $v->$value;
		}
		return $return;
	}


}