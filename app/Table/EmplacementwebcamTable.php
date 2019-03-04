<?php

namespace App\Table;

use \Core\Table\Table;

class EmplacementwebcamTable extends Table{
	protected $table = 'emplacementwebcam';
	protected $id = 'w_id';


	public function findWebcamEmplacements($id){
	return $this->query("
		SELECT * FROM emplacementwebcam
		LEFT JOIN emplacement
		ON e_id = emplacement_id
		WHERE w_id = ?",[$id]); 
	}

	public function extractEmplacementWebcam($value, $id){ //extractEmplacementWebcam('e_id',$_GET['id']);
		$records = $this->query('SELECT * FROM emplacementwebcam WHERE w_id = ?',[$id]);
		$return = [];
		$i = 1;
		foreach ($records as $v) {
			$return[$i] = $v->$value;
			$i++;
		}
		return $return;
	}

	/**
	* Create associations in the table for a webcam $id with each emplacements $fields
	* @param id int : id of current webcam
	* @param fields array : ids of emplacement to associate
	*/
	public function createAssos($id,$fields){
		$sql_parts = [];
		$attributes = [];
		foreach ($fields as $key => $value) {
			$sql_parts[] = "($value,$id)";
		}
		$sql_part = implode(',',$sql_parts);
		return $this->query("INSERT INTO emplacementwebcam VALUES $sql_part");
	}

	/**
	* Delete all associations (e_id | w_id) in the table based on the webcam id
	*/
	public function deleteAllAssos($id){
		return $this->query('DELETE FROM emplacementwebcam WHERE w_id = w_id = ?',[$id]);
	}

	/**
	* Delete all associations (e_id | w_id) in the table based on the webcam id and the emplacement owner
	* Only delete assos corresponding to the current user
	*/
	public function deleteAssosByUser($id, $user){
		return $this->query('DELETE emplacementwebcam FROM emplacementwebcam LEFT JOIN emplacement ON e_id = emplacement_id WHERE w_id = ? AND emplacement_owner = ?',[$id, $user]);
	}
}