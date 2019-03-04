<?php 

namespace App\Table;

use \Core\Table\Table;

class UserTable extends Table{
	protected $table = 'user';
	protected $id = 'user_id';

	/**
	* Récupère les utilisateurs en excluant l'admin
	* @param $id int
	* @return \App\Entity\WebcamEntity
	*/

	public function extractExceptAdmin($key, $value){ 
		$records = $this->query('SELECT * FROM user WHERE user_privilege != 1 ORDER BY user_name');
		$return = [];
		foreach ($records as $v) {
			$return[$v->$key] = $v->$value;
		}
		return $return;
	}

}