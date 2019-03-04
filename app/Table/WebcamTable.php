<?php

namespace App\Table;

use \Core\Table\Table;

class WebcamTable extends Table{

	protected $table = 'webcam';
	protected $id = 'webcam_id';

	/**
	* Récupère les webcams
	* @return array
	*/
	public function getWebcams(){ //last
		return $this->query("
			SELECT * FROM webcam
			LEFT JOIN user
			ON webcam_owner = user_id
			ORDER BY user_name");
	}

	/**
	* Récupère les webcams d'un utilisateur
	* @param $user_id int
	* @return array
	*/
	public function getWebcamsOwnedByUser($user_id){
		return $this->query("
			SELECT * FROM webcam
			LEFT JOIN user
			ON webcam_owner = user_id
			WHERE user_id = ?",[$user_id]);
	}

	/**
	* Récupère les webcams utilisées par un utilisateur dont il n'est pas proprio
	* @param $user_id int
	* @return array
	*/
	public function getWebcamsUsedByUser($user_id){
		return $this->query('
			SELECT * FROM webcam 
			LEFT JOIN emplacementwebcam	ON webcam_id = w_id
			LEFT JOIN emplacement ON e_id = emplacement_id
			LEFT JOIN user ON webcam_owner = user_id
			WHERE emplacement_owner = ? AND webcam_owner != ?
			GROUP BY webcam_id
		',[$user_id, $user_id]);
	}

	/**
	* Récupère les webcams dont l'utilisateur n'est ni proprio ni utilisateur
	* @param $user_id int
	* @return array
	*/
	public function getWebcamsUnusedByUser($user_id){
		return $this->query('
			SELECT * FROM webcam 
			LEFT JOIN user ON webcam_owner = user_id
			WHERE webcam_id NOT IN(
				SELECT webcam_id FROM webcam 
				LEFT JOIN emplacementwebcam	ON webcam_id = w_id
				LEFT JOIN emplacement ON e_id = emplacement_id
				LEFT JOIN user ON webcam_owner = user_id
				WHERE emplacement_owner = ? AND webcam_owner != ?
			)
			AND webcam_owner != ?
			ORDER BY webcam_owner
		',[$user_id, $user_id, $user_id]);
	}
	/**
	* Récupère une webcam en liant son user associé
	* @param $id int
	* @return \App\Entity\WebcamEntity
	*/
	public function find($id){
		return $this->query("
			SELECT * FROM webcam
			LEFT JOIN user
			ON webcam_owner = user_id
			WHERE webcam_id = ?",[$id],true);
	}



}